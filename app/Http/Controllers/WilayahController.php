<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use App\Http\Requests\StoreWilayahRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WilayahController extends Controller
{
    /**
     * Otorisasi: Hanya Super Admin dan Dinkes Admin.
     */
    public function __construct()
    {
        $this->middleware('role:super_admin,dinkes_admin');
    }


    /**
     * Menampilkan daftar wilayah dengan pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $query = Wilayah::query();

        // Fitur Pencarian
        if ($keyword = $request->get('keyword')) {
            $query->where('nama_desa', 'like', '%' . $keyword . '%')
                  ->orWhere('nama_kecamatan', 'like', '%' . $keyword . '%')
                  ->orWhere('nama_kabupaten', 'like', '%' . $keyword . '%');
        }

        $wilayahs = $query->latest()->paginate(10); // Urutkan berdasarkan yang terbaru dan pagination
        
        return view('wilayah.index', compact('wilayahs'));
    }

    /**
     * Menampilkan form untuk membuat Wilayah baru.
     */
    public function create()
    {
        return view('wilayah.create');
    }

    /**
     * Menyimpan Wilayah baru ke database.
     */
    public function store(StoreWilayahRequest $request)
    {
        Wilayah::create($request->validated());

        return redirect()->route('wilayah.index')
                         ->with('success', 'Data Wilayah berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit Wilayah.
     */
    public function edit(Wilayah $wilayah)
    {
        return view('wilayah.edit', compact('wilayah'));
    }

    /**
     * Memperbarui Wilayah di database.
     */
    public function update(StoreWilayahRequest $request, Wilayah $wilayah)
    {
        $wilayah->update($request->validated());

        return redirect()->route('wilayah.index')
                         ->with('success', 'Data Wilayah berhasil diperbarui.');
    }

    /**
     * Menghapus Wilayah dari database.
     */
    public function destroy(Wilayah $wilayah)
    {
        try {
            // Cek apakah ada data terkait yang masih terhubung dengan wilayah ini
            $relatedCounts = [
                'penduduk' => $wilayah->penduduks()->count(),
                'kesehatan_lingkungan' => $wilayah->kesehatanLingkungans()->count(),
                'kesehatan_gizi' => $wilayah->kesehatanGizis()->count(),
                'kesehatan_anak_ibu' => $wilayah->kesehatanAnakIbus()->count(),
            ];

            $totalRelated = array_sum($relatedCounts);
            if ($totalRelated > 0) {
                $message = 'Gagal menghapus! Masih ada data terkait yang terhubung ke wilayah ini:';
                foreach ($relatedCounts as $type => $count) {
                    if ($count > 0) {
                        $message .= " {$count} {$type}";
                    }
                }
                return redirect()->route('wilayah.index')
                                 ->with('error', $message);
            }

            $wilayah->delete();
            return redirect()->route('wilayah.index')
                             ->with('success', 'Data Wilayah berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('wilayah.index')
                             ->with('error', 'Terjadi kesalahan saat menghapus data wilayah.');
        }
    }
    


}
