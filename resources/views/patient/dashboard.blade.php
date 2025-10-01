@extends('layouts.guest')

@section('title', 'Dashboard Pasien - Sentra Sehat')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-green-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full mb-6 backdrop-blur-sm">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-2">
                        Halo, {{ $penduduk->nama }}!
                    </h1>
                    <p class="text-xl md:text-2xl opacity-90">
                        Selamat datang di Dashboard Pasien Sentra Sehat
                    </p>
                    <p class="text-lg opacity-80 mt-2">
                        Pantau kesehatan Anda dan lihat riwayat intervensi medis
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Navbar sticky responsive dan animasi smooth scroll -->
        <nav class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-gray-200 shadow flex flex-wrap items-center justify-center gap-4 md:gap-8 py-3 mb-8">
            <a href="#info" class="nav-link text-blue-700 font-bold px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">Informasi Pribadi</a>
            <a href="#klinis" class="nav-link text-indigo-700 font-bold px-3 py-2 rounded-lg hover:bg-indigo-50 hover:text-indigo-900 transition">Data Klinis Lengkap</a>
            <a href="#riwayat" class="nav-link text-green-700 font-bold px-3 py-2 rounded-lg hover:bg-green-50 hover:text-green-900 transition">Detail Riwayat Intervensi</a>
        </nav>

        <script>
            // Responsive smooth scroll animasi untuk navbar
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('a.nav-link').forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        const targetId = link.getAttribute('href').replace('#', '');
                        const target = document.getElementById(targetId);
                        if (target) {
                            e.preventDefault();
                            window.scrollTo({
                                top: target.getBoundingClientRect().top + window.scrollY - 80,
                                behavior: 'smooth'
                            });
                            // Animasi highlight section
                            target.classList.add('ring-4','ring-blue-300','transition');
                            setTimeout(() => target.classList.remove('ring-4','ring-blue-300','transition'), 800);
                        }
                    });
                });
            });
        </script>

        <!-- Section utama diberi id agar navbar bisa scroll otomatis -->
        <div id="info">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Personal Info Card -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border-l-8 border-blue-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="ml-4 text-xl font-bold text-gray-900">Informasi Pribadi</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">NIK:</span>
                            <span class="text-gray-900">{{ $penduduk->NIK }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">Jenis Kelamin:</span>
                            <span class="text-gray-900">{{ $penduduk->JK == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">Tanggal Lahir:</span>
                            <span class="text-gray-900">{{ $penduduk->TTL ? \Carbon\Carbon::parse($penduduk->TTL)->format('d/m/Y') : '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">Alamat Lengkap:</span>
                            <span class="text-gray-900">{{ $penduduk->alamat_lengkap  }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">Wilayah:</span>
                            <span class="text-gray-900">{{ $penduduk->wilayah ? $penduduk->wilayah->nama_kecamatan : '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Intervention History Card -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border-l-8 border-green-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="ml-4 text-xl font-bold text-gray-900">Riwayat Intervensi</h3>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold text-gray-900 mb-2">{{ $intervensiHistory->count() }}</div>
                        <p class="text-gray-600 mb-4">Total intervensi kesehatan</p>
                        @if($intervensiHistory->count() > 0)
                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Terakhir: {{ \Carbon\Carbon::parse($intervensiHistory->first()->created_at)->format('d/m/Y') }}
                            </div>
                        @else
                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-sm font-medium">
                                Belum ada intervensi
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Health Status Card -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border-l-8 border-purple-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="ml-4 text-xl font-bold text-gray-900">Status Kesehatan</h3>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">Status kesehatan Anda baik</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                <span>Tekanan darah normal</span>
                            </div>
                            <div class="flex items-center justify-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                <span>Berat badan ideal</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clinical Data Section -->
        <div id="klinis" class="bg-white rounded-3xl shadow-xl p-8 border-l-8 border-indigo-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="ml-4 text-xl font-bold text-gray-900">Data Klinis Lengkap</h3>
            </div>

            @if($penduduk->data_klinis_ringkas || $penduduk->diagnosis_utama || $penduduk->diagnosis_penyerta || $penduduk->tindakan_perawatan || $penduduk->obat_pulang || $penduduk->alat_kesehatan_rumah || $penduduk->status_fungsional_pulang || $penduduk->hasil_pemeriksaan_terakhir)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        @if($penduduk->data_klinis_ringkas)
                            <div class="bg-indigo-50 p-4 rounded-xl border border-indigo-200">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-indigo-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-sm font-semibold text-indigo-800">Ringkasan Klinis</span>
                                </div>
                                <p class="text-sm text-indigo-900 leading-relaxed">{{ $penduduk->data_klinis_ringkas }}</p>
                            </div>
                        @endif

                        @if($penduduk->diagnosis_utama)
                            <div class="bg-red-50 p-4 rounded-xl border border-red-200">
                                <div class="flex items-center mb-2">
                                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2 flex-shrink-0"></div>
                                    <span class="text-sm font-semibold text-red-800">Diagnosis Utama</span>
                                </div>
                                <p class="text-sm text-red-900">{{ $penduduk->diagnosis_utama }}</p>
                            </div>
                        @endif

                        @if($penduduk->diagnosis_penyerta)
                            <div class="bg-orange-50 p-4 rounded-xl border border-orange-200">
                                <div class="flex items-center mb-2">
                                    <div class="w-3 h-3 bg-orange-500 rounded-full mr-2 flex-shrink-0"></div>
                                    <span class="text-sm font-semibold text-orange-800">Diagnosis Penyerta</span>
                                </div>
                                <p class="text-sm text-orange-900">{{ $penduduk->diagnosis_penyerta }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        @if($penduduk->tindakan_perawatan)
                            <div class="bg-blue-50 p-4 rounded-xl border border-blue-200">
                                <div class="flex items-center mb-2">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-2 flex-shrink-0"></div>
                                    <span class="text-sm font-semibold text-blue-800">Tindakan Perawatan</span>
                                </div>
                                <p class="text-sm text-blue-900 whitespace-pre-line">{{ $penduduk->tindakan_perawatan }}</p>
                            </div>
                        @endif

                        @if($penduduk->obat_pulang)
                            <div class="bg-green-50 p-4 rounded-xl border border-green-200">
                                <div class="flex items-center mb-2">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2 flex-shrink-0"></div>
                                    <span class="text-sm font-semibold text-green-800">Obat Pulang</span>
                                </div>
                                <p class="text-sm text-green-900 whitespace-pre-line">{{ $penduduk->obat_pulang }}</p>
                            </div>
                        @endif

                        @if($penduduk->status_fungsional_pulang)
                            <div class="bg-purple-50 p-4 rounded-xl border border-purple-200">
                                <div class="flex items-center mb-2">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full mr-2 flex-shrink-0"></div>
                                    <span class="text-sm font-semibold text-purple-800">Status Fungsional Pulang</span>
                                </div>
                                <p class="text-sm text-purple-900">{{ $penduduk->status_fungsional_pulang }}</p>
                            </div>
                        @endif

                        @if($penduduk->alat_kesehatan_rumah)
                            <div class="bg-teal-50 p-4 rounded-xl border border-teal-200">
                                <div class="flex items-center mb-2">
                                    <div class="w-3 h-3 bg-teal-500 rounded-full mr-2 flex-shrink-0"></div>
                                    <span class="text-sm font-semibold text-teal-800">Alat Kesehatan Rumah</span>
                                </div>
                                <p class="text-sm text-teal-900">{{ $penduduk->alat_kesehatan_rumah }}</p>
                            </div>
                        @endif

                        @if($penduduk->hasil_pemeriksaan_terakhir)
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center mb-2">
                                    <div class="w-3 h-3 bg-gray-500 rounded-full mr-2 flex-shrink-0"></div>
                                    <span class="text-sm font-semibold text-gray-800">Hasil Pemeriksaan Terakhir</span>
                                </div>
                                <p class="text-sm text-gray-900">{{ $penduduk->hasil_pemeriksaan_terakhir }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada data klinis</p>
                    <p class="text-gray-400 text-sm mt-1">Data klinis akan muncul setelah dilakukan pemeriksaan kesehatan</p>
                </div>
            @endif
        </div>

        <!-- Detailed Intervention History -->
        <div id="riwayat" class="bg-white rounded-3xl shadow-xl p-8">
            <div class="flex items-center mb-8">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-green-500 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="ml-4 text-2xl font-bold text-gray-900">Detail Riwayat Intervensi</h3>
            </div>

            @if($intervensiHistory->count() > 0)
                <div class="space-y-6">
                    @foreach($intervensiHistory as $intervensi)
                        <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300 hover:border-blue-200">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h4 class="text-lg font-bold text-gray-900">
                                            {{ $intervensi->penyakit ? $intervensi->penyakit->name : 'Tidak diketahui' }}
                                        </h4>
                                        @if($intervensi->penyakit && $intervensi->penyakit->icd_code)
                                            <span class="ml-2 text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                                {{ $intervensi->penyakit->icd_code }}
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 mb-3">{{ $intervensi->deskripsi_intervensi }}</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="flex items-center text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 012 2z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($intervensi->created_at)->format('d F Y, H:i') }}
                                        </div>
                                        <div class="flex items-center text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Petugas: {{ $intervensi->petugas ? $intervensi->petugas->name : 'Anonim' }}
                                        </div>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium ml-4
                                    @if($intervensi->status_intervensi == 'selesai')
                                        bg-green-100 text-green-800
                                    @elseif($intervensi->status_intervensi == 'proses')
                                        bg-yellow-100 text-yellow-800
                                    @else
                                        bg-gray-100 text-gray-800
                                    @endif">
                                    @if($intervensi->status_intervensi == 'selesai')
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @elseif($intervensi->status_intervensi == 'proses')
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                    {{ ucfirst($intervensi->status_intervensi) }}
                                </span>
                            </div>

                            {{-- Additional Clinical Details --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                @if($intervensi->diagnosis_utama)
                                    <div class="bg-blue-50 p-3 rounded-lg">
                                        <div class="flex items-center mb-1">
                                            <svg class="w-4 h-4 text-blue-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span class="text-xs font-semibold text-blue-800">Diagnosis Utama</span>
                                        </div>
                                        <p class="text-sm text-blue-900">{{ $intervensi->diagnosis_utama }}</p>
                                    </div>
                                @endif
                                @if($intervensi->tindakan_selama_perawatan)
                                    <div class="bg-green-50 p-3 rounded-lg">
                                        <div class="flex items-center mb-1">
                                            <svg class="w-4 h-4 text-green-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                            <span class="text-xs font-semibold text-green-800">Tindakan Perawatan</span>
                                        </div>
                                        <p class="text-sm text-green-900">{{ Str::limit($intervensi->tindakan_selama_perawatan, 100) }}</p>
                                    </div>
                                @endif
                            </div>

                            @if($intervensi->rencanaLanjutan)
                                <div class="mt-4 p-4 bg-gradient-to-r from-blue-50 to-green-50 rounded-2xl border border-blue-200">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h5 class="text-sm font-bold text-blue-900">Rencana Tindak Lanjut</h5>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @if($intervensi->rencanaLanjutan->jadwal_kontrol_berikutnya)
                                            <div>
                                                <span class="text-xs text-blue-700 font-medium">Jadwal Kontrol:</span>
                                                <p class="text-sm text-blue-800">{{ \Carbon\Carbon::parse($intervensi->rencanaLanjutan->jadwal_kontrol_berikutnya)->format('d F Y') }}</p>
                                            </div>
                                        @endif
                                        @if($intervensi->rencanaLanjutan->terapi_lanjutan)
                                            <div>
                                                <span class="text-xs text-blue-700 font-medium">Terapi Lanjutan:</span>
                                                <p class="text-sm text-blue-800">{{ $intervensi->rencanaLanjutan->terapi_lanjutan }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    @if($intervensi->rencanaLanjutan->keluhan_komplikasi)
                                        <div class="mt-2">
                                            <span class="text-xs text-blue-700 font-medium">Keluhan/Komplikasi:</span>
                                            <p class="text-sm text-blue-800">{{ $intervensi->rencanaLanjutan->keluhan_komplikasi }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum ada riwayat intervensi</h3>
                    <p class="text-gray-600 max-w-md mx-auto leading-relaxed">
                        Anda belum memiliki catatan intervensi kesehatan. Jika Anda memerlukan bantuan medis, hubungi puskesmas terdekat atau dokter Anda.
                    </p>
                    <div class="mt-6 flex justify-center space-x-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Konsultasi gratis tersedia
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Health Tips Section -->
        <div class="bg-gradient-to-r from-green-500 to-blue-600 rounded-3xl p-8 mt-8 text-white">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="ml-4 text-2xl font-bold">Tips Kesehatan Hari Ini</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($healthTips as $tip)
                    <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm">
                        <div class="flex items-center mb-3">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <h4 class="ml-3 font-semibold">{{ $tip['title'] }}</h4>
                        </div>
                        <p class="text-white/90 text-sm">{{ $tip['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Logout Button -->
        <div class="text-center mt-12">
            <form method="POST" action="{{ route('patient.logout') }}" class="inline-block">
                @csrf
                <button type="submit"
                        class="inline-flex items-center px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout dari Akun
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
