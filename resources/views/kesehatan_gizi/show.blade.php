@extends('layouts.app')

@section('title', 'Detail Data Kesehatan Gizi')

@section('content')

    <div class="max-w-4xl mx-auto p-4 md:p-0">
        <header class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Detail Data Kesehatan Gizi
                </h1>
                <p class="text-sm text-gray-500">Informasi lengkap kesehatan gizi untuk: <span class="font-semibold text-gray-700">{{ $kesehatan_gizi->penduduk->nama }}</span></p>
            </div>
            <a href="{{ route('kesehatan_gizi.index') }}" class="mt-3 sm:mt-0 text-emerald-600 hover:text-emerald-800 transition duration-150 flex items-center text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>
        </header>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-4 shadow-md" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-xl">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Kesehatan Gizi</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm">

                <div>
                    <p class="font-medium text-gray-500">Sektor:</p>
                    <p class="font-bold text-gray-900">{{ $kesehatan_gizi->sektor->name }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Penduduk:</p>
                    <p class="font-bold text-gray-900">{{ $kesehatan_gizi->penduduk->nama }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">BMI:</p>
                    <p class="font-bold text-gray-900">{{ $kesehatan_gizi->bmi ?? '-' }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Tipe Diet:</p>
                    <p class="font-bold text-gray-900">{{ $kesehatan_gizi->diet_type ?? '-' }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Status Gizi:</p>
                    <p class="font-bold text-gray-900">{{ $kesehatan_gizi->nutritional_status ?? '-' }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Tanggal Assessment:</p>
                    <p class="font-bold text-gray-900">{{ $kesehatan_gizi->assessment_date ? \Carbon\Carbon::parse($kesehatan_gizi->assessment_date)->format('d/m/Y') : '-' }}</p>
                </div>

                <div class="sm:col-span-2">
                    <p class="font-medium text-gray-500">Defisiensi:</p>
                    <p class="text-gray-900">{{ $kesehatan_gizi->deficiencies ?? '-' }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Dibuat Pada:</p>
                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($kesehatan_gizi->created_at)->format('d/m/Y H:i') }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Terakhir Diupdate:</p>
                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($kesehatan_gizi->updated_at)->format('d/m/Y H:i') }}</p>
                </div>

            </div>

            <div class="mt-6 pt-4 border-t flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                <a href="{{ route('kesehatan_gizi.edit', $kesehatan_gizi->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-xl shadow-md transition duration-300 text-center">
                    Edit Data
                </a>

                <form action="{{ route('kesehatan_gizi.destroy', $kesehatan_gizi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-xl shadow-md transition duration-300 text-center">
                        Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
