@extends('layouts.app')

@section('title', 'Edit Wilayah')

@section('content')

{{-- Include Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl">
        <header class="mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">
                Edit Data Wilayah
            </h1>
            <p class="text-sm text-gray-500">Klik pada peta untuk mengubah lokasi wilayah.</p>
        </header>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4">
                <strong class="font-bold">Gagal Validasi!</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('wilayah.update', $wilayah) }}" method="POST" id="wilayah-form">
            @csrf
            @method('PUT')

            <!-- Map Section -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Lokasi di Peta</label>
                <div id="map" style="height: 400px; width: 100%; border-radius: 8px;" class="border border-gray-300"></div>
            </div>

            <div class="space-y-4">
                <!-- Nama Desa -->
                <div>
                    <label for="nama_desa" class="block text-sm font-medium text-gray-700 mb-1">Nama Desa/Kelurahan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_desa" id="nama_desa" value="{{ old('nama_desa', $wilayah->nama_desa) }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border">
                </div>

                <!-- Nama Kecamatan -->
                <div>
                    <label for="nama_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Nama Kecamatan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_kecamatan" id="nama_kecamatan" value="{{ old('nama_kecamatan', $wilayah->nama_kecamatan) }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border">
                </div>

                <!-- Nama Kabupaten -->
                <div>
                    <label for="nama_kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Nama Kabupaten <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_kabupaten" id="nama_kabupaten" value="{{ old('nama_kabupaten', $wilayah->nama_kabupaten) }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border">
                </div>

                <!-- Kode Pos -->
                <div>
                    <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos (Opsional)</label>
                    <input type="text" name="kode_pos" id="kode_pos" value="{{ old('kode_pos', $wilayah->kode_pos) }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border">
                </div>

                <!-- Latitude and Longitude (Hidden) -->
                <input type="hidden" name="latitude" id="latitude" value="{{ $wilayah->latitude }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ $wilayah->longitude }}">
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('wilayah.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 mr-2">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 4.04A11.955 11.955 0 005 15.044a11.956 11.956 0 0014 0 11.956 11.956 0 001.382-8.026z"></path></svg>
                    Update Wilayah
                </button>
            </div>
        </form>
    </div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Map
    var map = L.map('map').setView([-5.4, 119.6], 10); // Center on South Sulawesi

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // If existing lat/lng, set marker
    var existingLat = {{ $wilayah->latitude ?? 'null' }};
    var existingLng = {{ $wilayah->longitude ?? 'null' }};
    if (existingLat && existingLng) {
        marker = L.marker([existingLat, existingLng]).addTo(map);
        map.setView([existingLat, existingLng], 15);
    }

    // Allow clicking on map to set location
    map.on('click', function(e) {
        var latlng = e.latlng;
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(latlng).addTo(map);
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
    });
});
</script>
