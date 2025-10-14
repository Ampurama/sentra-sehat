@extends('layouts.guest')

@section('title', 'Dashboard Pasien - Sentra Sehat')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    /* Enhanced Animated Background */
    .animated-bg {
        background: linear-gradient(135deg, #e0f2fe 0%, #f0fdf4 30%, #fef3c7 60%, #fce7f3 100%);
        position: relative;
        overflow: hidden;
    }

    .animated-bg::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: 
            radial-gradient(circle at 20% 30%, rgba(20, 184, 166, 0.15) 0%, transparent 40%),
            radial-gradient(circle at 80% 70%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
            radial-gradient(circle at 50% 50%, rgba(249, 115, 22, 0.1) 0%, transparent 50%);
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        33% { transform: translate(30px, -30px) rotate(120deg); }
        66% { transform: translate(-20px, 20px) rotate(240deg); }
    }

    /* Enhanced Glassmorphism */
    .glass {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px) saturate(200%);
        -webkit-backdrop-filter: blur(20px) saturate(200%);
        border: 1.5px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    }

    /* Enhanced Card Hover Effect */
    .card-modern {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        background: white;
    }

    .card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #14b8a6, #06b6d4, #8b5cf6);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s ease;
    }

    .card-modern::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(20, 184, 166, 0.1) 0%, transparent 50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card-modern:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .card-modern:hover::before {
        transform: scaleX(1);
    }

    .card-modern:hover::after {
        opacity: 1;
    }

    /* Enhanced Nav Link */
    .nav-link {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #14b8a6 0%, #06b6d4 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
    }

    .nav-link.active::before {
        opacity: 1;
    }

    .nav-link.active {
        color: white;
        box-shadow: 0 6px 20px rgba(20, 184, 166, 0.4);
        transform: translateY(-2px);
    }

    .nav-link:not(.active):hover {
        background: linear-gradient(135deg, rgba(20, 184, 166, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
        color: #0d9488;
        transform: translateY(-2px);
    }

    /* Enhanced Avatar Animation */
    .avatar-glow {
        animation: glow 3s ease-in-out infinite;
        position: relative;
    }

    .avatar-glow::after {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        background: linear-gradient(45deg, #14b8a6, #06b6d4, #8b5cf6, #ec4899);
        z-index: -1;
        animation: rotate 4s linear infinite;
        opacity: 0.5;
    }

    @keyframes glow {
        0%, 100% { box-shadow: 0 0 30px rgba(20, 184, 166, 0.5); }
        50% { box-shadow: 0 0 50px rgba(20, 184, 166, 0.8), 0 0 80px rgba(6, 182, 212, 0.5); }
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Enhanced Timeline */
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 32px;
        width: 3px;
        height: calc(100% - 32px);
        background: linear-gradient(to bottom, #14b8a6, #06b6d4, transparent);
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-dot {
        position: absolute;
        left: 0;
        top: 8px;
        width: 24px;
        height: 24px;
        background: linear-gradient(135deg, #14b8a6, #06b6d4);
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.4);
        animation: pulse-dot 2s ease-in-out infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { transform: scale(1); box-shadow: 0 4px 12px rgba(20, 184, 166, 0.4); }
        50% { transform: scale(1.1); box-shadow: 0 6px 20px rgba(20, 184, 166, 0.6); }
    }

    /* Enhanced Pulse Animation */
    @keyframes pulse-ring {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(2); opacity: 0; }
    }

    .pulse-dot {
        position: relative;
    }

    .pulse-dot::after {
        content: '';
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        border: 3px solid currentColor;
        animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Gradient Text Animation */
    .gradient-text {
        background: linear-gradient(90deg, #14b8a6, #06b6d4, #8b5cf6, #ec4899);
        background-size: 300% 100%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradient-shift 5s ease infinite;
    }

    @keyframes gradient-shift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Enhanced Status Badge */
    .status-badge {
        position: relative;
        overflow: hidden;
    }

    .status-badge::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shine 3s ease-in-out infinite;
    }

    @keyframes shine {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    /* Icon Bounce */
    .icon-bounce {
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }

    /* Data Grid Enhancement */
    .data-item {
        transition: all 0.3s ease;
    }

    .data-item:hover {
        background: linear-gradient(90deg, rgba(20, 184, 166, 0.05), transparent);
        padding-left: 1rem;
    }

    /* Button Enhancement */
    .btn-logout {
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .btn-logout::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, #ef4444, #dc2626);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .btn-logout:hover::before {
        opacity: 1;
    }

    .btn-logout:hover {
        color: white;
        border-color: #dc2626;
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 20px 40px rgba(239, 68, 68, 0.3);
    }

    .btn-logout span {
        position: relative;
        z-index: 1;
    }

    /* Stats Number Animation */
    .stat-number {
        font-feature-settings: 'tnum';
        font-variant-numeric: tabular-nums;
    }

    /* Enhanced Tips Card */
    .tip-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .tip-card:hover {
        transform: translateY(-8px) rotate(2deg);
    }

    .tip-card:nth-child(even):hover {
        transform: translateY(-8px) rotate(-2deg);
    }

    .tip-icon {
        transition: all 0.4s ease;
    }

    .tip-card:hover .tip-icon {
        transform: scale(1.2) rotate(360deg);
    }
</style>
@endpush

@section('content')
<div class="animated-bg min-h-screen">

    <!-- Header Section -->
    <header class="py-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Avatar -->
                <div class="mb-8 relative inline-block">
                    <img class="w-32 h-32 rounded-full mx-auto border-4 border-white shadow-2xl avatar-glow" 
                         src="https://ui-avatars.com/api/?name={{ urlencode($penduduk->nama) }}&background=14b8a6&color=fff&size=128" 
                         alt="Avatar {{ $penduduk->nama }}">
                </div>
                
                <!-- Greeting -->
                <h1 class="text-6xl md:text-7xl font-black text-gray-900 mb-4 tracking-tight">
                    Halo, <span class="gradient-text">{{ explode(' ', $penduduk->nama)[0] }}</span>!
                </h1>
                <p class="text-2xl text-gray-600 font-semibold mb-8">
                    Selamat datang kembali di portal kesehatan Anda
                </p>
                
                <!-- Quick Status -->
                <div class="mt-10 inline-flex items-center gap-4 glass px-8 py-4 rounded-full shadow-2xl status-badge">
                    <div class="relative w-4 h-4 bg-green-500 rounded-full pulse-dot"></div>
                    <span class="text-base font-bold text-gray-800">Status Kesehatan: Baik</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="sticky top-4 z-50 mb-16">
        <div class="max-w-4xl mx-auto px-4">
            <div class="glass rounded-3xl shadow-2xl p-3 flex items-center justify-around gap-3">
                <a href="#info" class="nav-link active flex-1 text-center px-6 py-4 rounded-2xl font-bold text-lg">
                    <span class="hidden md:inline">Info Pribadi</span>
                    <span class="md:hidden">
                        <svg class="w-7 h-7 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                </a>
                <a href="#klinis" class="nav-link flex-1 text-center px-6 py-4 rounded-2xl font-bold text-lg text-gray-600">
                    <span class="hidden md:inline">Data Klinis</span>
                    <span class="md:hidden">
                        <svg class="w-7 h-7 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </span>
                </a>
                <a href="#riwayat" class="nav-link flex-1 text-center px-6 py-4 rounded-2xl font-bold text-lg text-gray-600">
                    <span class="hidden md:inline">Riwayat</span>
                    <span class="md:hidden">
                        <svg class="w-7 h-7 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                
                <!-- Info Pribadi -->
                <section id="info" class="card-modern bg-white rounded-3xl shadow-2xl p-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg icon-bounce">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900">Informasi Pribadi</h3>
                    </div>
                    
                    <dl class="space-y-2">
                        <div class="flex justify-between items-center py-4 border-b border-gray-100 data-item">
                            <dt class="text-sm text-gray-500 font-semibold">NIK</dt>
                            <dd class="text-sm font-black text-gray-900 stat-number">{{ $penduduk->NIK }}</dd>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-gray-100 data-item">
                            <dt class="text-sm text-gray-500 font-semibold">Jenis Kelamin</dt>
                            <dd class="text-sm font-black text-gray-900">{{ $penduduk->JK == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-gray-100 data-item">
                            <dt class="text-sm text-gray-500 font-semibold">Tanggal Lahir</dt>
                            <dd class="text-sm font-black text-gray-900">{{ $penduduk->TTL ? \Carbon\Carbon::parse($penduduk->TTL)->format('d M Y') : '-' }}</dd>
                        </div>
                        <div class="py-4 border-b border-gray-100 data-item">
                            <dt class="text-sm text-gray-500 font-semibold mb-3">Alamat</dt>
                            <dd class="text-sm font-black text-gray-900 leading-relaxed">{{ $penduduk->alamat_lengkap }}</dd>
                        </div>
                        <div class="flex justify-between items-center py-4 data-item">
                            <dt class="text-sm text-gray-500 font-semibold">Wilayah</dt>
                            <dd class="text-sm font-black text-gray-900">{{ $penduduk->wilayah ? $penduduk->wilayah->nama_desa . ', ' . $penduduk->wilayah->nama_kecamatan : '-' }}</dd>
                        </div>
                    </dl>
                </section>

                <!-- Status Kesehatan -->
                <section class="card-modern bg-gradient-to-br from-teal-50 via-cyan-50 to-blue-50 rounded-3xl shadow-2xl p-8 border-2 border-teal-200">
                    <h3 class="text-2xl font-black text-gray-900 mb-8 text-center">Status Kesehatan</h3>
                    <div class="text-center">
                        <div class="w-36 h-36 bg-gradient-to-br from-green-400 via-emerald-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl relative">
                            <div class="absolute inset-0 rounded-full bg-green-400 animate-ping opacity-20"></div>
                            <svg class="w-16 h-16 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="font-black text-gray-900 text-xl mb-6">Kondisi Terpantau Baik</p>
                        <div class="space-y-3">
                            <div class="inline-flex items-center bg-green-100 text-green-800 px-5 py-3 rounded-2xl font-bold text-sm shadow-lg">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                                Tekanan Darah Normal
                            </div>
                            <div class="inline-flex items-center bg-blue-100 text-blue-800 px-5 py-3 rounded-2xl font-bold text-sm ml-2 shadow-lg">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-3 animate-pulse"></div>
                                Berat Badan Ideal
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-10">
                
                <!-- Data Klinis -->
                <section id="klinis" class="card-modern bg-white rounded-3xl shadow-2xl p-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl flex items-center justify-center shadow-lg icon-bounce">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900">Data Klinis Terakhir</h3>
                    </div>

                    @if($penduduk->data_klinis_ringkas || $penduduk->diagnosis_utama)
                    <div class="space-y-6">
                        @if($penduduk->data_klinis_ringkas)
                        <div class="bg-gradient-to-r from-gray-50 via-gray-100 to-gray-50 p-6 rounded-2xl border-2 border-gray-200 shadow-lg">
                            <h4 class="font-black text-base text-gray-800 mb-3 flex items-center gap-3">
                                <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Ringkasan Klinis
                            </h4>
                            <p class="text-sm text-gray-700 leading-relaxed font-medium">{{ $penduduk->data_klinis_ringkas }}</p>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($penduduk->diagnosis_utama)
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-2xl border-2 border-red-200 shadow-lg">
                                <h4 class="font-black text-base text-red-800 mb-3">Diagnosis Utama</h4>
                                <p class="text-sm text-red-900 font-bold">{{ $penduduk->diagnosis_utama }}</p>
                            </div>
                            @endif
                            
                            @if($penduduk->diagnosis_penyerta)
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-2xl border-2 border-yellow-200 shadow-lg">
                                <h4 class="font-black text-base text-yellow-800 mb-3">Diagnosis Penyerta</h4>
                                <p class="text-sm text-yellow-900 font-bold">{{ $penduduk->diagnosis_penyerta }}</p>
                            </div>
                            @endif
                            
                            @if($penduduk->tindakan_perawatan)
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl border-2 border-blue-200 md:col-span-2 shadow-lg">
                                <h4 class="font-black text-base text-blue-800 mb-3">Tindakan Perawatan</h4>
                                <p class="text-sm text-blue-900 font-bold whitespace-pre-line">{{ $penduduk->tindakan_perawatan }}</p>
                            </div>
                            @endif
                            
                            @if($penduduk->obat_pulang)
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl border-2 border-green-200 md:col-span-2 shadow-lg">
                                <h4 class="font-black text-base text-green-800 mb-3">Obat yang Diresepkan</h4>
                                <p class="text-sm text-green-900 font-bold whitespace-pre-line">{{ $penduduk->obat_pulang }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="text-center py-16">
                        <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-500 font-black text-lg">Belum ada data klinis</p>
                        <p class="text-gray-400 text-sm mt-3">Data akan tampil setelah pemeriksaan</p>
                    </div>
                    @endif
                </section>

                <!-- Riwayat Intervensi -->
                <section id="riwayat" class="card-modern bg-white rounded-3xl shadow-2xl p-8">
                    <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg icon-bounce">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">Riwayat Intervensi Medis</h3>
                        </div>
                        <span class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-700 rounded-2xl font-black text-base shadow-lg">
                            Total: <span class="stat-number ml-1">{{ $intervensiHistory->count() }}</span> intervensi
                        </span>
                    </div>

                    @if($intervensiHistory->count() > 0)
                    <div class="space-y-8">
                        @foreach($intervensiHistory as $intervensi)
                        <div class="relative pl-12 timeline-item">
                            <div class="timeline-dot"></div>
                            
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border-2 border-gray-200 p-6 hover:border-teal-300 hover:shadow-2xl transition-all">
                                <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-3">
                                            <h4 class="font-black text-gray-900 text-lg">{{ $intervensi->penyakit ? $intervensi->penyakit->name : 'Intervensi Umum' }}</h4>
                                            @if($intervensi->penyakit)
                                            <span class="text-xs bg-gradient-to-r from-teal-100 to-cyan-100 text-teal-700 px-3 py-1.5 rounded-lg font-black shadow-sm">{{ $intervensi->penyakit->icd_code }}</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 font-medium leading-relaxed">{{ $intervensi->deskripsi_intervensi }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-black shadow-lg
                                        @if($intervensi->status_intervensi == 'selesai') bg-gradient-to-r from-green-100 to-emerald-100 text-green-700
                                        @elseif($intervensi->status_intervensi == 'proses') bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-700
                                        @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 @endif">
                                        {{ ucfirst($intervensi->status_intervensi) }}
                                    </span>
                                </div>
                                
                                <div class="border-t-2 border-gray-200 my-5"></div>
                                
                                <div class="flex flex-wrap justify-between items-center gap-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-3 font-semibold">
                                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span><strong class="text-gray-900">{{ $intervensi->petugas ? $intervensi->petugas->name : 'N/A' }}</strong></span>
                                    </div>
                                    <div class="flex items-center gap-3 font-semibold">
                                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-gray-900">{{ \Carbon\Carbon::parse($intervensi->created_at)->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>

                                @if($intervensi->rencanaLanjutan)
                                <div class="mt-6 p-5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-200 shadow-inner">
                                    <h5 class="text-sm font-black text-blue-900 mb-4 flex items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        Rencana Tindak Lanjut
                                    </h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        @if($intervensi->rencanaLanjutan->jadwal_kontrol_berikutnya)
                                        <div class="bg-white/50 p-3 rounded-lg">
                                            <span class="text-blue-600 font-bold">Jadwal Kontrol:</span> 
                                            <strong class="text-blue-900">{{ \Carbon\Carbon::parse($intervensi->rencanaLanjutan->jadwal_kontrol_berikutnya)->format('d F Y') }}</strong>
                                        </div>
                                        @endif
                                        @if($intervensi->rencanaLanjutan->terapi_lanjutan)
                                        <div class="bg-white/50 p-3 rounded-lg">
                                            <span class="text-blue-600 font-bold">Terapi Lanjutan:</span> 
                                            <span class="text-blue-900 font-semibold">{{ $intervensi->rencanaLanjutan->terapi_lanjutan }}</span>
                                        </div>
                                        @endif
                                        @if($intervensi->rencanaLanjutan->keluhan_komplikasi)
                                        <div class="md:col-span-2 bg-white/50 p-3 rounded-lg">
                                            <span class="text-blue-600 font-bold">Keluhan/Komplikasi:</span> 
                                            <span class="text-blue-900 font-semibold">{{ $intervensi->rencanaLanjutan->keluhan_komplikasi }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-16 border-2 border-dashed border-gray-300 rounded-3xl bg-gray-50">
                        <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-xl font-black text-gray-900 mb-3">Belum ada riwayat intervensi</h3>
                        <p class="text-sm text-gray-500 font-medium">Semua catatan medis Anda akan muncul di sini</p>
                    </div>
                    @endif
                </section>
            </div>
        </div>

        <!-- Tips Kesehatan -->
        <section class="mt-16">
            <div class="text-center mb-12">
                <h3 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Tips Kesehatan Hari Ini</h3>
                <p class="text-xl text-gray-600 font-semibold">Jaga kesehatan Anda dengan tips praktis berikut</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Tip 1 -->
                <div class="tip-card card-modern bg-gradient-to-br from-teal-50 via-cyan-50 to-teal-100 rounded-3xl shadow-2xl p-8 border-2 border-teal-200">
                    <div class="flex items-start gap-5">
                        <div class="tip-icon flex-shrink-0 w-16 h-16 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 mb-3 text-lg">Olahraga Rutin</h4>
                            <p class="text-sm text-gray-700 leading-relaxed font-medium">Lakukan aktivitas fisik minimal 30 menit setiap hari untuk menjaga kesehatan jantung</p>
                        </div>
                    </div>
                </div>

                <!-- Tip 2 -->
                <div class="tip-card card-modern bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-100 rounded-3xl shadow-2xl p-8 border-2 border-blue-200">
                    <div class="flex items-start gap-5">
                        <div class="tip-icon flex-shrink-0 w-16 h-16 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 mb-3 text-lg">Tidur Cukup</h4>
                            <p class="text-sm text-gray-700 leading-relaxed font-medium">Pastikan tidur 7-8 jam setiap malam untuk pemulihan tubuh yang optimal</p>
                        </div>
                    </div>
                </div>

                <!-- Tip 3 -->
                <div class="tip-card card-modern bg-gradient-to-br from-green-50 via-emerald-50 to-green-100 rounded-3xl shadow-2xl p-8 border-2 border-green-200">
                    <div class="flex items-start gap-5">
                        <div class="tip-icon flex-shrink-0 w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 mb-3 text-lg">Makan Sehat</h4>
                            <p class="text-sm text-gray-700 leading-relaxed font-medium">Konsumsi makanan bergizi seimbang dengan banyak sayur dan buah-buahan segar</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Logout Button -->
        <div class="text-center mt-20">
            <a href="{{ route('patient.logout') }}" class="btn-logout inline-flex items-center gap-4 px-10 py-5 bg-white text-red-600 font-black text-lg rounded-3xl transition-all duration-500 border-3 border-red-200 shadow-2xl">
                <span class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </span>
            </a>
        </div>
    </main>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('nav a.nav-link');

            // Smooth scroll for nav links
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    
                    if (targetElement) {
                        const offsetTop = targetElement.offsetTop - 120;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Active nav link on scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        navLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href').substring(1) === entry.target.id) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            }, { 
                rootMargin: '-50% 0px -50% 0px',
                threshold: 0
            });

            sections.forEach(section => {
                observer.observe(section);
            });

            // Add entrance animations
            const cards = document.querySelectorAll('.card-modern');
            const cardObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                        cardObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                cardObserver.observe(card);
            });

            // Card mouse follow effect
            cards.forEach(card => {
                card.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width) * 100;
                    const y = ((e.clientY - rect.top) / rect.height) * 100;
                    this.style.setProperty('--mouse-x', x + '%');
                    this.style.setProperty('--mouse-y', y + '%');
                });
            });

            // Animate numbers
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalValue = stat.textContent;
                if (!isNaN(finalValue)) {
                    let currentValue = 0;
                    const increment = Math.ceil(finalValue / 50);
                    const timer = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= finalValue) {
                            stat.textContent = finalValue;
                            clearInterval(timer);
                        } else {
                            stat.textContent = currentValue;
                        }
                    }, 30);
                }
            });
        });
    </script>
</div>
@endsection