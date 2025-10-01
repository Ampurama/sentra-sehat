@extends('layouts.app')

@section('title', 'Edit Data Kesehatan Anak dan Ibu')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 sm:p-8 rounded-3xl shadow-2xl">

        <header class="mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-700">Formulir Edit Data Kesehatan Anak dan Ibu</h1>
            <p class="text-sm text-gray-600 mt-2">Perbarui informasi kesehatan anak dan ibu untuk: <span class="font-semibold">{{ $kesehatan_anak_ibu->penduduk->nama }}</span></p>
        </header>

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

        <form action="{{ route('kesehatan_anak_ibu.update', $kesehatan_anak_ibu->id) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="mb-8 p-4 sm:p-6 border border-blue-200 rounded-xl bg-blue-50/50 shadow-inner">
                <h2 class="text-xl font-bold text-blue-800 mb-4 border-b border-blue-200 pb-2">
                    Informasi Kesehatan Anak dan Ibu
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="sektor_id" class="block text-sm font-semibold text-gray-700 mb-1">Sektor <span class="text-red-500">*</span></label>
                        <select name="sektor_id" id="sektor_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('sektor_id') border-red-500 @enderror" required>
                            <option value="">Pilih Sektor</option>
                            @foreach($sektors as $sektor)
                                <option value="{{ $sektor->id }}" {{ old('sektor_id', $kesehatan_anak_ibu->sektor_id) == $sektor->id ? 'selected' : '' }}>{{ $sektor->name }}</option>
                            @endforeach
                        </select>
                        @error('sektor_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="penduduk_id" class="block text-sm font-semibold text-gray-700 mb-1">Penduduk <span class="text-red-500">*</span></label>
                        <select name="penduduk_id" id="penduduk_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('penduduk_id') border-red-500 @enderror" required>
                            <option value="">Pilih Penduduk</option>
                            @foreach($penduduks as $penduduk)
                                <option value="{{ $penduduk->id }}" {{ old('penduduk_id', $kesehatan_anak_ibu->penduduk_id) == $penduduk->id ? 'selected' : '' }}>{{ $penduduk->nama }}</option>
                            @endforeach
                        </select>
                        @error('penduduk_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="child_vaccinations_complete" class="block text-sm font-semibold text-gray-700 mb-1">Vaksinasi Anak Lengkap</label>
                        <select name="child_vaccinations_complete" id="child_vaccinations_complete" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('child_vaccinations_complete') border-red-500 @enderror">
                            <option value="0" {{ old('child_vaccinations_complete', $kesehatan_anak_ibu->child_vaccinations_complete) == '0' ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('child_vaccinations_complete', $kesehatan_anak_ibu->child_vaccinations_complete) == '1' ? 'selected' : '' }}>Ya</option>
                        </select>
                        @error('child_vaccinations_complete') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="maternal_checkups_count" class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Pemeriksaan Ibu</label>
                        <input type="number" name="maternal_checkups_count" id="maternal_checkups_count" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('maternal_checkups_count') border-red-500 @enderror" value="{{ old('maternal_checkups_count', $kesehatan_anak_ibu->maternal_checkups_count) }}" min="0">
                        @error('maternal_checkups_count') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="birth_weight" class="block text-sm font-semibold text-gray-700 mb-1">Berat Lahir (kg)</label>
                        <input type="number" name="birth_weight" id="birth_weight" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('birth_weight') border-red-500 @enderror" value="{{ old('birth_weight', $kesehatan_anak_ibu->birth_weight) }}" step="0.01" min="0">
                        @error('birth_weight') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="last_checkup" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Pemeriksaan Terakhir</label>
                        <input type="date" name="last_checkup" id="last_checkup" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('last_checkup') border-red-500 @enderror" value="{{ old('last_checkup', $kesehatan_anak_ibu->last_checkup) }}">
                        @error('last_checkup') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes" class="block text-sm font-semibold text-gray-700 mb-1">Catatan</label>
                    <textarea name="notes" id="notes" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('notes') border-red-500 @enderror" rows="3" placeholder="Catatan tambahan">{{ old('notes', $kesehatan_anak_ibu->notes) }}</textarea>
                    @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </section>

            <div class="mt-10 flex flex-col-reverse sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('kesehatan_anak_ibu.show', $kesehatan_anak_ibu->id) }}" class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition duration-300 text-center">Batal</a>
                <button type="submit" class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition duration-300 flex items-center justify-center mb-3 sm:mb-0">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-6 4l2 2 4-4m-2 4h4"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
