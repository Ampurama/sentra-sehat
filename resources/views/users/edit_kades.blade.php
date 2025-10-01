@extends('layouts.app')

@section('title', 'Edit Kades')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700 border-b border-gray-200">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <h1 class="text-2xl font-bold text-white">Edit Kades</h1>
            </div>
        </div>

        <form method="POST" action="{{ route('users.update', $user->id) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('name') border-red-500 @enderror"
                       placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('email') border-red-500 @enderror"
                       placeholder="Masukkan alamat email" required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', $user->nik) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('nik') border-red-500 @enderror"
                       placeholder="Masukkan NIK" required>
                @error('nik')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="wilayah_id" class="block text-sm font-medium text-gray-700 mb-2">Desa/Kelurahan</label>
                <select id="wilayah_id" name="wilayah_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('wilayah_id') border-red-500 @enderror" required>
                    <option value="">Pilih Desa/Kelurahan</option>
                    @foreach($desas as $desa)
                        <option value="{{ $desa->id }}" {{ old('wilayah_id', $user->wilayah_id) == $desa->id ? 'selected' : '' }}>
                            {{ $desa->nama_desa ? $desa->nama_desa . ', ' . $desa->nama_kecamatan : $desa->nama_kecamatan }}
                        </option>
                    @endforeach
                </select>
                @error('wilayah_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('users.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition duration-150">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
