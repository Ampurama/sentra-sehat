@extends('layouts.app')

@section('title', 'Tambah User Puskesmas Admin')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Tambah User Puskesmas Admin</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store_puskesmas_admin') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="nik" class="block font-semibold mb-1">NIK</label>
            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">Password</label>
            <input type="password" name="password" id="password" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-semibold mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="nama_kecamatan" class="block font-semibold mb-1">Nama Kecamatan</label>
            <select name="nama_kecamatan" id="nama_kecamatan" required class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Kecamatan --</option>
                @foreach ($kecamatans as $kecamatan)
                    <option value="{{ $kecamatan->nama_kecamatan }}" {{ old('nama_kecamatan') == $kecamatan->nama_kecamatan ? 'selected' : '' }}>
                        {{ $kecamatan->nama_kecamatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
    </form>
</div>
@endsection
