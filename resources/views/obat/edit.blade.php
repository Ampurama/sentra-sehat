@extends('layouts.app')

@section('title', 'Edit Data Obat: ' . $obat->nama_obat)

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 sm:p-8 rounded-3xl shadow-2xl">

        <header class="mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-700">Formulir Edit Data Obat</h1>
            <p class="text-sm text-gray-600 mt-2">Perbarui informasi obat: <span class="font-semibold">{{ $obat->nama_obat }}</span></p>
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

        <form action="{{ route('obat.update', $obat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="mb-8 p-4 sm:p-6 border border-blue-200 rounded-xl bg-blue-50/50 shadow-inner">
                <h2 class="text-xl font-bold text-blue-800 mb-4 border-b border-blue-200 pb-2">
                    Informasi Obat
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="nama_obat" class="block text-sm font-semibold text-gray-700 mb-1">Nama Obat <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_obat" id="nama_obat" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('nama_obat') border-red-500 @enderror" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
                        @error('nama_obat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="jenis_obat" class="block text-sm font-semibold text-gray-700 mb-1">Jenis Obat <span class="text-red-500">*</span></label>
                        <input type="text" name="jenis_obat" id="jenis_obat" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('jenis_obat') border-red-500 @enderror" value="{{ old('jenis_obat', $obat->jenis_obat) }}" required>
                        @error('jenis_obat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="stok" class="block text-sm font-semibold text-gray-700 mb-1">Stok <span class="text-red-500">*</span></label>
                        <input type="number" name="stok" id="stok" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('stok') border-red-500 @enderror" value="{{ old('stok', $obat->stok) }}" required min="0">
                        @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="harga" class="block text-sm font-semibold text-gray-700 mb-1">Harga</label>
                        <input type="number" name="harga" id="harga" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('harga') border-red-500 @enderror" value="{{ old('harga', $obat->harga) }}" step="0.01" min="0">
                        @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border @error('deskripsi') border-red-500 @enderror" rows="3" placeholder="Deskripsi obat (opsional)">{{ old('deskripsi', $obat->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </section>

            <div class="mt-10 flex flex-col-reverse sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('obat.show', $obat->id) }}" class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition duration-300 text-center">Batal</a>
                <button type="submit" class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition duration-300 flex items-center justify-center mb-3 sm:mb-0">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-6 4l2 2 4-4m-2 4h4"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
