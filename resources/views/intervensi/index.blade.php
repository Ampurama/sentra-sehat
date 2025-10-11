@extends('layouts.app')

@section('title', 'Mulai Tindakan Intervensi')

@section('content')
<div class="max-w-md mx-auto w-full px-4">
    <div class="backdrop-blur-lg bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 p-6 sm:p-8 transition-all duration-300 hover:shadow-2xl">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-accent-500 to-accent-600 text-white mb-4 shadow-lg">
                <i class="fas fa-stethoscope text-xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Mulai Tindakan Intervensi</h1>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 max-w-prose mx-auto">
                Cari penduduk berdasarkan <strong class="font-medium">NIK atau Nama</strong> untuk memulai pencatatan tindakan dan diagnosis.
            </p>
        </div>

        @if (session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-700 dark:text-red-300 flex items-start">
                <i class="fas fa-exclamation-circle mt-0.5 mr-3 text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('intervensi.index') }}" method="GET" class="space-y-6">
            <div class="relative">
                <label for="keyword" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                    Cari NIK atau Nama Penduduk
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                    <input
                        type="text"
                        name="keyword"
                        id="keyword"
                        value="{{ old('keyword') }}"
                        required
                        class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-300/50 dark:border-gray-600/50 bg-white dark:bg-gray-800/60 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-accent-500/30 focus:border-accent-500 shadow-sm transition-all duration-200"
                        placeholder="Contoh: 3302... atau Budi Santoso"
                    >
                </div>
                @error('keyword')
                    <p class="mt-2 text-sm text-red-500 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full bg-gradient-to-r from-accent-600 to-accent-500 hover:from-accent-700 hover:to-accent-600 text-white font-semibold py-4 px-6 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-accent-400/50 flex items-center justify-center group"
            >
                <i class="fas fa-search mr-3 group-hover:rotate-12 transition-transform duration-200"></i>
                Cari Pasien
            </button>
        </form>
    </div>
</div>
@endsection