@extends('layouts.app')

@section('title', 'Mulai Tindakan Intervensi')

@section('content')

    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-xl">
        <header class="mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">
                Mulai Tindakan Intervensi
            </h1>
            <p class="text-sm text-gray-500">Cari penduduk berdasarkan NIK atau Nama untuk memulai pencatatan tindakan dan diagnosis.</p>
        </header>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Form ini merujuk ke intervensi.index (sesuai Controller) --}}
        <form action="{{ route('intervensi.index') }}" method="GET">
            <div>
                <label for="keyword" class="block text-sm font-medium text-gray-700 mb-1">Cari NIK atau Nama Penduduk</label>
                <input type="text" name="keyword" id="keyword" value="{{ old('keyword', request('keyword')) }}" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border"
                    placeholder="Contoh: 3302xxxxxxxxxxxxxx atau Budi Santoso">
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cari Pasien
                </button>
            </div>
        </form>

        {{-- =============================================== --}}
        {{-- DAFTAR PENDUDUK DI WILAYAH --}}
        {{-- =============================================== --}}
        @if(isset($pendudukList) && $pendudukList->count() > 0)
            <div class="mt-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Penduduk di Wilayah</h2>
                <div class="space-y-4">
                    @foreach($pendudukList as $pendudukItem)
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $pendudukItem->nama }}</h3>
                                    <p class="text-sm text-gray-600">NIK: {{ $pendudukItem->NIK }}</p>
                                    <p class="text-sm text-gray-600">Wilayah: {{ $pendudukItem->wilayah->nama_kecamatan ?? 'N/A' }} - {{ $pendudukItem->wilayah->nama_desa ?? 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">{{ $pendudukItem->JK == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($pendudukItem->TTL)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm text-gray-700"><strong>Alamat:</strong> {{ $pendudukItem->alamat_lengkap }}</p>
                                <p class="text-sm text-gray-700"><strong>No. Telp:</strong> {{ $pendudukItem->no_telp ?? 'N/A' }}</p>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('intervensi.create', ['penduduk_id' => $pendudukItem->id]) }}"
                                   class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none transition duration-150">
                                    Mulai Intervensi
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $pendudukList->links() }}
                </div>
            </div>
        @elseif(isset($pendudukList))
            <div class="mt-8 p-4 border border-gray-300 bg-gray-50 rounded-lg">
                <p class="text-gray-600">Belum ada penduduk yang tercatat di wilayah ini.</p>
            </div>
        @endif

        {{-- =============================================== --}}
        {{-- HASIL PENCARIAN DITAMPILKAN DI BAWAH INI --}}
        {{-- =============================================== --}}
        @if (isset($searched) && $searched)
            @if (isset($penduduk))
                <div class="mt-8 p-4 border border-green-300 bg-green-50 rounded-lg">
                    <h3 class="text-lg font-bold text-green-800">✅ Pasien Ditemukan!</h3>
                    <p class="mt-2 text-gray-700">
                        <strong>Nama:</strong> {{ $penduduk->nama }}<br>
                        <strong>NIK:</strong> {{ $penduduk->NIK }}<br>
                    </p>

                    {{-- Clinical Data Section --}}
                    <div class="mt-4 p-3 bg-white border border-gray-200 rounded-lg">
                        <h4 class="text-md font-semibold text-gray-800 mb-2">Data Klinis Pasien</h4>
                        <div class="space-y-2 text-sm">
                            @if($penduduk->data_klinis_ringkas)
                                <div>
                                    <strong class="text-gray-700">Ringkasan Klinis:</strong>
                                    <p class="mt-1 text-gray-600">{{ $penduduk->data_klinis_ringkas }}</p>
                                </div>
                            @endif
                            @if($penduduk->diagnosis_utama)
                                <p><strong>Diagnosis Utama:</strong> {{ $penduduk->diagnosis_utama }}</p>
                            @endif
                            @if($penduduk->diagnosis_penyerta)
                                <p><strong>Diagnosis Penyerta:</strong> {{ $penduduk->diagnosis_penyerta }}</p>
                            @endif
                            @if($penduduk->tindakan_perawatan)
                                <div>
                                    <strong class="text-gray-700">Tindakan Perawatan:</strong>
                                    <p class="mt-1 text-gray-600 whitespace-pre-line">{{ $penduduk->tindakan_perawatan }}</p>
                                </div>
                            @endif
                            @if($penduduk->obat_pulang)
                                <div>
                                    <strong class="text-gray-700">Obat Pulang:</strong>
                                    <p class="mt-1 text-gray-600 whitespace-pre-line">{{ $penduduk->obat_pulang }}</p>
                                </div>
                            @endif
                            @if($penduduk->alat_kesehatan_rumah)
                                <div>
                                    <strong class="text-gray-700">Alat Kesehatan Rumah:</strong>
                                    <p class="mt-1 text-gray-600">{{ $penduduk->alat_kesehatan_rumah }}</p>
                                </div>
                            @endif
                            @if($penduduk->status_fungsional_pulang)
                                <p><strong>Status Fungsional Pulang:</strong> {{ $penduduk->status_fungsional_pulang }}</p>
                            @endif
                            @if($penduduk->hasil_pemeriksaan_terakhir)
                                <div>
                                    <strong class="text-gray-700">Hasil Pemeriksaan Terakhir:</strong>
                                    <p class="mt-1 text-gray-600">{{ $penduduk->hasil_pemeriksaan_terakhir }}</p>
                                </div>
                            @endif
                        </div>
                        @if(!$penduduk->data_klinis_ringkas && !$penduduk->diagnosis_utama && !$penduduk->diagnosis_penyerta && !$penduduk->tindakan_perawatan && !$penduduk->obat_pulang && !$penduduk->alat_kesehatan_rumah && !$penduduk->status_fungsional_pulang && !$penduduk->hasil_pemeriksaan_terakhir)
                            <p class="text-gray-500 italic">Belum ada data klinis yang tercatat</p>
                        @endif
                    </div>

                    {{-- INI ADALAH LINK YANG DIPERBAIKI (Menggunakan penduduk_id sebagai query parameter) --}}
                    <a href="{{ route('intervensi.create', ['penduduk_id' => $penduduk->id]) }}"
                       class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none transition duration-150">
                        Lanjutkan ke Form Intervensi
                    </a>
                </div>
            @else
                {{-- Hanya tampil jika $searched true, tapi $penduduk null (sudah ditangani di Controller, tapi sebagai fallback) --}}
                <div class="mt-8 p-4 border border-red-300 bg-red-50 rounded-lg">
                    <p class="text-red-700">Penduduk dengan NIK/Nama tersebut tidak ditemukan.</p>
                </div>
            @endif
        @endif

    </div>

@endsection
