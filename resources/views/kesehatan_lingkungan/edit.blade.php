@extends('layouts.app')

@section('title', 'Edit Data Kesehatan Lingkungan')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 sm:p-8 rounded-3xl shadow-2xl">

        <header class="mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-700">Formulir Edit Data Kesehatan Lingkungan</h1>
            <p class="text-sm text-gray-600 mt-2">Perbarui informasi kesehatan lingkungan untuk wilayah: <span class="font-semibold">{{ $kesehatanLingkungan->wilayah->nama }}</span></p>
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

        <form action="{{ route('kesehatan_lingkungan.update', $kesehatanLingkungan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="mb-8 p-4 sm:p-6 border border-blue-200 rounded-xl bg-blue-50/50 shadow-inner">
                <h2 class="text-xl font-bold text-blue-800 mb-4 border-b border-blue-200 pb-2">
                    Informasi Kesehatan Lingkungan
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="sektor_id" class="block text-sm font-semibold text-gray-700 mb-1">Sektor <span class="text-red-500">*</span></label>
                        <select name="sektor_id" id="sektor_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('sektor_id') border-red-500 @enderror" required>
                            <option value="">Pilih Sektor</option>
                            @foreach($sektors as $sektor)
                                <option value="{{ $sektor->id }}" {{ old('sektor_id', $kesehatanLingkungan->sektor_id) == $sektor->id ? 'selected' : '' }}>{{ $sektor->name }}</option>
                            @endforeach
                        </select>
                        @error('sektor_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="wilayah_id" class="block text-sm font-semibold text-gray-700 mb-1">Wilayah <span class="text-red-500">*</span></label>
                        <select name="wilayah_id" id="wilayah_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('wilayah_id') border-red-500 @enderror" required>
                            <option value="">Pilih Wilayah</option>
                            @foreach($wilayahs as $wilayah)
                                <option value="{{ $wilayah->id }}" {{ old('wilayah_id', $kesehatanLingkungan->wilayah_id) == $wilayah->id ? 'selected' : '' }}>{{ $wilayah->nama }}</option>
                            @endforeach
                        </select>
                        @error('wilayah_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="air_quality" class="block text-sm font-semibold text-gray-700 mb-1">Kualitas Udara (AQI)</label>
                        <input type="number" name="air_quality" id="air_quality" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('air_quality') border-red-500 @enderror" value="{{ old('air_quality', $kesehatanLingkungan->air_quality) }}" min="0" max="500">
                        @error('air_quality') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="sanitation_level" class="block text-sm font-semibold text-gray-700 mb-1">Tingkat Sanitasi</label>
                        <select name="sanitation_level" id="sanitation_level" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('sanitation_level') border-red-500 @enderror">
                            <option value="">Pilih Tingkat Sanitasi</option>
                            <option value="Baik" {{ old('sanitation_level', $kesehatanLingkungan->sanitation_level) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Sedang" {{ old('sanitation_level', $kesehatanLingkungan->sanitation_level) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Buruk" {{ old('sanitation_level', $kesehatanLingkungan->sanitation_level) == 'Buruk' ? 'selected' : '' }}>Buruk</option>
                        </select>
                        @error('sanitation_level') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="waste_management" class="block text-sm font-semibold text-gray-700 mb-1">Pengelolaan Sampah</label>
                        <select name="waste_management" id="waste_management" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('waste_management') border-red-500 @enderror">
                            <option value="">Pilih Pengelolaan Sampah</option>
                            <option value="Baik" {{ old('waste_management', $kesehatanLingkungan->waste_management) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Sedang" {{ old('waste_management', $kesehatanLingkungan->waste_management) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Buruk" {{ old('waste_management', $kesehatanLingkungan->waste_management) == 'Buruk' ? 'selected' : '' }}>Buruk</option>
                        </select>
                        @error('waste_management') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('description') border-red-500 @enderror" rows="4" placeholder="Deskripsi kondisi lingkungan">{{ old('description', $kesehatanLingkungan->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </section>

            <div class="mt-10 flex flex-col-reverse sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('kesehatan_lingkungan.show', $kesehatanLingkungan->id) }}" class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition duration-300 text-center">Batal</a>
                <button type="submit" class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition duration-300 flex items-center justify-center mb-3 sm:mb-0">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-6 4l2 2 4-4m-2 4h4"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
