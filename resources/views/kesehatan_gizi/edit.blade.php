@extends('layouts.app')

@section('title', 'Edit Data Kesehatan Gizi')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 sm:p-8 rounded-3xl shadow-2xl">

        <header class="mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-700">Formulir Edit Data Kesehatan Gizi</h1>
            <p class="text-sm text-gray-600 mt-2">Perbarui informasi kesehatan gizi untuk: <span class="font-semibold">{{ $kesehatan_gizi->penduduk->nama }}</span></p>
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

        <form action="{{ route('kesehatan_gizi.update', $kesehatan_gizi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="mb-8 p-4 sm:p-6 border border-blue-200 rounded-xl bg-blue-50/50 shadow-inner">
                <h2 class="text-xl font-bold text-blue-800 mb-4 border-b border-blue-200 pb-2">
                    Informasi Kesehatan Gizi
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="sektor_id" class="block text-sm font-semibold text-gray-700 mb-1">Sektor <span class="text-red-500">*</span></label>
                        <select name="sektor_id" id="sektor_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('sektor_id') border-red-500 @enderror" required>
                            <option value="">Pilih Sektor</option>
                            @foreach($sektors as $sektor)
                                <option value="{{ $sektor->id }}" {{ old('sektor_id', $kesehatan_gizi->sektor_id) == $sektor->id ? 'selected' : '' }}>{{ $sektor->name }}</option>
                            @endforeach
                        </select>
                        @error('sektor_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="penduduk_id" class="block text-sm font-semibold text-gray-700 mb-1">Penduduk <span class="text-red-500">*</span></label>
                        <select name="penduduk_id" id="penduduk_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('penduduk_id') border-red-500 @enderror" required>
                            <option value="">Pilih Penduduk</option>
                            @foreach($penduduks as $penduduk)
                                <option value="{{ $penduduk->id }}" {{ old('penduduk_id', $kesehatan_gizi->penduduk_id) == $penduduk->id ? 'selected' : '' }}>{{ $penduduk->nama }}</option>
                            @endforeach
                        </select>
                        @error('penduduk_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="bmi" class="block text-sm font-semibold text-gray-700 mb-1">BMI</label>
                        <input type="number" name="bmi" id="bmi" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('bmi') border-red-500 @enderror" value="{{ old('bmi', $kesehatan_gizi->bmi) }}" step="0.01" min="0">
                        @error('bmi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="diet_type" class="block text-sm font-semibold text-gray-700 mb-1">Tipe Diet</label>
                        <input type="text" name="diet_type" id="diet_type" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('diet_type') border-red-500 @enderror" value="{{ old('diet_type', $kesehatan_gizi->diet_type) }}">
                        @error('diet_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="nutritional_status" class="block text-sm font-semibold text-gray-700 mb-1">Status Gizi</label>
                        <select name="nutritional_status" id="nutritional_status" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('nutritional_status') border-red-500 @enderror">
                            <option value="">Pilih Status Gizi</option>
                            <option value="Normal" {{ old('nutritional_status', $kesehatan_gizi->nutritional_status) == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Malnourished" {{ old('nutritional_status', $kesehatan_gizi->nutritional_status) == 'Malnourished' ? 'selected' : '' }}>Malnourished</option>
                            <option value="Overweight" {{ old('nutritional_status', $kesehatan_gizi->nutritional_status) == 'Overweight' ? 'selected' : '' }}>Overweight</option>
                            <option value="Obese" {{ old('nutritional_status', $kesehatan_gizi->nutritional_status) == 'Obese' ? 'selected' : '' }}>Obese</option>
                        </select>
                        @error('nutritional_status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="assessment_date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Assessment</label>
                        <input type="date" name="assessment_date" id="assessment_date" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('assessment_date') border-red-500 @enderror" value="{{ old('assessment_date', $kesehatan_gizi->assessment_date) }}">
                        @error('assessment_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="deficiencies" class="block text-sm font-semibold text-gray-700 mb-1">Defisiensi</label>
                    <textarea name="deficiencies" id="deficiencies" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('deficiencies') border-red-500 @enderror" rows="3" placeholder="Defisiensi nutrisi (contoh: Vitamin D, Iron)">{{ old('deficiencies', $kesehatan_gizi->deficiencies) }}</textarea>
                    @error('deficiencies') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </section>

            <div class="mt-10 flex flex-col-reverse sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('kesehatan_gizi.show', $kesehatan_gizi->id) }}" class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition duration-300 text-center">Batal</a>
                <button type="submit" class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition duration-300 flex items-center justify-center mb-3 sm:mb-0">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-6 4l2 2 4-4m-2 4h4"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
