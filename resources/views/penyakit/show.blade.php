@extends('layouts.app')

@section('title', 'Detail Data Penyakit: ' . $penyakit->name)

@section('content')

    <div class="max-w-4xl mx-auto p-4 md:p-0">
        <header class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Detail Data Penyakit
                </h1>
                <p class="text-sm text-gray-500">Informasi lengkap penyakit: <span class="font-semibold text-gray-700">{{ $penyakit->name }}</span></p>
            </div>
            <a href="{{ route('penyakit.index') }}" class="mt-3 sm:mt-0 text-emerald-600 hover:text-emerald-800 transition duration-150 flex items-center text-sm">
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
            <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Penyakit</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm">

                <div>
                    <p class="font-medium text-gray-500">Sektor:</p>
                    <p class="font-bold text-gray-900">{{ $penyakit->sektor->name }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Nama Penyakit:</p>
                    <p class="font-bold text-gray-900">{{ $penyakit->name }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Kode ICD:</p>
                    <p class="font-bold text-gray-900">{{ $penyakit->icd_code ?? '-' }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Spesialisasi:</p>
                    <p class="font-bold text-gray-900">{{ $penyakit->spesialisasi ?? '-' }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Prevalensi:</p>
                    <p class="font-bold text-gray-900">{{ $penyakit->prevalence ? $penyakit->prevalence . '%' : '-' }}</p>
                </div>

                <div class="sm:col-span-2">
                    <p class="font-medium text-gray-500">Deskripsi:</p>
                    <p class="text-gray-900">{{ $penyakit->description ?? '-' }}</p>
                </div>

                <div class="sm:col-span-2">
                    <p class="font-medium text-gray-500">Gejala:</p>
                    <p class="text-gray-900">{{ $penyakit->symptoms ?? '-' }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Dibuat Pada:</p>
                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($penyakit->created_at)->format('d/m/Y H:i') }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-500">Terakhir Diupdate:</p>
                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($penyakit->updated_at)->format('d/m/Y H:i') }}</p>
                </div>

            </div>

            <div class="mt-6 pt-4 border-t flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                <a href="{{ route('penyakit.edit', $penyakit->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-xl shadow-md transition duration-300 text-center">
                    Edit Data
                </a>

                <form action="{{ route('penyakit.destroy', $penyakit->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-xl shadow-md transition duration-300 text-center">
                        Hapus Data
                    </button>
                </form>
            </div>
        </div>

        @if(isset($patients) && count($patients) > 0)
            <div class="bg-white p-6 rounded-xl shadow-xl mt-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Pasien yang Mengalami Penyakit Ini</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Intervensi Terakhir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($patients as $patientData)
                                @php
                                    $pasien = $patientData['pasien'];
                                    $usia = $pasien->ttl ? \Carbon\Carbon::parse($pasien->tgl_lahir)->age : 'Tidak diketahui';
                                    $latestDate = \Carbon\Carbon::parse($patientData['latest_date'])->format('d/m/Y');
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pasien->name ?? 'Tidak diketahui' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pasien->nik ?? 'Tidak diketahui' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $usia }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $latestDate }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('penduduk.show', $pasien->id) }}" class="text-emerald-600 hover:text-emerald-900">Lihat Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white p-6 rounded-xl shadow-xl mt-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Pasien yang Mengalami Penyakit Ini</h2>
                <p class="text-gray-500 text-center py-8">Belum ada pasien yang tercatat mengalami penyakit ini.</p>
            </div>
        @endif
    </div>

@endsection
