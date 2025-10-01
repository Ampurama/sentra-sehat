<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Models\TindakanIntervensi;
use App\Http\Requests\StoreTindakanIntervensiRequest; // Uncomment jika sudah dibuat
use Illuminate\Support\Facades\Auth;

class TindakanIntervensiController extends Controller
{
    /**
     * Menampilkan form pencarian NIK (atau daftar intervensi, jika tanpa keyword) 
     * dan memproses hasil pencarian.
     */
    public function index(Request $request)
    {
        $keyword = $request->query('keyword');
        $penduduk = null;
        $searched = false;
        $intervensiList = null;

        $user = auth()->user();

        // Get list of penduduk filtered by wilayah if puskesmas_admin
        $pendudukQuery = Penduduk::with('wilayah');

        if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
            $pendudukQuery->whereHas('wilayah', function ($q) use ($user) {
                $q->where('nama_kecamatan', $user->wilayah->nama_kecamatan);
            });
        }

        $pendudukList = $pendudukQuery->latest()->paginate(10);

        if ($keyword) {
            $searched = true;
            $query = Penduduk::query();

            // Filter by kecamatan if user is puskesmas_admin
            if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
                $query->whereHas('wilayah', function ($q) use ($user) {
                    $q->where('nama_kecamatan', $user->wilayah->nama_kecamatan);
                });
            }

            // Mencari penduduk berdasarkan NIK atau Nama
            $penduduk = $query->where(function ($q) use ($keyword) {
                $q->where('NIK', $keyword)
                  ->orWhere('nama', 'LIKE', '%' . $keyword . '%');
            })->first(); // Ambil hanya satu hasil

            if (!$penduduk) {
                 // Jika tidak ditemukan, kembalikan ke view dengan pesan error
                 return view('intervensi.search', compact('searched', 'pendudukList'))->with('error', 'Penduduk dengan kata kunci tersebut tidak ditemukan.');
            }
        }

        // Menggunakan view 'intervensi.search' untuk form dan hasil pencarian.
        return view('intervensi.search', compact('penduduk', 'searched', 'pendudukList'));
    }

    /**
     * Menampilkan formulir sesungguhnya untuk mencatat intervensi baru.
     * Dipanggil setelah NIK ditemukan.
     */
    public function create(Request $request)
    {
        $pendudukId = $request->query('penduduk_id'); 
        
        if (!$pendudukId) {
            return redirect()->route('intervensi.index')->with('error', 'Silakan cari penduduk terlebih dahulu.');
        }

        $user = auth()->user();

        // Load data penduduk, faktor risiko, dan riwayat intervensi (beserta relasinya)
        $penduduk = Penduduk::with([
            'faktorRisiko',
            'riwayatIntervensi' => function ($query) {
                // Urutkan dari yang terbaru dan muat rencana lanjutan, petugas
                $query->orderBy('tgl_tindakan', 'desc')
                      ->with(['rencanaLanjutan', 'petugas']);
            }
        ])->findOrFail($pendudukId);

        // Check if penduduk is in user's kecamatan if puskesmas_admin
        if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
            if ($penduduk->wilayah->nama_kecamatan !== $user->wilayah->nama_kecamatan) {
                return redirect()->route('intervensi.index')->with('error', 'Anda tidak memiliki akses ke penduduk ini.');
            }
        }

        // Load all penyakit for dropdown
        $penyakit = \App\Models\Penyakit::all();

        // Muat formulir intervensi
        return view('intervensi.create', compact('penduduk', 'penyakit')); 
    }
    
    /**
     * Menyimpan data intervensi baru ke database.
     */
    public function store(StoreTindakanIntervensiRequest $request)
    {
        $validatedData = $request->validated();

        $user = auth()->user();

        // Check if penduduk is in user's kecamatan if puskesmas_admin
        $penduduk = Penduduk::find($validatedData['penduduk_id']);
        if ($user && $user->role->name === 'puskesmas_admin' && $user->wilayah) {
            if (!$penduduk || $penduduk->wilayah->nama_kecamatan !== $user->wilayah->nama_kecamatan) {
                return back()->withInput()->with('error', 'Anda tidak memiliki akses ke penduduk ini.');
            }
        }

        try {
            // Data untuk TindakanIntervensi
            $dataIntervensi = [
                'pasien_id' => $validatedData['penduduk_id'],
                'penyakit_id' => $validatedData['penyakit_id'],
                'petugas_id' => Auth::id(),
                'tgl_tindakan' => $validatedData['tanggal_intervensi'],
                'diagnosis_utama' => $validatedData['diagnosis'],
                'tindakan_selama_perawatan' => $validatedData['tindakan'],
                'status_fungsional' => $request->input('status_fungsional', 'Baik'),
            ];

            // 1. SIMPAN DATA INTERVENSI UTAMA
            $intervensi = TindakanIntervensi::create($dataIntervensi);

            // 2. SIMPAN RENCANA LANJUTAN
            $intervensi->rencanaLanjutan()->create([
                'keluhan_komplikasi' => $validatedData['keluhan_komplikasi'] ?? null,
                'jadwal_kontrol_berikutnya' => $validatedData['jadwal_kontrol_berikutnya'] ?? null,
                'terapi_lanjutan' => $validatedData['terapi_lanjutan'] ?? null,
                'kebutuhan_pendampingan' => $validatedData['kebutuhan_pendampingan'] ?? null,
                'keterangan_lain' => $validatedData['keterangan_lain'] ?? null,
            ]);

            return redirect()->route('intervensi.index')
                             ->with('success', 'Tindakan Intervensi berhasil dicatat!');

        } catch (\Exception $e) {
            \Log::error("Error menyimpan intervensi: " . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan data intervensi: ' . $e->getMessage());
        }
    }

    // ... (metode show, edit, update, destroy lainnya jika diperlukan)
}
