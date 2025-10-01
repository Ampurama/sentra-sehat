@extends('layouts.app')

@section('title', 'Edit Data Penyakit: ' . $penyakit->name)

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 sm:p-8 rounded-3xl shadow-2xl">

        <header class="mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-700">Formulir Edit Data Penyakit</h1>
            <p class="text-sm text-gray-600 mt-2">Perbarui informasi penyakit: <span class="font-semibold">{{ $penyakit->name }}</span></p>
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

        <form action="{{ route('penyakit.update', $penyakit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="mb-8 p-4 sm:p-6 border border-blue-200 rounded-xl bg-blue-50/50 shadow-inner">
                <h2 class="text-xl font-bold text-blue-800 mb-4 border-b border-blue-200 pb-2">
                    Informasi Penyakit
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="sektor_id" class="block text-sm font-semibold text-gray-700 mb-1">Sektor <span class="text-red-500">*</span></label>
                        <select name="sektor_id" id="sektor_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('sektor_id') border-red-500 @enderror" required>
                            <option value="">Pilih Sektor</option>
                            @foreach($sektors as $sektor)
                                <option value="{{ $sektor->id }}" {{ old('sektor_id', $penyakit->sektor_id) == $sektor->id ? 'selected' : '' }}>{{ $sektor->name }}</option>
                            @endforeach
                        </select>
                        @error('sektor_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Penyakit <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('name') border-red-500 @enderror" value="{{ old('name', $penyakit->name) }}" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="icd_code" class="block text-sm font-semibold text-gray-700 mb-1">Kode ICD</label>
                        <input type="text" name="icd_code" id="icd_code" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('icd_code') border-red-500 @enderror" value="{{ old('icd_code', $penyakit->icd_code) }}" placeholder="Contoh: A00.0">
                        @error('icd_code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="spesialisasi" class="block text-sm font-semibold text-gray-700 mb-1">Spesialisasi</label>
                        <input type="text" name="spesialisasi" id="spesialisasi" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('spesialisasi') border-red-500 @enderror" value="{{ old('spesialisasi', $penyakit->spesialisasi) }}" placeholder="Contoh: Penyakit Dalam">
                        @error('spesialisasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="prevalence" class="block text-sm font-semibold text-gray-700 mb-1">Prevalensi (%)</label>
                        <input type="number" name="prevalence" id="prevalence" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('prevalence') border-red-500 @enderror" value="{{ old('prevalence', $penyakit->prevalence) }}" min="0" max="100" step="0.01">
                        @error('prevalence') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('description') border-red-500 @enderror" rows="3" placeholder="Deskripsi penyakit">{{ old('description', $penyakit->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="symptoms" class="block text-sm font-semibold text-gray-700 mb-1">Gejala</label>
                    <textarea name="symptoms" id="symptoms" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('symptoms') border-red-500 @enderror" rows="3" placeholder="Gejala-gejala penyakit">{{ old('symptoms', $penyakit->symptoms) }}</textarea>
                    @error('symptoms') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </section>

            <div class="mt-10 flex flex-col-reverse sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('penyakit.show', $penyakit->id) }}" class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition duration-300 text-center">Batal</a>
                <button type="submit" class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition duration-300 flex items-center justify-center mb-3 sm:mb-0">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-6 4l2 2 4-4m-2 4h4"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
