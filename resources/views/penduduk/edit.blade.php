@extends('layouts.app')

@section('title', 'Edit Data Penduduk: ' . $penduduk->nama)

@section('content')

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl">
        <header class="mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">
                Edit Data Penduduk
            </h1>
            <p class="text-sm text-gray-500">Perbarui data kependudukan untuk **{{ $penduduk->nama }}** (NIK: {{ $penduduk->NIK }}).</p>
        </header>

        {{-- Display Validation Errors & Session Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4">
                <strong class="font-bold">Gagal Validasi!</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- PENTING: Gunakan method PUT untuk update --}}
            
            @php
                // Logic untuk memecah string alamat_lengkap menjadi RT, RW, dan Alamat Detail
                $alamatParts = explode(' - ', $penduduk->alamat_lengkap);
                $rtRw = explode('/', $alamatParts[0] ?? 'RT 000/RW 000');
                
                $currentRt = trim(str_replace('RT', '', $rtRw[0] ?? '000'));
                $currentRw = trim(str_replace('RW', '', $rtRw[1] ?? '000'));
                $currentDetail = $alamatParts[1] ?? '';

                // Gunakan old() jika ada error validasi, jika tidak gunakan data database yang sudah di-parse
                $oldRt = old('alamat_rt', $currentRt);
                $oldRw = old('alamat_rw', $currentRw);
                $oldDetail = old('alamat_detail', $currentDetail);

            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label for="NIK" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                    <input type="text" name="NIK" id="NIK" value="{{ old('NIK', $penduduk->NIK) }}" required readonly
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm p-3 border bg-gray-100 cursor-not-allowed">
                </div>

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $penduduk->nama) }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                </div>
                
                <div>
                    <label for="JK" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="JK" id="JK" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                        <option value="L" {{ old('JK', $penduduk->JK) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('JK', $penduduk->JK) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                
                <div>
                    <label for="wilayah_id" class="block text-sm font-medium text-gray-700 mb-1">Wilayah</label>
                    <select name="wilayah_id" id="wilayah_id" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                        <option value="">-- Pilih Wilayah --</option>
                        @foreach ($wilayahs as $wilayah)
                            <option value="{{ $wilayah->id }}" {{ old('wilayah_id', $penduduk->wilayah_id) == $wilayah->id ? 'selected' : '' }}>{{ $wilayah->nama_desa }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                </div>

                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                </div>
                
                <div class="md:col-span-2 grid grid-cols-2 gap-4">
                    <div>
                        <label for="alamat_rt" class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                        <input type="text" name="alamat_rt" id="alamat_rt" value="{{ $oldRt }}" placeholder="Contoh: 001" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                    </div>
                    <div>
                        <label for="alamat_rw" class="block text-sm font-medium text-gray-700 mb-1">RW</label>
                        <input type="text" name="alamat_rw" id="alamat_rw" value="{{ $oldRw }}" placeholder="Contoh: 002" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="alamat_detail" class="block text-sm font-medium text-gray-700 mb-1">Alamat Detail (Jalan/Gang/Nomor Rumah)</label>
                    <textarea name="alamat_detail" id="alamat_detail" rows="3"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">{{ $oldDetail }}</textarea>
                </div>

                <div>
                    <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon (Opsional)</label>
                    <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', $penduduk->no_telp) }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                </div>

                <div>
                    <label for="no_bpjs" class="block text-sm font-medium text-gray-700 mb-1">No. BPJS (Opsional)</label>
                    <input type="text" name="no_bpjs" id="no_bpjs" value="{{ old('no_bpjs', $penduduk->no_bpjs) }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border"
                        placeholder="13-17 digit No. BPJS">
                </div>

            </div>

            {{-- Faktor Risiko --}}
            <div class="mt-8 p-6 bg-yellow-50 rounded-lg border border-yellow-200">
                <h3 class="text-lg font-semibold text-yellow-800 mb-4">Faktor Risiko Kesehatan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="riwayat_merokok" class="block text-sm font-medium text-gray-700 mb-1">Riwayat Merokok</label>
                        <select name="riwayat_merokok" id="riwayat_merokok"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                            <option value="0" {{ old('riwayat_merokok', $penduduk->riwayat_merokok ?? 0) == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('riwayat_merokok', $penduduk->riwayat_merokok ?? 0) == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>
                    <div>
                        <label for="riwayat_alkohol" class="block text-sm font-medium text-gray-700 mb-1">Riwayat Konsumsi Alkohol</label>
                        <select name="riwayat_alkohol" id="riwayat_alkohol"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                            <option value="0" {{ old('riwayat_alkohol', $penduduk->riwayat_alkohol ?? 0) == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('riwayat_alkohol', $penduduk->riwayat_alkohol ?? 0) == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>
                    <div>
                        <label for="riwayat_penyakit_keturunan" class="block text-sm font-medium text-gray-700 mb-1">Riwayat Penyakit Keturunan</label>
                        <select name="riwayat_penyakit_keturunan" id="riwayat_penyakit_keturunan"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border">
                            <option value="0" {{ old('riwayat_penyakit_keturunan', $penduduk->riwayat_penyakit_keturunan ?? 0) == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('riwayat_penyakit_keturunan', $penduduk->riwayat_penyakit_keturunan ?? 0) == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Data Klinis Pasien --}}
            <div class="mt-8 p-6 bg-red-50 rounded-lg border border-red-200">
                <h3 class="text-lg font-semibold text-red-800 mb-4">Data Klinis Pasien</h3>

                <div class="space-y-6">
                    {{-- Data Klinis Ringkas --}}
                    <div>
                        <label for="data_klinis_ringkas" class="block text-sm font-medium text-gray-700 mb-1">Data Klinis Ringkas</label>
                        <textarea name="data_klinis_ringkas" id="data_klinis_ringkas" rows="3"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border"
                            placeholder="Ringkasan kondisi klinis pasien">{{ old('data_klinis_ringkas', $penduduk->data_klinis_ringkas) }}</textarea>
                    </div>

                    {{-- Diagnosis Utama & Penyerta --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="diagnosis_utama" class="block text-sm font-medium text-gray-700 mb-1">Diagnosis Utama</label>
                            <textarea name="diagnosis_utama" id="diagnosis_utama" rows="2"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border"
                                placeholder="Diagnosis utama pasien">{{ old('diagnosis_utama', $penduduk->diagnosis_utama) }}</textarea>
                        </div>
                        <div>
                            <label for="diagnosis_penyerta" class="block text-sm font-medium text-gray-700 mb-1">Diagnosis Penyerta</label>
                            <textarea name="diagnosis_penyerta" id="diagnosis_penyerta" rows="2"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border"
                                placeholder="Diagnosis penyerta jika ada">{{ old('diagnosis_penyerta', $penduduk->diagnosis_penyerta) }}</textarea>
                        </div>
                    </div>

                    {{-- Tindakan Selama Perawatan --}}
                    <div>
                        <label for="tindakan_perawatan" class="block text-sm font-medium text-gray-700 mb-1">Tindakan Selama Perawatan</label>
                        <textarea name="tindakan_perawatan" id="tindakan_perawatan" rows="3"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border"
                            placeholder="Tindakan medis yang dilakukan selama perawatan">{{ old('tindakan_perawatan', $penduduk->tindakan_perawatan) }}</textarea>
                    </div>

                    {{-- Obat Pulang --}}
                    <div>
                        <label for="obat_pulang" class="block text-sm font-medium text-gray-700 mb-1">Obat Pulang</label>
                        <textarea name="obat_pulang" id="obat_pulang" rows="3"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border"
                            placeholder="Daftar obat yang harus dikonsumsi di rumah">{{ old('obat_pulang', $penduduk->obat_pulang) }}</textarea>
                    </div>

                    {{-- Alat Kesehatan yang diperlukan di rumah --}}
                    <div>
                        <label for="alat_kesehatan_rumah" class="block text-sm font-medium text-gray-700 mb-1">Alat Kesehatan yang diperlukan di rumah</label>
                        <textarea name="alat_kesehatan_rumah" id="alat_kesehatan_rumah" rows="3"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border"
                            placeholder="Alat kesehatan yang dibutuhkan untuk perawatan di rumah">{{ old('alat_kesehatan_rumah', $penduduk->alat_kesehatan_rumah) }}</textarea>
                    </div>

                    {{-- Status fungsional saat pulang & Hasil Pemeriksaan --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="status_fungsional_pulang" class="block text-sm font-medium text-gray-700 mb-1">Status Fungsional saat Pulang</label>
                            <input type="text" name="status_fungsional_pulang" id="status_fungsional_pulang"
                                value="{{ old('status_fungsional_pulang', $penduduk->status_fungsional_pulang) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border"
                                placeholder="Contoh: Mandiri, Membutuhkan bantuan">
                        </div>
                        <div>
                            <label for="hasil_pemeriksaan_terakhir" class="block text-sm font-medium text-gray-700 mb-1">Hasil Pemeriksaan Penting Terakhir</label>
                            <textarea name="hasil_pemeriksaan_terakhir" id="hasil_pemeriksaan_terakhir" rows="2"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 border"
                                placeholder="Hasil pemeriksaan laboratorium atau diagnostik terakhir">{{ old('hasil_pemeriksaan_terakhir', $penduduk->hasil_pemeriksaan_terakhir) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 pt-6 border-t flex justify-end space-x-3">
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-6 4l2 2 4-4m-2 4h4"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
        
    </div>

@endsection