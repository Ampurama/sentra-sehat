@extends('layouts.app')

@section('title', 'Detail Data Penduduk: ' . $penduduk->nama)

@section('content')

    {{-- Main Container --}}
    <div class="max-w-5xl mx-auto p-4 md:p-0"> 
        <header class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Detail Data Penduduk
                </h1>
                <p class="text-sm text-gray-500">Informasi lengkap NIK: <span class="font-semibold text-gray-700">{{ $penduduk->NIK }}</span></p>
            </div>
            <a href="{{ route('penduduk.index') }}" class="mt-3 sm:mt-0 text-emerald-600 hover:text-emerald-800 transition duration-150 flex items-center text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>
        </header>
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-4 shadow-md" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Grid Utama: 2 kolom besar, 1 kolom samping --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- KIRI: Data Kependudukan --}}
            <div class="lg:col-span-2 bg-white p-4 sm:p-6 rounded-xl shadow-xl">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Data Kependudukan</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                    
                    <div>
                        <p class="font-medium text-gray-500">Nama Lengkap:</p>
                        <p class="font-bold text-gray-900">{{ $penduduk->nama }}</p>
                    </div>
                    
                    <div>
                        <p class="font-medium text-gray-500">NIK:</p>
                        <p class="font-bold text-gray-900">{{ $penduduk->NIK }}</p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-500">TTL:</p>
                        <p class="text-gray-900">{{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</p>
                    </div>
                    
                    <div>
                        <p class="font-medium text-gray-500">Jenis Kelamin:</p>
                        <p class="text-gray-900">{{ $penduduk->JK == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="font-medium text-gray-500">Alamat Lengkap:</p>
                        <p class="text-gray-900">{{ $penduduk->alamat_lengkap }}</p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-500">Wilayah Tercatat:</p>
                        <p class="font-semibold text-emerald-600">{{ $penduduk->wilayah->nama_kecamatan ?? 'Wilayah Tidak Ditemukan' }}</p>
                    </div>
                    
                    <div>
                        <p class="font-medium text-gray-500">No. Telepon:</p>
                        <p class="text-gray-900">{{ $penduduk->no_telp ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-500">No. BPJS:</p>
                        <p class="text-gray-900">{{ $penduduk->no_bpjs ?? '-' }}</p>
                    </div>

                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-6 pt-4 border-t flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                    @if(auth()->user()->role->name !== 'kades')
                    <a href="{{ route('intervensi.create', ['penduduk_id' => $penduduk->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl shadow-md transition duration-300 text-center">
                        + Catat Intervensi
                    </a>
                    @endif
                    <a href="{{ route('penduduk.edit', $penduduk->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-xl shadow-md transition duration-300 text-center">
                        Edit Data
                    </a>
                    
                    {{-- Tombol Delete --}}
                    <form action="{{ route('penduduk.destroy', $penduduk->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-xl shadow-md transition duration-300 text-center">
                            Hapus Data
                        </button>
                    </form>
                </div>
            </div>

            {{-- KANAN: Faktor Risiko --}}
            @if(auth()->user()->role->name !== 'kades')
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-xl border-l-4 border-red-500 h-full">
                <h2 class="text-xl font-semibold text-red-700 mb-4 border-b pb-2">Faktor Risiko</h2>

                @if ($penduduk->faktorRisiko)
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-700">Riwayat Merokok:</span>
                            <span class="font-bold {{ $penduduk->faktorRisiko->riwayat_merokok ? 'text-red-600' : 'text-green-600' }}">
                                {{ $penduduk->faktorRisiko->riwayat_merokok ? 'YA' : 'TIDAK' }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-700">Riwayat Alkohol:</span>
                            <span class="font-bold {{ $penduduk->faktorRisiko->riwayat_alkohol ? 'text-red-600' : 'text-green-600' }}">
                                {{ $penduduk->faktorRisiko->riwayat_alkohol ? 'YA' : 'TIDAK' }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-700">Penyakit Keturunan:</span>
                            <span class="font-bold {{ $penduduk->faktorRisiko->riwayat_penyakit_keturunan ? 'text-red-600' : 'text-green-600' }}">
                                {{ $penduduk->faktorRisiko->riwayat_penyakit_keturunan ? 'YA' : 'TIDAK' }}
                            </span>
                        </div>

                        <div class="pt-4 border-t mt-4">
                            <p class="font-medium text-gray-500">Edukasi/Intervensi Diberikan:</p>
                            <p class="text-xs italic text-gray-700">{{ $penduduk->faktorRisiko->data_edukasi_telah_diberikan ?? '-' }}</p>
                        </div>

                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">Data faktor risiko belum diinisiasi untuk penduduk ini.</p>
                @endif
            </div>
            @endif

            {{-- BAWAH KIRI: Data Klinis Pasien --}}
            @if(auth()->user()->role->name !== 'kades')
            <div class="lg:col-span-2 bg-white p-4 sm:p-6 rounded-xl shadow-xl mt-4">
                <h2 class="text-xl font-semibold text-purple-700 mb-4 border-b pb-2">Data Klinis Pasien</h2>

                @if ($penduduk->data_klinis_ringkas || $penduduk->diagnosis_utama || $penduduk->diagnosis_penyerta || $penduduk->tindakan_perawatan || $penduduk->obat_pulang || $penduduk->alat_kesehatan_rumah || $penduduk->status_fungsional_pulang || $penduduk->hasil_pemeriksaan_terakhir)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        @if ($penduduk->data_klinis_ringkas)
                            <div class="md:col-span-2">
                                <p class="font-medium text-gray-500">Data Klinis Ringkas:</p>
                                <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $penduduk->data_klinis_ringkas }}</p>
                            </div>
                        @endif

                        @if ($penduduk->diagnosis_utama)
                            <div>
                                <p class="font-medium text-gray-500">Diagnosis Utama:</p>
                                <p class="text-gray-900">{{ $penduduk->diagnosis_utama }}</p>
                            </div>
                        @endif

                        @if ($penduduk->diagnosis_penyerta)
                            <div>
                                <p class="font-medium text-gray-500">Diagnosis Penyerta:</p>
                                <p class="text-gray-900">{{ $penduduk->diagnosis_penyerta }}</p>
                            </div>
                        @endif

                        @if ($penduduk->tindakan_perawatan)
                            <div class="md:col-span-2">
                                <p class="font-medium text-gray-500">Tindakan Selama Perawatan:</p>
                                <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $penduduk->tindakan_perawatan }}</p>
                            </div>
                        @endif

                        @if ($penduduk->obat_pulang)
                            <div class="md:col-span-2">
                                <p class="font-medium text-gray-500">Obat Pulang:</p>
                                <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $penduduk->obat_pulang }}</p>
                            </div>
                        @endif

                        @if ($penduduk->alat_kesehatan_rumah)
                            <div class="md:col-span-2">
                                <p class="font-medium text-gray-500">Alat Kesehatan yang diperlukan di rumah:</p>
                                <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $penduduk->alat_kesehatan_rumah }}</p>
                            </div>
                        @endif

                        @if ($penduduk->status_fungsional_pulang)
                            <div>
                                <p class="font-medium text-gray-500">Status Fungsional saat Pulang:</p>
                                <p class="text-gray-900">{{ $penduduk->status_fungsional_pulang }}</p>
                            </div>
                        @endif

                        @if ($penduduk->hasil_pemeriksaan_terakhir)
                            <div class="md:col-span-2">
                                <p class="font-medium text-gray-500">Hasil Pemeriksaan Penting Terakhir:</p>
                                <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $penduduk->hasil_pemeriksaan_terakhir }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">Data klinis pasien belum diisi untuk penduduk ini.</p>
                @endif
            </div>
            @endif
            
            {{-- BAWAH: Riwayat Tindakan Intervensi --}}
            @if(auth()->user()->role->name !== 'kades')
            <div class="lg:col-span-3 bg-white p-4 sm:p-6 rounded-xl shadow-xl mt-4">
                 <h2 class="text-xl font-semibold text-blue-700 mb-4 border-b pb-2">Riwayat Tindakan Intervensi ({{ $penduduk->riwayatIntervensi->count() }}x)</h2>

                 <div class="max-h-96 overflow-y-auto pr-2">
                    @forelse ($penduduk->riwayatIntervensi as $riwayat)
                        <div class="mb-4 p-4 border border-gray-100 rounded-xl shadow-md bg-white hover:shadow-lg transition duration-200">
                            {{-- Header Riwayat --}}
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-gray-200 pb-2 mb-2">
                                <span class="text-md font-extrabold text-blue-700">
                                    {{ \Carbon\Carbon::parse($riwayat->tgl_tindakan)->isoFormat('D MMMM YYYY') }}
                                </span>
                                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full mt-1 sm:mt-0">
                                    Petugas: {{ $riwayat->petugas->name ?? 'Anonim' }}
                                </span>
                            </div>

                            {{-- Detail Riwayat --}}
                            <p class="mb-1 text-sm"><strong class="text-gray-700">Diagnosis:</strong> {{ $riwayat->diagnosis_utama }}</p>
                            <p class="mb-1 text-sm"><strong class="text-gray-700">Tindakan:</strong> {{ $riwayat->tindakan_selama_perawatan }}</p>
                            <p class="mb-1 text-sm"><strong class="text-gray-700">Status Fungsional:</strong>
                                <span class="font-bold
                                    @if($riwayat->status_fungsional == 'Buruk') text-red-600
                                    @elseif($riwayat->status_fungsional == 'Sedang') text-yellow-600
                                    @else text-green-600
                                    @endif">
                                    {{ $riwayat->status_fungsional }}
                                </span>
                            </p>

                            {{-- Rencana Lanjutan --}}
                            @if ($riwayat->rencanaLanjutan)
                                <div class="mt-3 pt-3 border-t border-dashed border-gray-300 text-xs">
                                    <h4 class="font-bold text-gray-700">Tindak Lanjut:</h4>
                                    <p>Kontrol Berikutnya:
                                        <span class="font-medium text-red-600">
                                            {{ $riwayat->rencanaLanjutan->jadwal_kontrol_berikutnya ? \Carbon\Carbon::parse($riwayat->rencanaLanjutan->jadwal_kontrol_berikutnya)->isoFormat('D MMMM YYYY') : 'Belum Ditentukan' }}
                                        </span>
                                    </p>
                                    <p>Terapi Lanjutan: {{ $riwayat->rencanaLanjutan->terapi_lanjutan ?? '-' }}</p>
                                    <p>Pendampingan: {{ $riwayat->rencanaLanjutan->kebutuhan_pendampingan ?? '-' }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500 bg-gray-50 rounded-xl border border-gray-200">
                            <p>Tidak ada riwayat tindakan intervensi yang ditemukan.</p>
                            <a href="{{ route('intervensi.create', ['penduduk_id' => $penduduk->id]) }}" class="mt-3 inline-block text-blue-600 hover:text-blue-800 font-medium text-sm">
                                + Catat Tindakan Intervensi Baru
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
            @endif
        </div>
    </div>

@endsection
