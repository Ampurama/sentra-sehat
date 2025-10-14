@extends('layouts.app')

@section('title', 'Dashboard Utama')

@section('content')

<script src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapsKey }}&callback=initDiseaseMap" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    --warning-gradient: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%);
    --danger-gradient: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
}

* {
    font-family: 'Inter', sans-serif;
}

body {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

/* Enhanced Dashboard Hero Section */
.hero-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00f2fe 100%);
    background-size: 400% 400%;
    animation: gradientFlow 15s ease infinite;
    position: relative;
    overflow: hidden;
}

.hero-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 30% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(255,255,255,0.1) 0%, transparent 50%);
    animation: float 8s ease-in-out infinite;
}

@keyframes gradientFlow {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

@keyframes float {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-20px) scale(1.05); }
}

/* Ultra Modern Card Design */
.modern-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px) saturate(180%);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.08),
        0 2px 8px rgba(0, 0, 0, 0.04),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.modern-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.modern-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 
        0 20px 48px rgba(0, 0, 0, 0.12),
        0 8px 16px rgba(0, 0, 0, 0.08),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
}

.modern-card:hover::before {
    transform: scaleX(1);
}

/* Animated Icon Container */
.icon-glow {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 64px;
    height: 64px;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.icon-glow::before {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 22px;
    padding: 2px;
    background: linear-gradient(45deg, transparent, currentColor, transparent);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.modern-card:hover .icon-glow::before {
    opacity: 1;
    animation: rotate 3s linear infinite;
}

@keyframes rotate {
    to { transform: rotate(360deg); }
}

/* Gradient Text */
.gradient-text {
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
}

/* Enhanced Stats Badge */
.stats-badge {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.stats-badge:hover {
    transform: scale(1.05);
}

/* Animated Button */
.premium-btn {
    position: relative;
    padding: 12px 32px;
    border-radius: 16px;
    background: var(--primary-gradient);
    color: white;
    font-weight: 600;
    border: none;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.premium-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.premium-btn:hover::before {
    width: 300px;
    height: 300px;
}

.premium-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

/* Enhanced Table */
.ultra-table {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    background: white;
}

.ultra-table thead {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    position: relative;
}

.ultra-table thead::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--primary-gradient);
}

.ultra-table tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f5f9;
}

.ultra-table tbody tr:hover {
    background: linear-gradient(90deg, rgba(102, 126, 234, 0.05) 0%, transparent 100%);
    transform: scale(1.01);
}

/* Map Container Enhancement */
.map-wrapper {
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 
        0 20px 60px rgba(0, 0, 0, 0.12),
        0 8px 24px rgba(0, 0, 0, 0.08);
    position: relative;
}

.map-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border: 2px solid transparent;
    border-radius: 24px;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.3), rgba(118, 75, 162, 0.3)) border-box;
    -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    pointer-events: none;
}

/* Quick Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.stat-item {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 20px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.stat-item:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-4px);
}

/* Pulse Animation for Live Data */
.live-indicator {
    position: relative;
    display: inline-block;
    width: 8px;
    height: 8px;
    background: #22c55e;
    border-radius: 50%;
    margin-right: 8px;
}

.live-indicator::before {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 2px solid #22c55e;
    animation: pulse 2s ease-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.5); opacity: 0; }
}

/* Smooth Fade In Animation */
.fade-in {
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
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

.fade-in-delay-1 { animation-delay: 0.1s; }
.fade-in-delay-2 { animation-delay: 0.2s; }
.fade-in-delay-3 { animation-delay: 0.3s; }
.fade-in-delay-4 { animation-delay: 0.4s; }

/* Toggle Switch Style */
.toggle-group {
    display: inline-flex;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    padding: 4px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.toggle-btn {
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    background: transparent;
    color: #64748b;
}

.toggle-btn.active {
    background: var(--primary-gradient);
    color: white;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .modern-card {
        border-radius: 16px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: var(--primary-gradient);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5568d3 0%, #6a3d8f 100%);
}
</style>

<!-- Hero Section -->
<div class="hero-gradient p-8 md:p-12 rounded-3xl shadow-2xl mb-10 text-white relative fade-in">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-white rounded-full blur-3xl -ml-36 -mb-36"></div>
    </div>

    <div class="relative z-10">
        <div class="flex items-start justify-between flex-wrap gap-6 mb-8">
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 mb-4">
                    <div class="live-indicator"></div>
                    <span class="text-sm font-medium text-white/90">Live Dashboard</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black mb-3 tracking-tight">
                    Selamat Datang, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-2 font-medium">
                    Sentra Sehat Dashboard
                </p>
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/30">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                    </svg>
                    <span class="font-bold text-sm uppercase tracking-wider">{{ $role }}</span>
                </div>
            </div>

            @if ($role == 'super_admin' || $role == 'puskesmas_admin' || $role == 'dokter')
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('patient.login.form') }}" class="premium-btn inline-flex items-center gap-2 relative z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Portal Pasien
                </a>
                @if ($role == 'super_admin')
                <a href="{{ route('users.create_puskesmas_admin') }}" class="premium-btn inline-flex items-center gap-2 relative z-10" style="background: var(--success-gradient);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Add Puskesmas
                </a>
                @endif
            </div>
            @endif
        </div>

        <!-- Quick Stats Preview -->
        <div class="stats-grid">
            @if($role == 'kades')
            <div class="stat-item fade-in-delay-1">
                <div class="text-3xl font-black gradient-text">{{ $data['total_penduduk_desa'] ?? 0 }}</div>
                <div class="text-sm text-white/80 font-medium mt-1">Penduduk Desa</div>
            </div>
            <div class="stat-item fade-in-delay-2">
                <div class="text-3xl font-black gradient-text">{{ $data['total_intervensi_desa'] ?? 0 }}</div>
                <div class="text-sm text-white/80 font-medium mt-1">Intervensi Desa</div>
            </div>
            <div class="stat-item fade-in-delay-3">
                <div class="text-3xl font-black gradient-text">{{ $data['intervensi_bulan_ini'] ?? 0 }}</div>
                <div class="text-sm text-white/80 font-medium mt-1">Intervensi Bulan Ini</div>
            </div>
            <div class="stat-item fade-in-delay-4">
                <div class="text-3xl font-black gradient-text">{{ $data['kasus_penyakit'] ?? 0 }}</div>
                <div class="text-sm text-white/80 font-medium mt-1">Kasus Penyakit</div>
            </div>
            @else
            <div class="stat-item fade-in-delay-1">
                <div class="text-3xl font-black gradient-text">{{ $data['total_penduduk'] ?? 0 }}</div>
                <div class="text-sm text-white/80 font-medium mt-1">Total Penduduk</div>
            </div>
            <div class="stat-item fade-in-delay-2">
                <div class="text-3xl font-black gradient-text">{{ $data['total_intervensi'] ?? 0 }}</div>
                <div class="text-sm text-white/80 font-medium mt-1">Intervensi</div>
            </div>
            <div class="stat-item fade-in-delay-3">
                <div class="text-3xl font-black gradient-text">{{ $data['total_penyakit'] ?? 0 }}</div>
                <div class="text-sm text-white/80 font-medium mt-1">Penyakit</div>
            </div>
            <div class="stat-item fade-in-delay-4">
                <div class="text-3xl font-black gradient-text">{{ $data['total_obat'] ?? 0 }}</div>
                <div class="text-sm text-white/80 font-medium mt-1">Obat</div>
            </div>
            @endif
        </div>
    </div>
</div>

@if ($role == 'super_admin' || $role == 'puskesmas_admin' || $role == 'dokter')
<main>
    <!-- Cards Section -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-black text-gray-800">Ringkasan Data</h2>
                <p class="text-gray-500 mt-1">Akses cepat ke semua modul kesehatan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Card 1: Total Penduduk -->
            <a href="{{ route('penduduk.index') }}" class="block fade-in">
                <div class="modern-card p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-glow" style="background: linear-gradient(135deg, #14b8a6 0%, #06b6d4 100%);">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2c0-1.656 1.344-3 3-3h9c.828 0 1.58.335 2.125.879M15 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-black gradient-text">{{ $data['total_penduduk'] ?? 0 }}</div>
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Penduduk</h3>
                    <p class="text-xs text-teal-600 font-semibold flex items-center gap-1">
                        Lihat Detail
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </div>
            </a>

            <!-- Card 2: Total Intervensi -->
            <a href="{{ route('intervensi.index') }}" class="block fade-in-delay-1">
                <div class="modern-card p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-glow" style="background: linear-gradient(135deg, #ef4444 0%, #f97316 100%);">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-black gradient-text">{{ $data['total_intervensi'] ?? 0 }}</div>
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Intervensi</h3>
                    <p class="text-xs text-red-600 font-semibold flex items-center gap-1">
                        Kelola Tindakan
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </div>
            </a>

            <!-- Card 3: Total Obat -->
            <a href="{{ route('obat.index') }}" class="block fade-in-delay-2">
                <div class="modern-card p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-glow" style="background: linear-gradient(135deg, #a855f7 0%, #c084fc 100%);">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-black gradient-text">{{ $data['total_obat'] ?? 0 }}</div>
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Obat</h3>
                    <p class="text-xs text-purple-600 font-semibold flex items-center gap-1">
                        Kelola Stok
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </div>
            </a>

            <!-- Card 4: Kesehatan Lingkungan -->
            <a href="{{ route('kesehatan_lingkungan.index') }}" class="block fade-in-delay-3">
                <div class="modern-card p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-glow" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-black gradient-text">{{ $data['total_lingkungan'] ?? 0 }}</div>
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Kesehatan Lingkungan</h3>
                    <p class="text-xs text-green-600 font-semibold flex items-center gap-1">
                        Kelola Data
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </div>
            </a>

            <!-- Additional Cards (5-9) with similar pattern -->
            <a href="{{ route('penyakit.index') }}" class="block fade-in">
                <div class="modern-card p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-glow" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-black gradient-text">{{ $data['total_penyakit'] ?? 0 }}</div>
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Data Penyakit</h3>
                    <p class="text-xs text-orange-600 font-semibold flex items-center gap-1">
                        Kelola Penyakit
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </div>
            </a>

            <a href="{{ route('kesehatan_gizi.index') }}" class="block fade-in-delay-1">
                <div class="modern-card p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-glow" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-black gradient-text">{{ $data['total_gizi'] ?? 0 }}</div>
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Kesehatan Gizi</h3>
                    <p class="text-xs text-indigo-600 font-semibold flex items-center gap-1">
                        Kelola Data Gizi
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </div>
            </a>

            <a href="{{ route('kesehatan_anak_ibu.index') }}" class="block fade-in-delay-2">
                <div class="modern-card p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-glow" style="background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-black gradient-text">{{ $data['total_anak_ibu'] ?? 0 }}</div>
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Kesehatan Anak & Ibu</h3>
                    <p class="text-xs text-pink-600 font-semibold flex items-center gap-1">
                        Kelola Data
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </div>
            </a>

            <a href="{{ route('penduduk.create') }}" class="block fade-in-delay-3">
                <div class="modern-card p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-glow" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-black gradient-text">NEW</div>
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Input Data Baru</h3>
                    <p class="text-xs text-blue-600 font-semibold flex items-center gap-1">
                        Tambah Penduduk
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </div>
            </a>

            <a href="#" class="block fade-in">
                <div class="modern-card p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-glow" style="background: linear-gradient(135deg, #eab308 0%, #f59e0b 100%);">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-black gradient-text">📊</div>
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Laporan Agregat</h3>
                    <p class="text-xs text-yellow-600 font-semibold flex items-center gap-1">
                        Lihat Statistik
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <!-- Map & Chart Section -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-black text-gray-800">Pemetaan Distribusi Penyakit</h2>
                <p class="text-gray-500 mt-1">Visualisasi data intervensi kesehatan per wilayah</p>
            </div>
            <div class="toggle-group">
                <button id="map-toggle" class="toggle-btn active">
                    <span class="flex items-center gap-2">
                        🗺️ Peta
                    </span>
                </button>
                <button id="chart-toggle" class="toggle-btn">
                    <span class="flex items-center gap-2">
                        📊 Grafik
                    </span>
                </button>
            </div>
        </div>

        <!-- Map Section -->
        <div id="map-section" class="modern-card overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Peta Distribusi Wilayah</h3>
                        <p class="text-sm text-gray-600">Klik marker untuk melihat detail intervensi</p>
                    </div>
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);"></div>
                            <span class="text-sm font-medium text-gray-700">Intervensi Tinggi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full" style="background: linear-gradient(135deg, #eab308 0%, #f59e0b 100%);"></div>
                            <span class="text-sm font-medium text-gray-700">Intervensi Sedang</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);"></div>
                            <span class="text-sm font-medium text-gray-700">Intervensi Rendah</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="map-wrapper">
                    <div id="disease-map" style="height: 650px; width: 100%;"></div>
                </div>
            </div>
            <div class="p-6 bg-gradient-to-r from-gray-50 to-blue-50 border-t border-gray-100">
                <div class="flex items-center justify-between flex-wrap gap-4 text-sm">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>🖱️ Zoom & pan untuk navigasi | Ctrl+drag untuk zoom</span>
                    </div>
                    <div class="flex items-center gap-2 font-semibold text-gray-700">
                        <div class="live-indicator"></div>
                        <span>Data Real-time: {{ now()->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div id="chart-section" class="modern-card overflow-hidden hidden">
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Grafik Distribusi Intervensi</h3>
                        <p class="text-sm text-gray-600">Statistik lengkap per wilayah</p>
                    </div>
                    <div class="text-right">
                        <div class="text-5xl font-black gradient-text">{{ array_sum(array_column($data['disease_distribution'] ?? [], 'count')) ?? 0 }}</div>
                        <div class="text-sm text-gray-600 font-medium">Total Intervensi</div>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <div style="height: 400px; position: relative;">
                    <canvas id="disease-chart"></canvas>
                </div>
            </div>
            <div class="p-6 bg-gradient-to-r from-gray-50 to-purple-50 border-t border-gray-100">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-black gradient-text mb-1">{{ count($data['disease_distribution'] ?? []) }}</div>
                        <div class="text-sm text-gray-600 font-medium">Wilayah</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-black gradient-text mb-1">100%</div>
                        <div class="text-sm text-gray-600 font-medium">Cakupan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-black text-green-600 mb-1">↑ 12%</div>
                        <div class="text-sm text-gray-600 font-medium">Pertumbuhan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-black text-blue-600 mb-1">24h</div>
                        <div class="text-sm text-gray-600 font-medium">Update Terakhir</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Table -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-black text-gray-800">Tabel Statistik Wilayah</h2>
                <p class="text-gray-500 mt-1">Detail distribusi intervensi kesehatan</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="premium-btn inline-flex items-center gap-2 text-sm" style="background: var(--success-gradient);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export
                </button>
                <button class="px-4 py-2 bg-white border-2 border-gray-200 rounded-xl font-semibold text-sm text-gray-700 hover:border-gray-300 transition-all">
                    Filter
                </button>
            </div>
        </div>

        <div class="ultra-table">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>🏠</span>
                                    <span>Wilayah</span>
                                </div>
                            </th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>📊</span>
                                    <span>Jumlah Intervensi</span>
                                </div>
                            </th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>🩺</span>
                                    <span>Jenis Penyakit</span>
                                </div>
                            </th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>📈</span>
                                    <span>Status</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wilayahs as $index => $dist)
                        <tr>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-black text-white text-lg"
                                         style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        {{ substr($dist->nama_desa ?? $dist['name'], 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 text-base">{{ $dist->nama_desa ?? $dist['name'] }}</div>
                                        <div class="text-sm text-gray-500">{{ $dist->nama_kecamatan ?? '' }}, {{ $dist->nama_kabupaten ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-base font-bold
                                    @if(($dist->intervention_count ?? $dist['count']) > 10) bg-red-100 text-red-700
                                    @elseif(($dist->intervention_count ?? $dist['count']) > 5) bg-yellow-100 text-yellow-700
                                    @else bg-green-100 text-green-700 @endif">
                                    <span class="w-2 h-2 rounded-full
                                        @if(($dist->intervention_count ?? $dist['count']) > 10) bg-red-500
                                        @elseif(($dist->intervention_count ?? $dist['count']) > 5) bg-yellow-500
                                        @else bg-green-500 @endif">
                                    </span>
                                    {{ $dist->intervention_count ?? $dist['count'] }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm text-gray-700 font-medium max-w-xs">
                                    {{ Str::limit($dist->diseases ?? $dist['diseases'], 50) }}
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold
                                    @if(($dist->intervention_count ?? $dist['count']) > 10) bg-red-100 text-red-700
                                    @elseif(($dist->intervention_count ?? $dist['count']) > 5) bg-yellow-100 text-yellow-700
                                    @else bg-green-100 text-green-700 @endif">
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
            <div class="px-8 py-6 bg-gradient-to-r from-gray-50 to-blue-50 border-t border-gray-100">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="text-sm text-gray-600 font-medium">
                        Menampilkan <span class="font-bold text-gray-900">{{ $wilayahs->count() }}</span> dari 
                        <span class="font-bold text-gray-900">{{ $wilayahs->total() }}</span> wilayah
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <span class="text-sm text-gray-600 font-medium">Rendah (≤5)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <span class="text-sm text-gray-600 font-medium">Sedang (6-10)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <span class="text-sm text-gray-600 font-medium">Tinggi (>10)</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    {{ $wilayahs->links() }}
                </div>
            </div>
        </div>
    </div>
</main>

@elseif ($role == 'kades')
<!-- Kades Dashboard -->
<main>
    <div class="mb-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-black text-gray-800">Ringkasan Utama Desa</h2>
                <p class="text-gray-500 mt-1">Data kesehatan masyarakat desa Anda</p>
            </div>
            <div class="stats-badge" style="background: rgba(34, 197, 94, 0.1); color: #16a34a;">
                <div class="live-indicator"></div>
                Data Real-time • {{ now()->format('d M Y') }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="modern-card p-8 fade-in">
                <div class="flex items-start justify-between mb-6">
                    <div class="icon-glow" style="background: var(--success-gradient);">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2c0-1.656 1.344-3 3-3h9"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-5xl font-black gradient-text">{{ $data['total_penduduk_desa'] ?? 0 }}</div>
                    </div>
                </div>
                <h3 class="text-base font-bold text-gray-700 mb-2">Total Penduduk Desa</h3>
                <p class="text-sm text-green-600 font-semibold">Data Lengkap & Terverifikasi</p>
            </div>

            <div class="modern-card p-8 fade-in-delay-1">
                <div class="flex items-start justify-between mb-6">
                    <div class="icon-glow" style="background: var(--primary-gradient);">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-5xl font-black gradient-text">{{ $data['total_intervensi_desa'] ?? 0 }}</div>
                    </div>
                </div>
                <h3 class="text-base font-bold text-gray-700 mb-2">Intervensi Kesehatan</h3>
                <p class="text-sm text-blue-600 font-semibold">Tindakan Terlaksana</p>
            </div>

            <div class="modern-card p-8 fade-in-delay-2">
                <div class="flex items-start justify-between mb-6">
                    <div class="icon-glow" style="background: var(--warning-gradient);">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-5xl font-black gradient-text">{{ $data['alert_kesehatan'] ?? 0 }}</div>
                    </div>
                </div>
                <h3 class="text-base font-bold text-gray-700 mb-2">Alert Kesehatan</h3>
                <p class="text-sm text-yellow-600 font-semibold">Kasus Perlu Perhatian</p>
            </div>
        </div>
    </div>

    <div class="ultra-table">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-green-50 to-blue-50">
            <h3 class="text-xl font-bold text-gray-800">Ringkasan Data Desa</h3>
            <p class="text-sm text-gray-600 mt-1">Informasi terintegrasi dengan Sentra Sehat</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase">📋 Kategori</th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase">🔢 Jumlah</th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase">📊 Status</th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase">⏰ Update</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-8 py-5 font-bold text-gray-900">Penduduk Terdata</td>
                        <td class="px-8 py-5">
                            <span class="stats-badge" style="background: rgba(34, 197, 94, 0.1); color: #16a34a;">
                                {{ $data['total_penduduk_desa'] ?? 0 }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="stats-badge" style="background: rgba(34, 197, 94, 0.1); color: #16a34a;">
                                ✅ Lengkap
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm text-gray-600 font-medium">{{ now()->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="px-8 py-5 font-bold text-gray-900">Intervensi Bulan Ini</td>
                        <td class="px-8 py-5">
                            <span class="stats-badge" style="background: rgba(59, 130, 246, 0.1); color: #2563eb;">
                                🔄 Aktif
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm text-gray-600 font-medium">{{ now()->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="px-8 py-5 font-bold text-gray-900">Kasus Penyakit</td>
                        <td class="px-8 py-5">
                            <span class="stats-badge" style="background: rgba(234, 179, 8, 0.1); color: #ca8a04;">
                                {{ $data['kasus_penyakit'] ?? 0 }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="stats-badge" style="background: rgba(234, 179, 8, 0.1); color: #ca8a04;">
                                👁️ Monitoring
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm text-gray-600 font-medium">{{ now()->format('d M Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 bg-gradient-to-r from-green-50 to-blue-50 border-t border-gray-100">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="text-sm text-gray-600 font-medium">
                    Data desa Anda telah terintegrasi dengan sistem Sentra Sehat
                </div>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-sm text-gray-600 font-medium">Terintegrasi</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="live-indicator"></div>
                        <span class="text-sm text-gray-600 font-medium">Real-time</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@else
<!-- Default Role View -->
<div class="modern-card p-12 text-center">
    <div class="mb-6">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-red-400 to-red-600 mb-4">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
    </div>
    <h2 class="text-3xl font-black text-gray-800 mb-3">Akses Terbatas</h2>
    <p class="text-gray-600 mb-6 max-w-md mx-auto">
        Dashboard Anda sedang disiapkan. Silakan hubungi administrator jika Anda memerlukan akses ke modul tertentu.
    </p>
    <button class="premium-btn" style="background: var(--danger-gradient);">
        Hubungi Administrator
    </button>
</div>
@endif

@endsection

@if ($role == 'super_admin' || $role == 'puskesmas_admin' || $role == 'dokter')
<script>
function initDiseaseMap() {
    // Toggle functionality
    const mapToggle = document.getElementById('map-toggle');
    const chartToggle = document.getElementById('chart-toggle');
    const mapSection = document.getElementById('map-section');
    const chartSection = document.getElementById('chart-section');

    if (mapToggle && chartToggle && mapSection && chartSection) {
        mapToggle.addEventListener('click', function() {
            mapSection.classList.remove('hidden');
            chartSection.classList.add('hidden');
            mapToggle.classList.add('active');
            chartToggle.classList.remove('active');
        });

        chartToggle.addEventListener('click', function() {
            chartSection.classList.remove('hidden');
            mapSection.classList.add('hidden');
            chartToggle.classList.add('active');
            mapToggle.classList.remove('active');
        });
    }

    // Google Maps initialization
    var map = new google.maps.Map(document.getElementById('disease-map'), {
        center: { lat: -5.4, lng: 119.6 },
        zoom: 10,
        mapTypeId: 'roadmap',
        styles: [
            {
                featureType: 'all',
                elementType: 'geometry',
                stylers: [{ color: '#f5f5f5' }]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{ color: '#e0e7ff' }]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{ color: '#ffffff' }]
            }
        ]
    });

    var data = @json($data['disease_distribution'] ?? []);
    var bounds = new google.maps.LatLngBounds();

    data.forEach(function(dist) {
        var color = dist.count > 10 ? '#ef4444' : (dist.count > 5 ? '#eab308' : '#22c55e');
        var radius = Math.max(300, Math.min(1500, dist.count * 100));
        
        var circle = new google.maps.Circle({
            strokeColor: color,
            strokeOpacity: 0.9,
            strokeWeight: 3,
            fillColor: color,
            fillOpacity: 0.4,
            map: map,
            center: { lat: dist.lat, lng: dist.lng },
            radius: radius
        });

        bounds.extend(new google.maps.LatLng(dist.lat, dist.lng));

        var infoWindow = new google.maps.InfoWindow({
            content: `
                <div style="font-family:'Inter',sans-serif; padding: 12px; min-width: 250px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, ${color} 0%, ${color}dd 100%); display: flex; align-items: center; justify-content: center;">
                            <span style="color: white; font-size: 20px; font-weight: 800;">${dist.name.charAt(0)}</span>
                        </div>
                        <div>
                            <h4 style="margin: 0; color: #1f2937; font-size: 18px; font-weight: 700;">${dist.name}</h4>
                            <span style="color: #6b7280; font-size: 12px;">Wilayah Kesehatan</span>
                        </div>
                    </div>
                    <div style="background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%); padding: 12px; border-radius: 8px; margin-bottom: 8px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 12px; height: 12px; background: ${color}; border-radius: 50%;"></div>
                            <span style="color: #374151; font-size: 16px; font-weight: 700;">${dist.count} Intervensi</span>
                        </div>
                    </div>
                    <div style="padding-top: 8px; border-top: 2px solid #e5e7eb;">
                        <strong style="color: #374151; font-size: 13px; display: block; margin-bottom: 4px;">📋 Jenis Penyakit:</strong>
                        <span style="color: #6b7280; font-size: 13px; line-height: 1.6;">${dist.diseases}</span>
                    </div>
                </div>
            `
        });

        circle.addListener('click', function(ev) {
            infoWindow.setPosition(circle.getCenter());
            infoWindow.open(map);
        });
    });

    if (data.length > 0) {
        map.fitBounds(bounds);
    }

    // Chart.js initialization
    var ctx = document.getElementById('disease-chart');
    if (ctx) {
        ctx = ctx.getContext('2d');
        var chartData = @json($data['disease_distribution'] ?? []);
        var labels = chartData.map(item => item.name);
        var counts = chartData.map(item => item.count);
        
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(102, 126, 234, 0.8)');
        gradient.addColorStop(1, 'rgba(118, 75, 162, 0.3)');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Intervensi',
                    data: counts,
                    backgroundColor: gradient,
                    borderColor: 'rgba(102, 126, 234, 1)',
                    borderWidth: 2,
                    borderRadius: 12,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        borderRadius: 8,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    }
                }
            }
        });
    }
}

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>
@endif                