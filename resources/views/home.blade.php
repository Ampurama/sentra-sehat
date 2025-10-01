    @extends('layouts.app')

@section('title', 'Dashboard Utama')

@section('content')

<!-- CDN dan Styling -->
<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapsKey }}&callback=initDiseaseMap" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

/* Custom Google Maps-like styling for Leaflet */
.leaflet-container {
    background: #f0f0f0 !important;
    font-family: 'Inter', sans-serif;
}

.leaflet-popup-content-wrapper {
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    font-family: 'Inter', sans-serif;
    border: none;
}

.leaflet-popup-tip {
    background-color: white;
}

.leaflet-control-attribution {
    background-color: rgba(255,255,255,0.9);
    font-size: 10px;
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Enhanced Dashboard Styling */
.dashboard-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.card-hover {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform-style: preserve-3d;
}

.card-hover:hover {
    transform: translateY(-12px) scale(1.05) rotateX(5deg);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.glass-effect {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stats-number {
    background: linear-gradient(45deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
}

.welcome-animation {
    animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.grid-animation {
    animation: fadeInUp 1s ease-out 0.2s both;
}

.section-spacing {
    margin-top: 3rem;
    margin-bottom: 2rem;
}

/* Enhanced card borders with gradients */
.border-gradient-teal {
    border: 0;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #14b8a6, #06b6d4) border-box;
}

.border-gradient-red {
    border: 0;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #ef4444, #f97316) border-box;
}

.border-gradient-purple {
    border: 0;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #a855f7, #c084fc) border-box;
}

.border-gradient-green {
    border: 0;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #22c55e, #16a34a) border-box;
}

.border-gradient-orange {
    border: 0;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #f97316, #ea580c) border-box;
}

.border-gradient-indigo {
    border: 0;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #6366f1, #8b5cf6) border-box;
}

.border-gradient-pink {
    border: 0;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #ec4899, #f97316) border-box;
}

.border-gradient-blue {
    border: 0;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #3b82f6, #1d4ed8) border-box;
}

.border-gradient-yellow {
    border: 0;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #eab308, #f59e0b) border-box;
}

/* Enhanced table styling */
.table-modern {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.table-modern thead th {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    font-weight: 600;
    color: #374151;
    border-bottom: 2px solid #e5e7eb;
}

.table-modern tbody tr {
    transition: all 0.2s ease;
}

.table-modern tbody tr:hover {
    background-color: #f8fafc;
    transform: scale(1.01);
}

/* Enhanced chart container */
.chart-container {
    position: relative;
    height: 300px;
}

/* Loading animation */
.loading-shimmer {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

/* Tambahan efek glass, gradient, dan animasi card/tombol */
.card-beauty {
    background: rgba(255,255,255,0.85);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
    border-radius: 1.5rem;
    border: 1px solid rgba(255,255,255,0.18);
    transition: box-shadow 0.3s, transform 0.3s;
}
.card-beauty:hover {
    box-shadow: 0 16px 40px 0 rgba(31, 38, 135, 0.18);
    transform: translateY(-4px) scale(1.03);
}
@media (max-width: 640px) {
    .card-beauty { padding: 1.25rem; border-radius: 1.25rem; }
    .dashboard-gradient { padding: 1.5rem; border-radius: 1.25rem; }
}
.beauty-btn {
    background: linear-gradient(90deg, #6366f1 0%, #ec4899 100%);
    color: #fff;
    border-radius: 1rem;
    box-shadow: 0 2px 8px rgba(99,102,241,0.12);
    transition: background 0.3s, box-shadow 0.3s;
}
.beauty-btn:hover {
    background: linear-gradient(90deg, #ec4899 0%, #6366f1 100%);
    box-shadow: 0 6px 16px rgba(99,102,241,0.18);
}
</style>

    <!-- Konten Dashboard Utama -->
    
    {{-- Enhanced Greeting & Role Banner --}}
    <div class="welcome-animation dashboard-gradient p-8 md:p-10 rounded-3xl shadow-2xl mb-10 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white rounded-full -ml-24 -mb-24"></div>
        </div>

        <div class="relative z-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex-1">
                    <h1 class="text-3xl sm:text-4xl font-extrabold mb-2" style="font-family: 'Inter', sans-serif;">
                        Halo, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="text-xl text-white/90 mb-3" style="font-family: 'Inter', sans-serif;">
                        Selamat datang di <span class="font-bold text-white">Sentra Sehat</span>
                    </p>
                    <p class="text-lg text-white/80 mb-4" style="font-family: 'Inter', sans-serif;">
                        Anda beroperasi sebagai <span class="font-bold text-white bg-white/20 px-3 py-1 rounded-full text-sm uppercase tracking-wide">{{ $role }}</span>
                    </p>
                    <p class="text-base text-white/70" style="font-family: 'Inter', sans-serif;">
                        Lihat ringkasan performa dan data terbaru di bawah. Mari bergerak cepat untuk kesehatan masyarakat!
                    </p>
                </div>

                @if ($role == 'super_admin' || $role == 'puskesmas_admin' || $role == 'dokter')
                <div class="flex-shrink-0">
                    <a href="{{ route('patient.login.form') }}" class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl font-semibold text-sm text-white uppercase tracking-widest hover:bg-white/30 focus:bg-white/30 active:bg-white/40 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Portal Pasien
                    </a>
                </div>
                @endif

                @if ($role == 'super_admin')
                <div class="flex-shrink-0 ml-4">
                    <div class="flex space-x-2">
                        <a href="{{ route('users.create_puskesmas_admin') }}" class="inline-flex items-center px-4 py-2 bg-blue-600/20 backdrop-blur-sm border border-blue-300/30 rounded-lg font-medium text-sm text-white hover:bg-blue-600/30 focus:bg-blue-600/30 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Add Puskesmas
                        </a>
                        <a href="{{ route('users.create_kades') }}" class="inline-flex items-center px-4 py-2 bg-green-600/20 backdrop-blur-sm border border-green-300/30 rounded-lg font-medium text-sm text-white hover:bg-green-600/30 focus:bg-green-600/30 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Add Kades
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Quick Stats Preview -->
            <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="text-2xl font-bold text-white stats-number">{{ $data['total_penduduk'] ?? 0 }}</div>
                    <div class="text-sm text-white/80">Total Penduduk</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="text-2xl font-bold text-white stats-number">{{ $data['total_intervensi'] ?? 0 }}</div>
                    <div class="text-sm text-white/80">Intervensi</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="text-2xl font-bold text-white stats-number">{{ $data['total_penyakit'] ?? 0 }}</div>
                    <div class="text-sm text-white/80">Penyakit</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="text-2xl font-bold text-white stats-number">{{ $data['total_obat'] ?? 0 }}</div>
                    <div class="text-sm text-white/80">Obat</div>
                </div>
            </div>
        </div>
    </div>

    @if ($role == 'super_admin' || $role == 'puskesmas_admin' || $role == 'dokter')
    <main>
    {{-- Card Section Title --}}
    <div class="section-spacing">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800" style="font-family: 'Inter', sans-serif;">Ringkasan Cepat Data Agregat</h2>

        <!-- Dashboard Cards (Admin/Puskesmas/Dokter) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Card 1: Total Penduduk -->
            <a href="{{ route('penduduk.index') }}" class="block h-full">
                <div class="card-beauty bg-white p-4 sm:p-6 flex flex-col justify-between">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Total Data Penduduk</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ $data['total_penduduk'] ?? 0 }}</span>
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.523-.213-1.009-.594-1.356M2 17V9a4 4 0 014-4h14a4 4 0 014 4v8m-16 0v2c0 .523.213 1.009.594 1.356M2 17h18M5 17h.01M17 17h.01M6 10h.01M12 10h.01M18 10h.01"></path></svg>
                    </div>
                    <p class="text-xs mt-2 text-teal-600 font-semibold">Lihat Detail Penduduk</p>
                </div>
            </a>

            <!-- Card 2: Total Intervensi -->
            <a href="{{ route('intervensi.index') }}" class="block h-full">
                <div class="card-beauty bg-white p-4 sm:p-6 flex flex-col justify-between">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Total Tindakan Intervensi</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ $data['total_intervensi'] ?? 0 }}</span>
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M12 16h.01"></path></svg>
                    </div>
                    <p class="text-xs mt-2 text-red-600 font-semibold">Kelola Tindakan</p>
                </div>
            </a>

            <!-- Card 3: Total Obat -->
            <a href="{{ route('obat.index') }}" class="block h-full">
                <div class="card-beauty bg-white p-4 sm:p-6 flex flex-col justify-between">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Total Data Obat</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ $data['total_obat'] ?? 0 }}</span>
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <p class="text-xs mt-2 text-purple-600 font-semibold">Kelola Stok Obat</p>
                </div>
            </a>

            <!-- Card 4: Total Kesehatan Lingkungan -->
            <a href="{{ route('kesehatan_lingkungan.index') }}" class="block h-full">
                <div class="card-beauty bg-white p-4 sm:p-6 flex flex-col justify-between">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Kesehatan Lingkungan</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ $data['total_lingkungan'] ?? 0 }}</span>
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <p class="text-xs mt-2 text-green-600 font-semibold">Kelola Data Lingkungan</p>
                </div>
            </a>

            <!-- Card 5: Total Penyakit -->
            <a href="{{ route('penyakit.index') }}" class="block h-full">
                <div class="card-beauty bg-white p-4 sm:p-6 flex flex-col justify-between">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Data Penyakit</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ $data['total_penyakit'] ?? 0 }}</span>
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-xs mt-2 text-orange-600 font-semibold">Kelola Penyakit</p>
                </div>
            </a>

            <!-- Card 6: Total Kesehatan Gizi -->
            <a href="{{ route('kesehatan_gizi.index') }}" class="block h-full">
                <div class="card-beauty bg-white p-4 sm:p-6 flex flex-col justify-between">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Kesehatan Gizi</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ $data['total_gizi'] ?? 0 }}</span>
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4H7z"></path></svg>
                    </div>
                    <p class="text-xs mt-2 text-indigo-600 font-semibold">Kelola Data Gizi</p>
                </div>
            </a>

            <!-- Card 7: Total Kesehatan Anak Ibu -->
            <a href="{{ route('kesehatan_anak_ibu.index') }}" class="block h-full">
                <div class="card-beauty bg-white p-4 sm:p-6 flex flex-col justify-between">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Kesehatan Anak & Ibu</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ $data['total_anak_ibu'] ?? 0 }}</span>
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <p class="text-xs mt-2 text-pink-600 font-semibold">Kelola Data Anak Ibu</p>
                </div>
            </a>

             <!-- Card 8: Link Cepat Tambah Penduduk -->
             <a href="{{ route('penduduk.create') }}" class="block h-full">
                <div class="card-beauty bg-white p-4 sm:p-6 flex flex-col justify-between">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Input Data Baru</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-2xl sm:text-4xl font-bold text-gray-900">ENTRY</span>
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-xs mt-2 text-blue-600 font-semibold">Input Penduduk Baru</p>
                </div>
            </a>
            
             <!-- Card 9: Placeholder Laporan -->
             <a href="#" class="block h-full">
                <div class="card-beauty bg-white p-4 sm:p-6 flex flex-col justify-between">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Laporan Agregat</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-2xl sm:text-4xl font-bold text-gray-900">REPORT</span>
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v10m-6 4a2 2 0 002 2h2a2 2 0 002-2m0 0a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v10"></path></svg>
                    </div>
                    <p class="text-xs mt-2 text-yellow-600 font-semibold">Lihat Tren dan Statistik</p>
                </div>
            </a>
        </div>
    </div>

    {{-- Enhanced Disease Distribution Map and Stats --}}
        <div class="section-spacing">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800" style="font-family: 'Inter', sans-serif;">Pemetaan Distribusi Penyakit Berdasarkan Wilayah</h2>
                    <p class="text-sm text-gray-500 mt-1">Visualisasi data intervensi kesehatan di berbagai wilayah</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button id="map-toggle" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm font-medium transition-colors">Peta</button>
                    <button id="chart-toggle" class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded-lg text-sm font-medium transition-colors">Grafik</button>
                </div>
            </div>

            <!-- Ubah grid menjadi 1 kolom agar map full width -->
            <div class="grid grid-cols-1 gap-6">
                <!-- Enhanced Map Section -->
                <div id="map-section" class="bg-white rounded-2xl shadow-lg overflow-hidden glass-effect">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700" style="font-family: 'Inter', sans-serif;">Peta Distribusi Wilayah</h3>
                                <p class="text-sm text-gray-500">Klik marker untuk detail intervensi</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-blue-500 rounded-full mr-2"></div>
                                    <span class="text-sm text-gray-600">Intervensi</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-green-500 rounded-full mr-2"></div>
                                    <span class="text-sm text-gray-600">Wilayah Aman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div id="disease-map" style="height: 650px; width: 100%; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);"></div>
                    </div>
                    <div class="p-6 bg-gray-50">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span>🗺️ Zoom & pan untuk navigasi | Ctrl+drag untuk zoom</span>
                            <span class="font-medium">Data: {{ now()->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Chart Section -->
                <div id="chart-section" class="bg-white rounded-2xl shadow-lg overflow-hidden glass-effect hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700" style="font-family: 'Inter', sans-serif;">Grafik Distribusi Intervensi</h3>
                                <p class="text-sm text-gray-500">Statistik per wilayah</p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-blue-600 stats-number">{{ array_sum(array_column($data['disease_distribution'] ?? [], 'count')) ?? 0 }}</div>
                                <div class="text-sm text-gray-500">Total Intervensi</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="chart-container">
                            <canvas id="disease-chart"></canvas>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div class="text-center">
                                <div class="text-lg font-bold text-blue-600">{{ count($data['disease_distribution'] ?? []) }}</div>
                                <div class="text-gray-600">Wilayah</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600">100%</div>
                                <div class="text-gray-600">Cakupan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-purple-600">↑ 12%</div>
                                <div class="text-gray-600">Pertumbuhan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-orange-600">24 jam</div>
                                <div class="text-gray-600">Terakhir Update</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Table Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden table-modern">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700" style="font-family: 'Inter', sans-serif;">Tabel Statistik Wilayah</h3>
                <p class="text-sm text-gray-500">Detail distribusi intervensi per wilayah</p>
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-3 py-1 bg-blue-50 text-blue-600 rounded-md text-sm hover:bg-blue-100 transition-colors">Export</button>
                <button class="px-3 py-1 bg-gray-50 text-gray-600 rounded-md text-sm hover:bg-gray-100 transition-colors">Filter</button>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <span>🏠 Wilayah</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <span>📊 Jumlah Intervensi</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <span>🩺 Jenis Penyakit</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <span>📈 Status</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($wilayahs as $index => $dist)
                    <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">{{ substr($dist->nama_desa ?? $dist['name'], 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $dist->nama_desa ?? $dist['name'] }}</div>
                                    <div class="text-sm text-gray-500">Wilayah {{ $index + 1 }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if(($dist->intervention_count ?? $dist['count']) > 10) bg-red-100 text-red-800
                                    @elseif(($dist->intervention_count ?? $dist['count']) > 5) bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $dist->intervention_count ?? $dist['count'] }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $dist->diseases ?? $dist['diseases'] }}">
                                {{ $dist->diseases ?? $dist['diseases'] }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                @if(($dist->intervention_count ?? $dist['count']) > 10) bg-red-100 text-red-800
                                @elseif(($dist->intervention_count ?? $dist['count']) > 5) bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800 @endif">
                                @if(($dist->intervention_count ?? $dist['count']) > 10) ⚠️ Tinggi
                                @elseif(($dist->intervention_count ?? $dist['count']) > 5) ⚡ Sedang
                                @else ✅ Rendah @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
        <div class="flex items-center justify-between text-sm text-gray-600">
            <span>Menampilkan {{ $wilayahs->count() }} dari {{ $wilayahs->total() }} wilayah</span>
            <div class="flex items-center space-x-4">
                <span class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                    Rendah (≤5)
                </span>
                <span class="flex items-center">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                    Sedang (6-10)
                </span>
                <span class="flex items-center">
                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                    Tinggi (>10)
                </span>
            </div>
        </div>
        <div class="mt-4">
            {{ $wilayahs->links() }}
        </div>
    </div>
</div>
    </main>
    @elseif ($role == 'kades')
    {{-- Enhanced Kades Dashboard --}}
    <main class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{-- Enhanced Greeting for Kades --}}
            <div class="welcome-animation dashboard-gradient p-8 md:p-10 rounded-3xl shadow-2xl mb-10 text-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white rounded-full -ml-24 -mb-24"></div>
                </div>
                <div class="relative z-10">
                    <h1 class="text-3xl sm:text-4xl font-extrabold mb-2" style="font-family: 'Inter', sans-serif;">
                        Selamat Datang, Kepala Desa! 👋
                    </h1>
                    <p class="text-xl text-white/90 mb-3" style="font-family: 'Inter', sans-serif;">
                        Pantau kesehatan masyarakat desa Anda secara real-time
                    </p>
                    <p class="text-base text-white/70" style="font-family: 'Inter', sans-serif;">
                        Dashboard ini dirancang khusus untuk mendukung pengambilan keputusan berbasis data kesehatan desa.
                    </p>
                </div>
            </div>

            <div class="section-spacing">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800" style="font-family: 'Inter', sans-serif;">Ringkasan Utama Desa</h2>
                    <div class="text-sm text-gray-500 bg-gray-50 px-3 py-1 rounded-full">
                        Data Real-time • {{ now()->format('d M Y') }}
                    </div>
                </div>

                <!-- Enhanced Kades Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 grid-animation">
                    <!-- Total Penduduk Desa -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border-gradient-green h-full relative overflow-hidden card-hover">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-400/20 to-emerald-400/20 rounded-full -mr-10 -mt-10"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-green-50 rounded-xl">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.523-.213-1.009-.594-1.356M2 17V9a4 4 0 014-4h14a4 4 0 014 4v8m-16 0v2c0 .523.213 1.009.594 1.356M2 17h18M5 17h.01M17 17h.01M6 10h.01M12 10h.01M18 10h.01"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-gray-900 stats-number">{{ $data['total_penduduk_desa'] ?? 0 }}</div>
                                </div>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Penduduk Desa</h3>
                            <p class="text-xs text-green-600 font-medium">Data Penduduk Lengkap</p>
                        </div>
                    </div>

                    <!-- Total Intervensi Desa -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border-gradient-blue h-full relative overflow-hidden card-hover">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-400/20 to-indigo-400/20 rounded-full -mr-10 -mt-10"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-blue-50 rounded-xl">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M12 16h.01"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-gray-900 stats-number">{{ $data['total_intervensi_desa'] ?? 0 }}</div>
                                </div>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-600 mb-1">Intervensi Kesehatan</h3>
                            <p class="text-xs text-blue-600 font-medium">Tindakan Terlaksana</p>
                        </div>
                    </div>

                    <!-- Alert Kesehatan -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border-gradient-yellow h-full relative overflow-hidden card-hover">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-yellow-400/20 to-orange-400/20 rounded-full -mr-10 -mt-10"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-yellow-50 rounded-xl">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-gray-900 stats-number">{{ $data['alert_kesehatan'] ?? 0 }}</div>
                                </div>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-600 mb-1">Alert Kesehatan</h3>
                            <p class="text-xs text-yellow-600 font-medium">Kasus Perlu Perhatian</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-spacing">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800" style="font-family: 'Inter', sans-serif;">Ringkasan Data Desa</h2>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-1 bg-blue-50 text-blue-600 rounded-md text-sm hover:bg-blue-100 transition-colors">Export Data</button>
                        <button class="px-3 py-1 bg-gray-50 text-gray-600 rounded-md text-sm hover:bg-gray-100 transition-colors">Filter</button>
                    </div>
                </div>

                <!-- Enhanced Kades Table -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden table-modern">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-green-50 to-blue-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <span>📋 Kategori</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <span>🔢 Jumlah</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <span>📊 Status</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <span>⏰ Terakhir Update</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr class="hover:bg-green-50/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Penduduk Terdata</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            {{ $data['total_penduduk_desa'] ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            ✅ Lengkap
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ now()->format('d M Y') }}
                                    </td>
                                </tr>
                                <tr class="hover:bg-green-50/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Intervensi Bulan Ini</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $data['intervensi_bulan_ini'] ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            🔄 Aktif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ now()->format('d M Y') }}
                                    </td>
                                </tr>
                                <tr class="hover:bg-green-50/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Kasus Penyakit</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            {{ $data['kasus_penyakit'] ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            👁️ Monitoring
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ now()->format('d M Y') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 bg-green-50 border-t border-green-100">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span>Data desa Anda telah terintegrasi dengan sistem Sentra Sehat</span>
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                    Terintegrasi
                                </span>
                                <span class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                    Real-time
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @else
    <!-- Tampilan Default/Guest (Untuk role lain yang belum diatur) -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8 border-l-4 border-red-500">
        <p class="text-xl font-semibold text-gray-700">Akses Terbatas</p>
        <p class="text-sm text-gray-500">Dashboard Anda sedang disiapkan. Silakan hubungi administrator jika Anda memerlukan akses ke modul tertentu.</p>
    </div>
    @endif

@endsection

@if ($role == 'super_admin' || $role == 'puskesmas_admin' || $role == 'dokter')
<script>
function initDiseaseMap() {
    // Toggle functionality for map and chart views
    const mapToggle = document.getElementById('map-toggle');
    const chartToggle = document.getElementById('chart-toggle');
    const mapSection = document.getElementById('map-section');
    const chartSection = document.getElementById('chart-section');

    if (mapToggle && chartToggle && mapSection && chartSection) {
        mapToggle.addEventListener('click', function() {
            mapSection.classList.remove('hidden');
            chartSection.classList.add('hidden');
            mapToggle.classList.remove('bg-gray-100', 'hover:bg-gray-200');
            mapToggle.classList.add('bg-gray-600', 'text-white', 'hover:bg-gray-700');
            chartToggle.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            chartToggle.classList.add('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700');
        });

        chartToggle.addEventListener('click', function() {
            chartSection.classList.remove('hidden');
            mapSection.classList.add('hidden');
            chartToggle.classList.remove('bg-gray-100', 'hover:bg-gray-200');
            chartToggle.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            mapToggle.classList.remove('bg-gray-600', 'text-white', 'hover:bg-gray-700');
            mapToggle.classList.add('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700');
        });
    }

    // --- GOOGLE MAPS   ---
    var map = new google.maps.Map(document.getElementById('disease-map'), {
        center: { lat: -5.4, lng: 119.6 }, // Takalar
        zoom: 10,
        mapTypeId: 'roadmap'
        // styles: [ ... ] // HAPUS agar map default
    });

    var markers = [];
    var data = @json($data['disease_distribution'] ?? []);
    var bounds = new google.maps.LatLngBounds();
    data.forEach(function(dist) {
        var color = dist.count > 10 ? '#ef4444' : (dist.count > 5 ? '#facc15' : '#22c55e');
        var radius = Math.max(300, Math.min(1200, dist.count * 80)); // radius meter
        var circle = new google.maps.Circle({
            strokeColor: color,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: color,
            fillOpacity: 0.35,
            map: map,
            center: { lat: dist.lat, lng: dist.lng },
            radius: radius
        });
        bounds.extend(new google.maps.LatLng(dist.lat, dist.lng));
        var infoWindow = new google.maps.InfoWindow({
            content: `<div style=\"font-family:'Inter',sans-serif;min-width:200px;\">
                <h4 style=\"margin:0 0 8px 0;color:#202124;font-size:16px;font-weight:500;\">${dist.name}</h4>
                <div style=\"display:flex;align-items:center;margin-bottom:4px;\">
                    <div style=\"width:12px;height:12px;background:${color};border-radius:50%;margin-right:8px;\"></div>
                    <span style=\"color:#5f6368;font-size:14px;\">${dist.count} intervensi</span>
                </div>
                <div style=\"margin-top:8px;padding-top:8px;border-top:1px solid #e8eaed;\">
                    <strong style=\"color:#202124;font-size:12px;\">Penyakit:</strong><br>
                    <span style=\"color:#5f6368;font-size:12px;\">${dist.diseases}</span>
                </div>
            </div>`
        });
        circle.addListener('click', function(ev) {
            infoWindow.setPosition(circle.getCenter());
            infoWindow.open(map);
        });
    });
    if (data.length > 0) {
        map.fitBounds(bounds);
    }

    // --- CHART JS ---
    var ctx = document.getElementById('disease-chart').getContext('2d');
    var chartData = @json($data['disease_distribution'] ?? []);
    var labels = chartData.map(item => item.name);
    var counts = chartData.map(item => item.count);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Intervensi',
                data: counts,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
</script>
@endif
