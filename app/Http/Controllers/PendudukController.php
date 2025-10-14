<?php
 
namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Wilayah;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StorePendudukRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Gunakan Log untuk debugging

class PendudukController extends Controller
{
    /**
     * Set middleware otorisasi pada constructor.
     * Pastikan 'auth' berjalan sebelum 'role'.
     */


    /**
     * Menampilkan daftar data penduduk.
     */
    public function index()
    {
        $user = auth()->user();
        $query = Penduduk::with('wilayah');

        // Filter by kecamatan if user is puskesmas_admin
        if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
            $query->whereHas('wilayah', function ($q) use ($user) {
                $q->where('nama_kecamatan', $user->wilayah->nama_kecamatan);
            });
        }

        // Filter by specific village if user is kades
        if ($user && $user->role->name === 'kades' && $user->wilayah_id) {
            $query->where('wilayah_id', $user->wilayah_id);
        }

        $penduduks = $query->latest()->paginate(10);
        return view('penduduk.index', compact('penduduks'));
    }

    /**
     * Menampilkan form input data penduduk baru.
     */
     public function create()
    {
        $user = auth()->user();

        // Prevent kades from accessing create form
        if ($user && $user->role->name === 'kades') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data penduduk.');
        }

        $query = Wilayah::query();

        // Filter wilayah by kecamatan if user is puskesmas_admin
        if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
            $query->where('nama_kecamatan', $user->wilayah->nama_kecamatan);
        }

        $wilayah = $query->get();

        // Ambil semua data penduduk yang sudah ada untuk dijadikan opsi Kepala Keluarga
        // Ini mendukung relasi self-referencing.
        $kepalaKeluargaOptions = Penduduk::orderBy('nama')->get();

        return view('penduduk.create', compact('wilayah', 'kepalaKeluargaOptions'));
    }

    /**
     * Menyimpan data penduduk, wilayah, dan inisiasi faktor risiko menggunakan Transaction.
     */
   public function store(StorePendudukRequest $request)
    {
        $validatedData = $request->validated();
        
        // ------------------------------------------------------------------
        // LOGIKA PENGGABUNGAN ALAMAT (DIPERBAIKI)
        // Kolom alamat_lengkap diisi dari gabungan alamat_detail, RT, dan RW.
        // ------------------------------------------------------------------
        // Pastikan alamat_detail diberi nilai default string kosong jika null/kosong
        $alamat_detail = $validatedData['alamat_detail'] ?? '';
        
        $alamat_lengkap = trim(
            $alamat_detail . 
            ', RT ' . $validatedData['alamat_rt'] . 
            '/RW ' . $validatedData['alamat_rw']
        );
        
        $user = auth()->user();

        // Enforce wilayah if user is puskesmas_admin
        if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
            $selectedWilayah = Wilayah::find($validatedData['wilayah_id']);
            if (!$selectedWilayah || $selectedWilayah->nama_kecamatan !== $user->wilayah->nama_kecamatan) {
                return back()->withInput()->with('error', 'Anda hanya dapat menambah penduduk di wilayah Anda.');
            }
        }

        // Enforce village restriction if user is kades
        if ($user && $user->role->name === 'kades' && $user->wilayah_id) {
            if ($validatedData['wilayah_id'] != $user->wilayah_id) {
                return back()->withInput()->with('error', 'Anda hanya dapat menambah penduduk di desa Anda.');
            }
        }

        // Data untuk tabel Penduduk
        $dataPenduduk = [
            'NIK' => $validatedData['NIK'],
            'nama' => $validatedData['nama'],
            'JK' => $validatedData['JK'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'TTL' => $validatedData['tanggal_lahir'],
            'alamat_lengkap' => $alamat_lengkap,
            'wilayah_id' => $validatedData['wilayah_id'],
            'no_telp' => $validatedData['no_telp'],
            'no_bpjs' => $validatedData['no_bpjs'], // FIX: simpan BPJS
            'kepala_keluarga_id' => $validatedData['kepala_keluarga_id'] ?? null,
        ];

        try {
            // 2. SIMPAN DATA PENDUDUK
            $pendudukBaru = Penduduk::create($dataPenduduk);

            // 3. SIMPAN DATA FAKTOR RISIKO (ke tabel faktor_risiko)
            $pendudukBaru->faktorRisiko()->create([
                'riwayat_merokok' => $validatedData['riwayat_merokok'] ?? 0,
                'riwayat_alkohol' => $validatedData['riwayat_alkohol'] ?? 0,
                'riwayat_penyakit_keturunan' => $validatedData['riwayat_penyakit_keturunan'] ?? 0,
            ]);

            // 4. BUAT AKUN USER UNTUK PASIEN
            $patientRole = Role::where('name', 'patient')->first();
            if ($patientRole) {
                try {
                    $user = User::create([
                        'name' => $validatedData['nama'],
                        'email' => $validatedData['NIK'] . '@sentrasehat.local',
                        'nik' => $validatedData['NIK'],
                        'password' => Hash::make('password123'), // Default password
                        'role_id' => $patientRole->id,
                        'penduduk_id' => $pendudukBaru->id,
                    ]);
                    \Log::info("User account created successfully for penduduk ID: {$pendudukBaru->id}, User ID: {$user->id}, NIK: {$validatedData['NIK']}");
                } catch (\Exception $e) {
                    \Log::error("Failed to create user account for penduduk ID: {$pendudukBaru->id}, NIK: {$validatedData['NIK']}. Error: " . $e->getMessage());
                    // Continue with the process even if user creation fails
                }
            } else {
                \Log::warning("Patient role not found. Cannot create user account for penduduk ID: {$pendudukBaru->id}");
            }

            return redirect()->route('penduduk.index')->with('success', 'Data Penduduk berhasil ditambahkan!');

        } catch (\Exception $e) {
            \Log::error("Error menyimpan data penduduk: " . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan data. Terjadi kesalahan server atau data tidak valid.');
        }
    }
    /**
     * Menampilkan detail data penduduk.
     */
    public function show(Penduduk $penduduk)
    {
        $user = auth()->user();
        if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
            if ($penduduk->wilayah->nama_kecamatan !== $user->wilayah->nama_kecamatan) {
                abort(403, 'Anda tidak memiliki akses ke data penduduk ini.');
            }
        }

        // Check village access for kades
        if ($user && $user->role->name === 'kades' && $user->wilayah_id) {
            if ($penduduk->wilayah_id != $user->wilayah_id) {
                abort(403, 'Anda tidak memiliki akses ke data penduduk ini.');
            }
        }

        $penduduk->load(['wilayah', 'faktorRisiko']);
        return view('penduduk.show', compact('penduduk'));
    }
    
    /**
     * Menampilkan form edit data penduduk.
     */
    public function edit(Penduduk $penduduk)
    {
        $user = auth()->user();
        if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
            if ($penduduk->wilayah->nama_kecamatan !== $user->wilayah->nama_kecamatan) {
                abort(403, 'Anda tidak memiliki akses ke data penduduk ini.');
            }
        }

        // Check village access for kades
        if ($user && $user->role->name === 'kades' && $user->wilayah_id) {
            if ($penduduk->wilayah_id != $user->wilayah_id) {
                abort(403, 'Anda tidak memiliki akses ke data penduduk ini.');
            }
        }

        $wilayahs = Wilayah::all();
        return view('penduduk.edit', compact('penduduk', 'wilayahs'));
    }

    /**
     * Memperbarui data penduduk.
     */
    public function update(StorePendudukRequest $request, Penduduk $penduduk)
    {
        $user = auth()->user();
        if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
            if ($penduduk->wilayah->nama_kecamatan !== $user->wilayah->nama_kecamatan) {
                abort(403, 'Anda tidak memiliki akses ke data penduduk ini.');
            }
        }

        DB::beginTransaction();
        try {
            
            $pendudukData = $request->only([
                'NIK', 
                'nama', 
                'JK', 
                'wilayah_id', 
                'no_telp',
                'no_bpjs', // Tambahkan agar BPJS bisa diupdate
                'tanggal_lahir',
                'tempat_lahir'
            ]);

            // Update alamat lengkap
            $pendudukData['alamat_lengkap'] = "RT {$request->alamat_rt}/RW {$request->alamat_rw} - {$request->alamat_detail}";
            
            // Update data Penduduk
            $penduduk->update($pendudukData);
            
            DB::commit();

            return redirect()->route('penduduk.show', $penduduk->id)
                            ->with('success', 'Data Penduduk berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Gagal memperbarui data penduduk: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data penduduk.
     */
    public function destroy(Penduduk $penduduk)
    {
        $user = auth()->user();
        if ($user && $user->role->name === 'kades') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data penduduk.');
        }

        $penduduk->delete();

        return redirect()->route('penduduk.index')
                         ->with('success', 'Data Penduduk berhasil dihapus.');
    }
}
