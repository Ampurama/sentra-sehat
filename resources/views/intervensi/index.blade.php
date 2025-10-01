@extends('layouts.app')

@section('title', 'Mulai Tindakan Intervensi')

@section('content')

    {{-- KONTEN UTAMA: Gunakan lebar yang sedikit lebih lebar (max-w-lg) dan p-4/p-8 yang responsif --}}
    <div class="max-w-lg mx-auto bg-white p-4 sm:p-8 rounded-xl shadow-xl transition-all duration-300">
        <header class="mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800 text-center sm:text-left">
                Mulai Tindakan Intervensi
            </h1>
            <p class="text-sm text-gray-500 text-center sm:text-left mt-1">Cari penduduk berdasarkan **NIK atau Nama** untuk memulai pencatatan tindakan dan diagnosis.</p>
        </header>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Formulir Pencarian --}}
        <form action="{{ route('intervensi.index') }}" method="GET">
            
            <div>
                <label for="keyword" class="block text-sm font-medium text-gray-700 mb-2">Cari NIK atau Nama Penduduk</label>
                <input type="text" name="keyword" id="keyword" value="{{ old('keyword') }}" required
                    {{-- Input Padding lebih besar untuk touch target (p-3 ke p-4) --}}
                    class="block w-full rounded-lg border-gray-300 shadow-md focus:border-blue-500 focus:ring-blue-500 p-4 border transition duration-150"
                    placeholder="Contoh: 3302xxxxxxxxxxxxxx atau Budi Santoso">
                
                @error('keyword')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                {{-- Tombol dengan padding vertikal lebih besar untuk touch target (py-3 ke py-4) --}}
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.01] flex items-center justify-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cari Pasien
                </button>
            </div>
        </form>
    </div>
    

@endsection
