<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Penduduk;
use App\Models\TindakanIntervensi;
use App\Models\Obat;
use App\Models\KesehatanLingkungan;
use App\Models\Penyakit;
use App\Models\KesehatanGizi;
use App\Models\KesehatanAnakIbu;
use App\Models\Wilayah;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->name ?? 'guest';

        $data = [];
        $wilayahs = collect(); // Initialize empty collection for roles that don't need wilayah data

    // Set wilayah filter for puskesmas_admin
    $wilayahFilter = null;
    $kecamatanFilter = null;
    if ($role == 'puskesmas_admin' && $user->wilayah) {
        $kecamatanFilter = $user->wilayah->nama_kecamatan;
    }

    if (in_array($role, ['super_admin', 'puskesmas_admin', 'dokter'])) {
        $data['total_penduduk'] = Penduduk::when($kecamatanFilter, fn($q) => $q->whereHas('wilayah', fn($sub) => $sub->where('nama_kecamatan', $kecamatanFilter)))->count();
        $data['total_intervensi'] = TindakanIntervensi::when($kecamatanFilter, fn($q) => $q->whereHas('pasien.wilayah', fn($sub) => $sub->where('nama_kecamatan', $kecamatanFilter)))->count();
        $data['total_obat'] = Obat::count();
        $data['total_lingkungan'] = KesehatanLingkungan::when($kecamatanFilter, fn($q) => $q->whereHas('wilayah', fn($sub) => $sub->where('nama_kecamatan', $kecamatanFilter)))->count();
        $data['total_penyakit'] = Penyakit::count();
        $data['total_gizi'] = KesehatanGizi::when($kecamatanFilter, fn($q) => $q->whereHas('penduduk.wilayah', fn($sub) => $sub->where('nama_kecamatan', $kecamatanFilter)))->count();
        $data['total_anak_ibu'] = KesehatanAnakIbu::when($kecamatanFilter, fn($q) => $q->whereHas('penduduk.wilayah', fn($sub) => $sub->where('nama_kecamatan', $kecamatanFilter)))->count();

        // Query untuk tabel statistik wilayah (paginasi)
        $wilayahs = Wilayah::select('wilayah.*')
        ->selectSub(function ($query) {
            $query->selectRaw('COUNT(tindakan_intervensi.id)')
                ->from('penduduk')
                ->leftJoin('tindakan_intervensi', 'penduduk.id', '=', 'tindakan_intervensi.pasien_id')
                ->whereColumn('penduduk.wilayah_id', 'wilayah.id');
        }, 'intervention_count')
        ->when($kecamatanFilter, function($query) use ($kecamatanFilter) {
            return $query->where('nama_kecamatan', $kecamatanFilter);
        })
        ->paginate(20);

        // Add diseases to each wilayah
        foreach ($wilayahs as $wilayah) {
            $diseases = DB::table('tindakan_intervensi')
                ->join('penduduk', 'tindakan_intervensi.pasien_id', '=', 'penduduk.id')
                ->join('penyakits', 'tindakan_intervensi.penyakit_id', '=', 'penyakits.id')
                ->where('penduduk.wilayah_id', $wilayah->id)
                ->select('penyakits.name')
                ->distinct()
                ->pluck('name')
                ->toArray();
            $wilayah->diseases = implode(', ', $diseases);
        }

        // Query untuk data map/chart (SEMUA wilayah, tanpa paginasi)
        $allWilayah = Wilayah::from('wilayah as w')
            ->select('w.id', 'w.nama_desa', 'w.nama_kecamatan', 'w.nama_kabupaten', 'w.latitude', 'w.longitude')
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(ti.id)')
                    ->from('penduduk as p')
                    ->leftJoin('tindakan_intervensi as ti', 'p.id', '=', 'ti.pasien_id')
                    ->whereColumn('p.wilayah_id', 'w.id');
            }, 'intervention_count')
            ->when($kecamatanFilter, function($query) use ($kecamatanFilter) {
                return $query->where('w.nama_kecamatan', $kecamatanFilter);
            })
            ->get();

    $diseaseDistribution = [];
    foreach ($allWilayah as $wilayah) {
        $lat = is_numeric($wilayah->latitude) ? (float)$wilayah->latitude : null;
        $lng = is_numeric($wilayah->longitude) ? (float)$wilayah->longitude : null;
        if ($lat === null || $lng === null) {
            // Auto-fill coordinates using Google Maps API
            $address = $wilayah->nama_desa . ', ' . $wilayah->nama_kecamatan . ', ' . $wilayah->nama_kabupaten . ', Indonesia';
            $coords = $this->getCoordinates($address);
            if ($coords) {
                $wilayah->update(['latitude' => $coords['lat'], 'longitude' => $coords['lng']]);
                $lat = $coords['lat'];
                $lng = $coords['lng'];
            } else {
                $lat = -5.4;
                $lng = 119.6;
            }
        } elseif ($lat < -90 || $lat > 90 || $lng < -180 || $lng > 180) {
            $lat = -5.4;
            $lng = 119.6;
        }
        $diseases = DB::table('tindakan_intervensi')
            ->join('penduduk', 'tindakan_intervensi.pasien_id', '=', 'penduduk.id')
            ->join('penyakits', 'tindakan_intervensi.penyakit_id', '=', 'penyakits.id')
            ->where('penduduk.wilayah_id', $wilayah->id)
            ->select('penyakits.name as nama_penyakit', DB::raw('COUNT(*) as count'))
            ->groupBy('penyakits.id', 'penyakits.name')
            ->orderBy('count', 'desc')
            ->get();

        $diseaseNames = $diseases->pluck('nama_penyakit')->toArray();
        $diseaseList = implode(', ', $diseaseNames);

        $diseaseDistribution[] = [
            'name' => $wilayah->nama_desa . ', ' . $wilayah->nama_kecamatan,
            'count' => $wilayah->intervention_count ?? 0,
            'diseases' => $diseaseList ?: 'Tidak ada data',
            'lat' => $lat,
            'lng' => $lng
        ];
    }

    $data['disease_distribution'] = $diseaseDistribution;
}
        
        // Logika untuk role Kades
        elseif ($role == 'kades') {
            // Kades hanya melihat data di wilayahnya (desa)
            $wilayahId = $user->wilayah_id;

            // Data untuk view kades (sesuai dengan nama variable yang diharapkan view)
            $data['total_penduduk_desa'] = Penduduk::where('wilayah_id', $wilayahId)->count();
            $data['total_intervensi_desa'] = TindakanIntervensi::whereHas('pasien', function($q) use ($wilayahId) { $q->where('wilayah_id', $wilayahId); })->count();

            // Hitung intervensi bulan ini
            $data['intervensi_bulan_ini'] = TindakanIntervensi::whereHas('pasien', function($q) use ($wilayahId) { $q->where('wilayah_id', $wilayahId); })
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();

            // Hitung kasus penyakit bulan ini
            $data['kasus_penyakit'] = TindakanIntervensi::whereHas('pasien', function($q) use ($wilayahId) { $q->where('wilayah_id', $wilayahId); })
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->distinct('penyakit_id')
                ->count('penyakit_id');

            // Alert kesehatan - kasus yang perlu perhatian (lebih dari 5 intervensi per penyakit)
            $data['alert_kesehatan'] = DB::table('tindakan_intervensi')
                ->join('penduduk', 'tindakan_intervensi.pasien_id', '=', 'penduduk.id')
                ->where('penduduk.wilayah_id', $wilayahId)
                ->select('penyakit_id', DB::raw('COUNT(*) as count'))
                ->groupBy('penyakit_id')
                ->having('count', '>', 5)
                ->count();

            // Kades melihat wilayah mereka sendiri
            $wilayahs = Wilayah::where('id', $wilayahId)->paginate(20);

            // Add diseases to the wilayah
            foreach ($wilayahs as $wilayah) {
                $diseases = DB::table('tindakan_intervensi')
                    ->join('penduduk', 'tindakan_intervensi.pasien_id', '=', 'penduduk.id')
                    ->join('penyakits', 'tindakan_intervensi.penyakit_id', '=', 'penyakits.id')
                    ->where('penduduk.wilayah_id', $wilayah->id)
                    ->select('penyakits.name')
                    ->distinct()
                    ->pluck('name')
                    ->toArray();
                $wilayah->diseases = implode(', ', $diseases);
            }

            // Disease distribution for kades (their village only)
            $village = Wilayah::find($wilayahId);
            if ($village) {
                $lat = is_numeric($village->latitude) ? (float)$village->latitude : -5.4;
                $lng = is_numeric($village->longitude) ? (float)$village->longitude : 119.6;

                $diseases = DB::table('tindakan_intervensi')
                    ->join('penduduk', 'tindakan_intervensi.pasien_id', '=', 'penduduk.id')
                    ->join('penyakits', 'tindakan_intervensi.penyakit_id', '=', 'penyakits.id')
                    ->where('penduduk.wilayah_id', $wilayahId)
                    ->select('penyakits.name as nama_penyakit', DB::raw('COUNT(*) as count'))
                    ->groupBy('penyakits.id', 'penyakits.name')
                    ->orderBy('count', 'desc')
                    ->get();

                $diseaseNames = $diseases->pluck('nama_penyakit')->toArray();
                $diseaseList = implode(', ', $diseaseNames);

                $data['disease_distribution'] = [[
                    'name' => $village->nama_desa . ', ' . $village->nama_kecamatan,
                    'count' => $diseases->sum('count') ?? 0,
                    'diseases' => $diseaseList ?: 'Tidak ada data',
                    'lat' => $lat,
                    'lng' => $lng
                ]];
            } else {
                $data['disease_distribution'] = [];
            }
        }
        
        // Tambahkan logika untuk role Dokter, Dinkes Admin, dll. di sini.

        $googleMapsKey = config('services.google_maps.key');

        return view('home', compact('role', 'data', 'wilayahs', 'googleMapsKey'));
    }

    private function getCoordinates($address)
    {
        $apiKey = config('services.google_maps.key');
        $url = 'https://maps.googleapis.com/maps/api/geocode/json';
        $response = Http::get($url, [
            'address' => $address,
            'key' => $apiKey
        ]);

        if ($response->successful() && $response->json('status') === 'OK') {
            $location = $response->json('results.0.geometry.location');
            return [
                'lat' => (float) $location['lat'],
                'lng' => (float) $location['lng']
            ];
        }
        return null;
    }
}
