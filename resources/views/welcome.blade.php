@extends('layouts.guest')

@section('title', 'Sentra Sehat - Sistem Informasi Kesehatan Masyarakat')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
            <div class="text-center">
                <!-- Logo/Icon -->
                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-32 h-32 bg-gradient-to-r from-blue-600 to-green-600 rounded-full mb-8 shadow-2xl">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-green-600 mb-6">
                        Sentra Sehat
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-700 mb-4 font-medium">
                        Sistem Informasi Kesehatan Masyarakat
                    </p>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Platform digital terintegrasi untuk pengelolaan data kesehatan, intervensi medis, dan monitoring kesehatan wilayah secara real-time.
                    </p>
                </div>

                <!-- Login Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mt-12">
                    <a href="{{ route('login') }}"
                       class="group inline-flex items-center px-10 py-5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-2xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-2">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Login Admin
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="{{ route('patient.login.form') }}"
                       class="group inline-flex items-center px-10 py-5 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold rounded-2xl hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-2">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Login Pasien
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Fitur Unggulan
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Solusi lengkap untuk pengelolaan kesehatan masyarakat yang modern dan efisien
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Data Terintegrasi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Sistem manajemen data kesehatan yang terpusat dengan integrasi yang seamless antar modul kesehatan.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Intervensi Cepat</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Responsif terhadap masalah kesehatan dengan sistem intervensi yang efisien dan terkoordinasi.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Monitoring Real-time</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Dashboard interaktif untuk monitoring kesehatan wilayah secara real-time dengan visualisasi data yang informatif.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="py-16 bg-gradient-to-r from-blue-600 to-green-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">1000+</div>
                    <div class="text-blue-100">Data Penduduk</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-blue-100">Intervensi</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">50+</div>
                    <div class="text-blue-100">Wilayah</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100">Monitoring</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8">
                <h3 class="text-2xl font-bold mb-4">Sentra Sehat</h3>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Komitmen kami adalah memberikan pelayanan kesehatan yang terbaik untuk masyarakat melalui teknologi digital yang inovatif.
                </p>
            </div>
            <div class="border-t border-gray-800 pt-8">
                <p class="text-gray-500">
                    © 2024 Sentra Sehat. Semua hak dilindungi.
                </p>
            </div>
        </div>
    </footer>
</div>

<style>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, rgba(59, 130, 246, 0.15) 1px, transparent 0);
    background-size: 20px 20px;
}
</style>
@endsection
