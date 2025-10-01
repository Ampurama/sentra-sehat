@extends('layouts.app') 

@section('title', 'Tambah Data Penduduk Baru')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    {{-- Main Card Container --}}
    <div class="max-w-6xl mx-auto bg-white p-6 sm:p-8 rounded-3xl shadow-2xl">
        
        <header class="mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-700">Formulir Tambah Data Penduduk Baru</h1>
            <p class="text-sm text-gray-600 mt-2">Lengkapi data pribadi, wilayah, dan faktor risiko kesehatan untuk penduduk baru.</p>
        </header>

        {{-- Form Status/Errors --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6 shadow-md">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6 shadow-md">
                <strong class="font-bold">Terdapat kesalahan input:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penduduk.store') }}" method="POST">
            @csrf
            
            {{-- =============================================== --}}
            {{-- BAGIAN 1: DATA PRIBADI & KELUARGA --}}
            {{-- =============================================== --}}
            <section class="mb-8 p-4 sm:p-6 border border-blue-200 rounded-xl bg-blue-50/50 shadow-inner">
                <h2 class="text-xl font-bold text-blue-800 mb-4 border-b border-blue-200 pb-2">
                    Data Pribadi & Wilayah
                </h2>
                
                {{-- NIK & Nama Lengkap: 1 kolom di mobile, 2 kolom di tablet/desktop --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="NIK" class="block text-sm font-semibold text-gray-700 mb-1">NIK <span class="text-red-500">*</span></label>
                        {{-- Gunakan p-3 untuk input --}}
                        <input type="text" name="NIK" id="NIK" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('NIK') border-red-500 @enderror" value="{{ old('NIK') }}" required maxlength="16" placeholder="16 digit NIK">
                        @error('NIK') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('nama') border-red-500 @enderror" value="{{ old('nama') }}" required>
                        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Jenis Kelamin & No. Telp: 1 kolom di mobile, 2 kolom di tablet/desktop --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="JK" class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="JK" id="JK" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('JK') border-red-500 @enderror" required>
                            <option value="">Pilih</option>
                            <option value="L" {{ old('JK') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="P" {{ old('JK') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('JK') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="no_telp" class="block text-sm font-semibold text-gray-700 mb-1">No. Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('no_telp') border-red-500 @enderror" value="{{ old('no_telp') }}">
                        @error('no_telp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- No. BPJS --}}
                <div class="mb-4">
                    <label for="no_bpjs" class="block text-sm font-semibold text-gray-700 mb-1">No. BPJS</label>
                    <input type="text" name="no_bpjs" id="no_bpjs" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('no_bpjs') border-red-500 @enderror" value="{{ old('no_bpjs') }}" placeholder="13-17 digit No. BPJS">
                    @error('no_bpjs') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                {{-- Tempat & Tanggal Lahir: 1 kolom di mobile, 2 kolom di tablet/desktop --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('tempat_lahir') border-red-500 @enderror" value="{{ old('tempat_lahir') }}" required>
                        @error('tempat_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('tanggal_lahir') border-red-500 @enderror" value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                
                {{-- RT/RW/Wilayah: 1 kolom di mobile, 3 kolom di tablet/desktop --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                    <div>
                        <label for="alamat_rt" class="block text-sm font-semibold text-gray-700 mb-1">RT <span class="text-red-500">*</span></label>
                        <input type="text" name="alamat_rt" id="alamat_rt" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('alamat_rt') border-red-500 @enderror" value="{{ old('alamat_rt') }}" required maxlength="3" placeholder="Contoh: 001">
                        @error('alamat_rt') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="alamat_rw" class="block text-sm font-semibold text-gray-700 mb-1">RW <span class="text-red-500">*</span></label>
                        <input type="text" name="alamat_rw" id="alamat_rw" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('alamat_rw') border-red-500 @enderror" value="{{ old('alamat_rw') }}" required maxlength="3" placeholder="Contoh: 002">
                        @error('alamat_rw') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="wilayah_id" class="block text-sm font-semibold text-gray-700 mb-1">Wilayah (Kec/Desa) <span class="text-red-500">*</span></label>
                        <select name="wilayah_id" id="wilayah_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('wilayah_id') border-red-500 @enderror" required>
                            <option value="">Pilih Wilayah</option>
                            @foreach($wilayah as $item)
                                <option value="{{ $item->id }}" {{ old('wilayah_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_desa ?? $item->nama_wilayah }}</option>
                            @endforeach
                        </select>
                        @error('wilayah_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Alamat Detail --}}
                <div class="mb-4">
                    <label for="alamat_detail" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Jalan/Detail Rumah</label>
                    <textarea name="alamat_detail" id="alamat_detail" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('alamat_detail') border-red-500 @enderror" rows="2" placeholder="Nama Jalan, Nomor Rumah, Patokan (Opsional)">{{ old('alamat_detail') }}</textarea>
                    @error('alamat_detail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Kepala Keluarga ID --}}
                <div>
                    <label for="kepala_keluarga_id" class="block text-sm font-semibold text-gray-700 mb-1">Kepala Keluarga</label>
                    <small class="text-gray-500 mb-2 block">Kosongkan jika penduduk ini adalah **Kepala Keluarga** yang baru.</small>
                    <select name="kepala_keluarga_id" id="kepala_keluarga_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('kepala_keluarga_id') border-red-500 @enderror">
                        <option value="">-- Kosongkan (Kepala Keluarga Baru) --</option>
                        @foreach($kepalaKeluargaOptions as $kk)
                            <option value="{{ $kk->id }}" {{ old('kepala_keluarga_id') == $kk->id ? 'selected' : '' }}>
                                {{ $kk->nama }} (NIK: {{ $kk->NIK }})
                            </option>
                        @endforeach
                    </select>
                    @error('kepala_keluarga_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </section>
            
            {{-- =============================================== --}}
            {{-- BAGIAN 2: FAKTOR RISIKO --}}
            {{-- =============================================== --}}
            <section class="mb-8 p-4 sm:p-6 border border-yellow-200 rounded-xl bg-yellow-50/50 shadow-inner">
                <h2 class="text-xl font-bold text-yellow-800 mb-4 border-b border-yellow-200 pb-2">
                    Faktor Risiko Kesehatan
                </h2>
                <p class="text-gray-600 text-sm mb-4">Pilih 'Ya' (1) jika penduduk memiliki faktor risiko yang relevan.</p>

                {{-- Faktor Risiko: 1 kolom di mobile, 3 kolom di tablet/desktop --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Riwayat Merokok --}}
                    <div>
                        <label for="riwayat_merokok" class="block text-sm font-semibold text-gray-700 mb-1">Riwayat Merokok</label>
                        <select name="riwayat_merokok" id="riwayat_merokok" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border">
                            <option value="0" {{ old('riwayat_merokok', 0) == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('riwayat_merokok') == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>
                    {{-- Riwayat Alkohol --}}
                    <div>
                        <label for="riwayat_alkohol" class="block text-sm font-semibold text-gray-700 mb-1">Riwayat Konsumsi Alkohol</label>
                        <select name="riwayat_alkohol" id="riwayat_alkohol" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border">
                            <option value="0" {{ old('riwayat_alkohol', 0) == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('riwayat_alkohol') == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>
                    {{-- Riwayat Penyakit Keturunan --}}
                    <div>
                        <label for="riwayat_penyakit_keturunan" class="block text-sm font-semibold text-gray-700 mb-1">Riwayat Penyakit Keturunan</label>
                        <select name="riwayat_penyakit_keturunan" id="riwayat_penyakit_keturunan" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border">
                            <option value="0" {{ old('riwayat_penyakit_keturunan', 0) == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('riwayat_penyakit_keturunan') == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>
                </div>
            </section>

            {{-- =============================================== --}}
            {{-- BAGIAN 3: DATA KLINIS PASIEN --}}
            {{-- =============================================== --}}
            <section class="mb-8 p-4 sm:p-6 border border-red-200 rounded-xl bg-red-50/50 shadow-inner">
                <h2 class="text-xl font-bold text-red-800 mb-4 border-b border-red-200 pb-2">
                    Data Klinis Pasien
                </h2>
                <p class="text-gray-600 text-sm mb-4">Informasi klinis dan riwayat perawatan pasien (opsional).</p>

                {{-- Data Klinis Ringkas --}}
                <div class="mb-6">
                    <label for="data_klinis_ringkas" class="block text-sm font-semibold text-gray-700 mb-1">Data Klinis Ringkas</label>
                    <textarea name="data_klinis_ringkas" id="data_klinis_ringkas" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('data_klinis_ringkas') border-red-500 @enderror" rows="3" placeholder="Ringkasan kondisi klinis pasien">{{ old('data_klinis_ringkas') }}</textarea>
                    @error('data_klinis_ringkas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Diagnosis Utama & Penyerta --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="diagnosis_utama" class="block text-sm font-semibold text-gray-700 mb-1">Diagnosis Utama</label>
                        <textarea name="diagnosis_utama" id="diagnosis_utama" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('diagnosis_utama') border-red-500 @enderror" rows="2" placeholder="Diagnosis utama pasien">{{ old('diagnosis_utama') }}</textarea>
                        @error('diagnosis_utama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="diagnosis_penyerta" class="block text-sm font-semibold text-gray-700 mb-1">Diagnosis Penyerta</label>
                        <textarea name="diagnosis_penyerta" id="diagnosis_penyerta" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('diagnosis_penyerta') border-red-500 @enderror" rows="2" placeholder="Diagnosis penyerta jika ada">{{ old('diagnosis_penyerta') }}</textarea>
                        @error('diagnosis_penyerta') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Tindakan Selama Perawatan --}}
                <div class="mb-6">
                    <label for="tindakan_perawatan" class="block text-sm font-semibold text-gray-700 mb-1">Tindakan Selama Perawatan</label>
                    <textarea name="tindakan_perawatan" id="tindakan_perawatan" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('tindakan_perawatan') border-red-500 @enderror" rows="3" placeholder="Tindakan medis yang dilakukan selama perawatan">{{ old('tindakan_perawatan') }}</textarea>
                    @error('tindakan_perawatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Obat Pulang --}}
                <div class="mb-6">
                    <label for="obat_pulang" class="block text-sm font-semibold text-gray-700 mb-1">Obat Pulang</label>
                    <textarea name="obat_pulang" id="obat_pulang" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('obat_pulang') border-red-500 @enderror" rows="3" placeholder="Daftar obat yang harus dikonsumsi di rumah">{{ old('obat_pulang') }}</textarea>
                    @error('obat_pulang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Alat Kesehatan yang diperlukan di rumah --}}
                <div class="mb-6">
                    <label for="alat_kesehatan_rumah" class="block text-sm font-semibold text-gray-700 mb-1">Alat Kesehatan yang diperlukan di rumah</label>
                    <textarea name="alat_kesehatan_rumah" id="alat_kesehatan_rumah" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('alat_kesehatan_rumah') border-red-500 @enderror" rows="3" placeholder="Alat kesehatan yang dibutuhkan untuk perawatan di rumah">{{ old('alat_kesehatan_rumah') }}</textarea>
                    @error('alat_kesehatan_rumah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Status fungsional saat pulang & Hasil Pemeriksaan --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="status_fungsional_pulang" class="block text-sm font-semibold text-gray-700 mb-1">Status Fungsional saat Pulang</label>
                        <input type="text" name="status_fungsional_pulang" id="status_fungsional_pulang" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('status_fungsional_pulang') border-red-500 @enderror" value="{{ old('status_fungsional_pulang') }}" placeholder="Contoh: Mandiri, Membutuhkan bantuan">
                        @error('status_fungsional_pulang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="hasil_pemeriksaan_terakhir" class="block text-sm font-semibold text-gray-700 mb-1">Hasil Pemeriksaan Penting Terakhir</label>
                        <textarea name="hasil_pemeriksaan_terakhir" id="hasil_pemeriksaan_terakhir" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('hasil_pemeriksaan_terakhir') border-red-500 @enderror" rows="2" placeholder="Hasil pemeriksaan laboratorium atau diagnostik terakhir">{{ old('hasil_pemeriksaan_terakhir') }}</textarea>
                        @error('hasil_pemeriksaan_terakhir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            {{-- Action Buttons Responsif: Full width di mobile, justify-end di desktop --}}
            <div class="mt-10 flex flex-col-reverse sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                {{-- Tombol Batal dijadikan full-width di mobile --}}
                <a href="{{ route('penduduk.index') }}" class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition duration-300 text-center">Batal</a>
                {{-- Tombol Simpan dijadikan full-width di mobile --}}
                <button type="submit" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition duration-300 flex items-center justify-center mb-3 sm:mb-0">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
