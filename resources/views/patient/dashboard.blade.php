@extends('layouts.guest')

@section('title', 'Dashboard Pasien - Sentra Sehat')

@push('styles')
<style>
    /* Tambahan style untuk efek modern */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .glassmorphism {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .nav-link.active {
        background-color: #4f46e5; /* indigo-600 */
        color: white;
    }

    /* Animasi untuk card */
    .card-hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card-hover-effect:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 text-gray-800">

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <header class="py-16 text-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <img class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-white shadow-lg" src="https://ui-avatars.com/api/?name={{ urlencode($penduduk->nama) }}&background=4f46e5&color=fff&size=128" alt="Avatar Pengguna">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                Halo, {{ explode(' ', $penduduk->nama)[0] }}!
            </h1>
            <p class="mt-4 text-lg text-gray-600">
                Selamat datang kembali di dasbor kesehatan Anda.
            </p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <nav class="sticky top-4 z-50 mb-12">
            <div class="glassmorphism max-w-2xl mx-auto rounded-full border border-gray-200/80 shadow-md p-2 flex items-center justify-around gap-2">
                <a href="#info" class="nav-link flex-1 text-center px-4 py-2 rounded-full font-semibold text-gray-600 hover:bg-gray-100 transition-all duration-300">
                    <span class="hidden md:inline">Info Pribadi</span>
                    <span class="md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </span>
                </a>
                <a href="#klinis" class="nav-link flex-1 text-center px-4 py-2 rounded-full font-semibold text-gray-600 hover:bg-gray-100 transition-all duration-300">
                    <span class="hidden md:inline">Data Klinis</span>
                     <span class="md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </span>
                </a>
                <a href="#riwayat" class="nav-link flex-1 text-center px-4 py-2 rounded-full font-semibold text-gray-600 hover:bg-gray-100 transition-all duration-300">
                     <span class="hidden md:inline">Riwayat Intervensi</span>
                     <span class="md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                </a>
            </div>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-8">
                <section id="info" class="bg-white rounded-2xl shadow-lg p-6 card-hover-effect">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Pribadi</h3>
                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between"><dt class="text-gray-500">NIK</dt><dd class="font-medium text-gray-800">{{ $penduduk->NIK }}</dd></div>
                        <div class="flex justify-between"><dt class="text-gray-500">Jenis Kelamin</dt><dd class="font-medium text-gray-800">{{ $penduduk->JK == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd></div>
                        <div class="flex justify-between"><dt class="text-gray-500">Tanggal Lahir</dt><dd class="font-medium text-gray-800">{{ $penduduk->TTL ? \Carbon\Carbon::parse($penduduk->TTL)->format('d M Y') : '-' }}</dd></div>
                        <div class="flex justify-between"><dt class="text-gray-500">Alamat</dt><dd class="font-medium text-gray-800 text-right">{{ $penduduk->alamat_lengkap  }}</dd></div>
                        <div class="flex justify-between"><dt class="text-gray-500">Wilayah</dt><dd class="font-medium text-gray-800">{{ $penduduk->wilayah ? $penduduk->wilayah->nama_kecamatan : '-' }}</dd></div>
                    </dl>
                </section>

                <section class="bg-white rounded-2xl shadow-lg p-6 card-hover-effect">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Status Kesehatan</h3>
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="font-semibold text-gray-700">Kondisi Anda terpantau baik</p>
                        <div class="mt-3 space-y-2 text-sm">
                            <div class="inline-flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-full"><div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>Tekanan darah normal</div>
                            <div class="inline-flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-full ml-2"><div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>Berat badan ideal</div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <section id="klinis" class="bg-white rounded-2xl shadow-lg p-6 card-hover-effect">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Data Klinis Terakhir</h3>
                    @if($penduduk->data_klinis_ringkas || $penduduk->diagnosis_utama)
                        <div class="space-y-4">
                            @if($penduduk->data_klinis_ringkas)
                            <div class="bg-gray-50 p-4 rounded-lg border">
                                <h4 class="font-semibold text-sm text-gray-700 mb-1">Ringkasan Klinis</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $penduduk->data_klinis_ringkas }}</p>
                            </div>
                            @endif
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($penduduk->diagnosis_utama)
                                <div class="bg-red-50 p-3 rounded-lg border border-red-200"><h4 class="font-semibold text-sm text-red-800">Diagnosis Utama</h4><p class="text-sm text-red-900">{{ $penduduk->diagnosis_utama }}</p></div>
                                @endif
                                @if($penduduk->diagnosis_penyerta)
                                <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200"><h4 class="font-semibold text-sm text-yellow-800">Diagnosis Penyerta</h4><p class="text-sm text-yellow-900">{{ $penduduk->diagnosis_penyerta }}</p></div>
                                @endif
                                @if($penduduk->tindakan_perawatan)
                                <div class="bg-blue-50 p-3 rounded-lg border border-blue-200 md:col-span-2"><h4 class="font-semibold text-sm text-blue-800">Tindakan Perawatan</h4><p class="text-sm text-blue-900 whitespace-pre-line">{{ $penduduk->tindakan_perawatan }}</p></div>
                                @endif
                                @if($penduduk->obat_pulang)
                                <div class="bg-green-50 p-3 rounded-lg border border-green-200 md:col-span-2"><h4 class="font-semibold text-sm text-green-800">Obat Pulang</h4><p class="text-sm text-green-900 whitespace-pre-line">{{ $penduduk->obat_pulang }}</p></div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-center py-10">
                             <svg class="w-16 h-16 text-gray-300 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547a2 2 0 00-.547 1.806l.477 2.387a6 6 0 00.517 3.86l.158.318a6 6 0 00.517 3.86l2.387.477a2 2 0 001.806.547a2 2 0 00.547-1.806l-.477-2.387a6 6 0 00-.517-3.86l-.158-.318a6 6 0 00-.517-3.86l-2.387-.477a2 2 0 00-.547-1.806zM15 9.128c.878.878 1.5 1.977 1.5 3.128v1.5a2 2 0 01-2 2h-1.5a2 2 0 01-2-2v-1.5c0-1.15.622-2.25 1.5-3.128" /></svg>
                            <p class="text-gray-500 mt-4">Belum ada data klinis.</p>
                            <p class="text-gray-400 text-sm">Data akan tampil setelah pemeriksaan.</p>
                        </div>
                    @endif
                </section>
            </div>
        </div>

        <section id="riwayat" class="mt-12 bg-white rounded-2xl shadow-lg p-6 card-hover-effect">
            <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                <h3 class="text-lg font-bold text-gray-900">Riwayat Intervensi Medis</h3>
                <div class="text-sm font-semibold bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">Total: {{ $intervensiHistory->count() }} intervensi</div>
            </div>

            @if($intervensiHistory->count() > 0)
                <div class="space-y-6">
                    @foreach($intervensiHistory as $intervensi)
                        <div class="border rounded-lg p-4 transition-all hover:border-indigo-300 hover:bg-indigo-50/50">
                            <div class="flex flex-wrap justify-between items-start gap-3">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h4 class="font-bold text-gray-800">{{ $intervensi->penyakit ? $intervensi->penyakit->name : 'Intervensi Umum' }}</h4>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded">{{ $intervensi->penyakit ? $intervensi->penyakit->icd_code : 'N/A' }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600">{{ $intervensi->deskripsi_intervensi }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                     <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        @if($intervensi->status_intervensi == 'selesai') bg-green-100 text-green-800
                                        @elseif($intervensi->status_intervensi == 'proses') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($intervensi->status_intervensi) }}
                                    </span>
                                </div>
                            </div>
                            <div class="border-t my-4"></div>
                            <div class="flex flex-wrap justify-between items-center gap-4 text-sm text-gray-500">
                                <div><span class="font-semibold">Petugas:</span> {{ $intervensi->petugas ? $intervensi->petugas->name : 'N/A' }}</div>
                                <div><span class="font-semibold">Tanggal:</span> {{ \Carbon\Carbon::parse($intervensi->created_at)->format('d M Y, H:i') }}</div>
                            </div>

                            @if($intervensi->rencanaLanjutan)
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg border">
                                    <h5 class="text-sm font-bold text-gray-700 mb-2">Rencana Tindak Lanjut</h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                                        @if($intervensi->rencanaLanjutan->jadwal_kontrol_berikutnya)
                                            <div><span class="text-gray-500">Jadwal Kontrol:</span> <strong class="text-gray-800">{{ \Carbon\Carbon::parse($intervensi->rencanaLanjutan->jadwal_kontrol_berikutnya)->format('d F Y') }}</strong></div>
                                        @endif
                                        @if($intervensi->rencanaLanjutan->terapi_lanjutan)
                                            <div><span class="text-gray-500">Terapi Lanjutan:</span> <span class="text-gray-800">{{ $intervensi->rencanaLanjutan->terapi_lanjutan }}</span></div>
                                        @endif
                                        @if($intervensi->rencanaLanjutan->keluhan_komplikasi)
                                            <div class="md:col-span-2 mt-1"><span class="text-gray-500">Keluhan/Komplikasi:</span> <span class="text-gray-800">{{ $intervensi->rencanaLanjutan->keluhan_komplikasi }}</span></div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 border-2 border-dashed rounded-lg">
                    <svg class="w-12 h-12 text-gray-300 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    <h3 class="mt-2 text-lg font-semibold text-gray-900">Belum ada riwayat intervensi</h3>
                    <p class="mt-1 text-sm text-gray-500">Semua catatan medis Anda akan muncul di sini.</p>
                </div>
            @endif
        </section>

        <section class="mt-12">
            <h3 class="text-lg font-bold text-gray-900 mb-4 text-center">Tips Kesehatan Hari Ini</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($healthTips as $tip)
                    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover-effect">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">{{ $tip['title'] }}</h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $tip['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="text-center mt-16">
            <form method="POST" action="{{ route('patient.logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-white hover:bg-red-50 text-red-600 font-bold rounded-lg transition-all duration-300 border border-red-200 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </main>
</div>

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
                const offsetTop = targetElement.offsetTop - 80; // Adjust offset as needed
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
    }, { rootMargin: '-50% 0px -50% 0px' });

    sections.forEach(section => {
        observer.observe(section);
    });
});
</script>
@endsection