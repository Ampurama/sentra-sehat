@extends('layouts.app')

@section('title', 'Formulir Pencatatan Intervensi')

@section('content')

{{-- Container utama menggunakan padding responsif --}}
<div class="container mx-auto p-4 md:p-8">
    {{-- Lebar kartu utama disesuaikan untuk layar besar, dengan padding responsif --}}
    <div class="max-w-5xl mx-auto bg-white p-6 sm:p-8 rounded-3xl shadow-2xl">
        <header class="mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-800">Pencatatan Tindakan Intervensi</h1>
            <p class="text-sm text-gray-600 mt-2">Isi form di bawah untuk mencatat diagnosis, tindakan, dan rencana lanjutan bagi pasien.</p>
        </header>
        
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- =============================================== --}}
        {{-- NAVIGATION TABS --}}
        {{-- =============================================== --}}
        <div class="mb-8">
            <nav class="flex flex-wrap border-b border-gray-200">
                <button type="button" class="tab-button active py-3 px-4 border-b-2 border-blue-500 font-medium text-sm text-blue-600 hover:text-blue-800 focus:outline-none" data-tab="pasien">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Pasien Terpilih
                </button>
                <button type="button" class="tab-button py-3 px-4 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 focus:outline-none" data-tab="riwayat">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Riwayat Intervensi
                </button>
                <button type="button" class="tab-button py-3 px-4 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 focus:outline-none" data-tab="tindakan">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Catat Tindakan Baru
                </button>
                <button type="button" class="tab-button py-3 px-4 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 focus:outline-none" data-tab="rencana">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Rencana Tindak Lanjut
                </button>
            </nav>
        </div>

        {{-- SINGLE FORM WRAPPER --}}
        <form action="{{ route('intervensi.store') }}" method="POST" id="interventionForm">
            @csrf
            <input type="hidden" name="penduduk_id" value="{{ $penduduk->id }}">

            <div class="tab-content">
                {{-- PASIEN TERPILIH TAB --}}
                <div id="pasien-tab" class="tab-pane active">
                    {{-- =============================================== --}}
                    {{-- DETAIL PASIEN (BOX INFORMASI) --}}
                    {{-- =============================================== --}}
                    <div class="mb-8 p-4 sm:p-6 border-l-4 border-blue-600 bg-blue-50 rounded-xl shadow-inner">
                        <h2 class="text-lg sm:text-xl font-bold text-blue-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Pasien Terpilih
                        </h2>
                        {{-- GRID Responsif: 1 kolom di mobile, 2 kolom di tablet/desktop --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 sm:gap-4 text-gray-700 text-sm sm:text-base">
                            <p><strong>Nama:</strong> {{ $penduduk->nama }}</p>
                            <p><strong>NIK:</strong> {{ $penduduk->NIK }}</p>
                            <p><strong>Tempat Tanggal Lahir:</strong> {{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->TTL)->format('d M Y') }}</p>
                        </div>

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

                        @if($penduduk->faktorRisiko)
                            <div class="mt-4 text-sm p-3 bg-yellow-100 border border-yellow-300 rounded-lg">
                                <strong class="text-yellow-800">Peringatan Risiko:</strong> 
                                @php
                                    $risks = [];
                                    if ($penduduk->faktorRisiko->riwayat_merokok) $risks[] = 'Merokok';
                                    if ($penduduk->faktorRisiko->riwayat_alkohol) $risks[] = 'Alkohol';
                                    if ($penduduk->faktorRisiko->riwayat_penyakit_keturunan) $risks[] = 'Penyakit Keturunan';
                                @endphp
                                <span class="font-bold text-red-600">{{ count($risks) > 0 ? implode(', ', $risks) : 'Tidak ada' }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- RIWAYAT INTERVENSI TAB --}}
                <div id="riwayat-tab" class="tab-pane hidden">
                    {{-- =============================================== --}}
                    {{-- RIWAYAT INTERVENSI (COLLAPSIBLE / SCROLLABLE) --}}
                    {{-- =============================================== --}}
                    <section class="mb-10 p-4 sm:p-6 border border-gray-300 rounded-xl bg-gray-50 shadow-inner">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Riwayat Tindakan Intervensi ({{ $penduduk->riwayatIntervensi->count() }}x)
                        </h2>
                        
                        {{-- Scrollable area for history --}}
                        <div class="max-h-96 overflow-y-auto pr-2">
                            @forelse ($penduduk->riwayatIntervensi as $riwayat)
                                <div class="mb-4 p-4 border border-gray-100 rounded-xl shadow-md bg-white hover:shadow-lg transition duration-200">
                                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-gray-200 pb-2 mb-2">
                                        <span class="text-md font-extrabold text-blue-700">
                                            {{ \Carbon\Carbon::parse($riwayat->tgl_tindakan)->format('d F Y') }}
                                        </span>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full mt-1 sm:mt-0">
                                            Petugas: {{ $riwayat->petugas->name ?? 'Anonim' }}
                                        </span>
                                    </div>

                                    <p class="mb-1 text-sm"><strong class="text-gray-700">Diagnosis:</strong> {{ $riwayat->diagnosis_utama }}</p>
                                    <p class="mb-1 text-sm"><strong class="text-gray-700">Tindakan:</strong> {{ $riwayat->tindakan_selama_perawatan }}</p>
                                    <p class="mb-1 text-sm"><strong class="text-gray-700">Status:</strong> <span class="font-bold text-green-600">{{ $riwayat->status_fungsional }}</span></p>

                                    @if ($riwayat->rencanaLanjutan)
                                        <div class="mt-3 pt-3 border-t border-dashed border-gray-300 text-xs">
                                            <h4 class="font-bold text-gray-700">Tindak Lanjut:</h4>
                                            <p>Kontrol:
                                                <span class="font-medium text-red-600">
                                                    {{ $riwayat->rencanaLanjutan->jadwal_kontrol_berikutnya ? \Carbon\Carbon::parse($riwayat->rencanaLanjutan->jadwal_kontrol_berikutnya)->format('d M Y') : 'N/A' }}
                                                </span>
                                            </p>
                                            <p>Terapi: {{ $riwayat->rencanaLanjutan->terapi_lanjutan ?? '-' }}</p>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="p-6 text-center text-gray-500 bg-white rounded-xl shadow-inner">
                                    <p>Tidak ada riwayat intervensi yang ditemukan.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                </div>

                {{-- CATAT TINDAKAN BARU TAB --}}
                <div id="tindakan-tab" class="tab-pane hidden">
                    {{-- =============================================== --}}
                    {{-- FORM INPUT BARU - TINDAKAN --}}
                    {{-- =============================================== --}}
                    <div class="p-4 sm:p-6 border border-gray-300 rounded-xl bg-white shadow-inner">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4">Catat Tindakan Baru</h2>

                        {{-- Grid Tindakan Utama: 1 kolom di mobile, 3 kolom di desktop --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            
                            {{-- Tanggal Intervensi --}}
                            <div class="form-group">
                                <label for="tanggal_intervensi" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Tindakan *</label>
                                <input type="date" name="tanggal_intervensi" id="tanggal_intervensi" value="{{ old('tanggal_intervensi', date('Y-m-d')) }}" required
                                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('tanggal_intervensi') border-red-500 @enderror">
                                @error('tanggal_intervensi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            
                            {{-- Status Fungsional --}}
                            <div class="form-group">
                                <label for="status_fungsional" class="block text-sm font-semibold text-gray-700 mb-1">Status Fungsional *</label>
                                <select name="status_fungsional" id="status_fungsional" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border">
                                    <option value="Baik" {{ old('status_fungsional', 'Baik') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="Sedang" {{ old('status_fungsional') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="Buruk" {{ old('status_fungsional') == 'Buruk' ? 'selected' : '' }}>Buruk</option>
                                </select>
                            </div>

                            {{-- Penyakit --}}
                            <div class="form-group">
                                <label for="penyakit_id" class="block text-sm font-semibold text-gray-700 mb-1">Penyakit *</label>
                                <select name="penyakit_id" id="penyakit_id" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('penyakit_id') border-red-500 @enderror">
                                    <option value="">Pilih Penyakit</option>
                                    @foreach($penyakit as $p)
                                        <option value="{{ $p->id }}" {{ old('penyakit_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('penyakit_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Diagnosis --}}
                        <div class="form-group mt-6">
                            <label for="diagnosis" class="block text-sm font-semibold text-gray-700 mb-1">Diagnosis (ICD-10 atau Keterangan) *</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" required
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('diagnosis') border-red-500 @enderror"
                                placeholder="Contoh: Hipertensi Stage 1 / Kurang Gizi">{{ old('diagnosis') }}</textarea>
                            @error('diagnosis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tindakan --}}
                        <div class="form-group mt-6">
                            <label for="tindakan" class="block text-sm font-semibold text-gray-700 mb-1">Tindakan/Intervensi yang Diberikan *</label>
                            <textarea name="tindakan" id="tindakan" rows="5" required
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('tindakan') border-red-500 @enderror"
                                placeholder="Contoh: Konseling Gizi, Pemberian Obat Anti-hipertensi, Rujukan ke RS">{{ old('tindakan') }}</textarea>
                            @error('tindakan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Petugas Penanggung Jawab *</label>
                            <input type="hidden" name="petugas_id" value="{{ Auth::id() }}">
                            <input type="text" value="{{ Auth::user()->name }}" readonly class="mt-1 block w-full rounded-xl border-gray-200 bg-gray-100 text-gray-700 p-3 border focus:outline-none" />
                            <p class="text-xs text-gray-500 mt-1">Petugas otomatis sesuai user login, tidak dapat diubah.</p>
                        </div>
                    </div>
                </div>

                {{-- RENCANA TINDAK LANJUT TAB --}}
                <div id="rencana-tab" class="tab-pane hidden">
                    <div class="p-4 sm:p-6 border border-gray-300 rounded-xl bg-white shadow-inner">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4">Rencana Tindak Lanjut <span class="text-base text-gray-500">(Opsional)</span></h2>

                        <div class="form-group">
                            <label for="keluhan_komplikasi" class="block text-sm font-semibold text-gray-700 mb-1">Keluhan/Komplikasi Saat Ini</label>
                            <textarea name="keluhan_komplikasi" id="keluhan_komplikasi" rows="2"
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('keluhan_komplikasi') border-red-500 @enderror"
                                placeholder="Catatan keluhan atau komplikasi yang dialami pasien">{{ old('keluhan_komplikasi') }}</textarea>
                            @error('keluhan_komplikasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Grid Rencana Lanjutan: 1 kolom di mobile, 2 kolom di tablet/desktop --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                            <div class="form-group">
                                <label for="jadwal_kontrol_berikutnya" class="block text-sm font-semibold text-gray-700 mb-1">Jadwal Kontrol Berikutnya</label>
                                <input type="date" name="jadwal_kontrol_berikutnya" id="jadwal_kontrol_berikutnya" 
                                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('jadwal_kontrol_berikutnya') border-red-500 @enderror"
                                    value="{{ old('jadwal_kontrol_berikutnya') }}">
                                @error('jadwal_kontrol_berikutnya') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="kebutuhan_pendampingan" class="block text-sm font-semibold text-gray-700 mb-1">Kebutuhan Pendampingan</label>
                                <input type="text" name="kebutuhan_pendampingan" id="kebutuhan_pendampingan" 
                                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('kebutuhan_pendampingan') border-red-500 @enderror"
                                    value="{{ old('kebutuhan_pendampingan') }}" placeholder="Contoh: Pendampingan Gizi / Fisioterapi">
                                @error('kebutuhan_pendampingan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Terapi Lanjutan (Text Area untuk deskripsi tambahan) --}}
                        <div class="form-group mt-6">
                            <label for="terapi_lanjutan" class="block text-sm font-semibold text-gray-700 mb-1">Catatan Terapi Lanjutan</label>
                            <textarea name="terapi_lanjutan" id="terapi_lanjutan" rows="2"
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('terapi_lanjutan') border-red-500 @enderror"
                                placeholder="Catatan tambahan tentang terapi lanjutan">{{ old('terapi_lanjutan') }}</textarea>
                            @error('terapi_lanjutan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mt-6">
                            <label for="keterangan_lain" class="block text-sm font-semibold text-gray-700 mb-1">Keterangan Lain</label>
                            <textarea name="keterangan_lain" id="keterangan_lain" rows="3" 
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('keterangan_lain') border-red-500 @enderror"
                                placeholder="Catatan tambahan">{{ old('keterangan_lain') }}</textarea>
                            @error('keterangan_lain') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- SINGLE SUBMIT BUTTON SECTION --}}
            <div class="mt-10 p-4 sm:p-6 border border-gray-300 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 shadow-inner">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <div class="text-sm text-gray-600">
                        <p class="font-medium">Pastikan data tindakan sudah lengkap sebelum menyimpan</p>
                        <p class="text-xs">Rencana tindak lanjut bersifat opsional dan dapat diisi nanti</p>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('intervensi.index') }}" class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition duration-300 text-center">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition duration-300 flex items-center justify-center transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-4 0V4a2 2 0 00-2-2H9a2 2 0 00-2 2v3m4 0h.01"></path></svg>
                            Simpan Intervensi
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- JavaScript for Tab Switching and Form Validation --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanes = document.querySelectorAll('.tab-pane');
    const form = document.getElementById('interventionForm');

    // Tab switching functionality
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('border-blue-500', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            // Add active class to clicked button
            this.classList.add('active');
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-blue-500', 'text-blue-600');

            // Hide all tab panes
            tabPanes.forEach(pane => {
                pane.classList.add('hidden');
            });

            // Show selected tab pane
            const tabId = this.getAttribute('data-tab') + '-tab';
            document.getElementById(tabId).classList.remove('hidden');
        });
    });

    // Form validation before submit
    form.addEventListener('submit', function(e) {
        const requiredFields = [
            'tanggal_intervensi',
            'status_fungsional', 
            'penyakit_id',
            'diagnosis',
            'tindakan'
        ];

        let isValid = true;
        let firstInvalidField = null;

        requiredFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500');
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            e.preventDefault();
            
            // Switch to the appropriate tab if needed
            if (firstInvalidField) {
                // Check which tab the invalid field belongs to
                const tindakanTab = document.getElementById('tindakan-tab');
                if (tindakanTab.contains(firstInvalidField)) {
                    // Switch to tindakan tab
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                        btn.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    const tindakanButton = document.querySelector('[data-tab="tindakan"]');
                    tindakanButton.classList.add('active', 'border-blue-500', 'text-blue-600');
                    tindakanButton.classList.remove('border-transparent', 'text-gray-500');
                    
                    tabPanes.forEach(pane => pane.classList.add('hidden'));
                    tindakanTab.classList.remove('hidden');
                }
                
                firstInvalidField.focus();
            }

            alert('Mohon lengkapi semua field yang wajib diisi (bertanda *)');
        }
    });

    // Remove red border when user starts typing
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('border-red-500');
        });
    });
});
</script>

@endsection