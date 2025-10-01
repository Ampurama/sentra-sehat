@extends('layouts.app')

@section('title', 'Data Master Wilayah Administratif')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <header class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">
                Pengelolaan Wilayah (Desa/Kelurahan)
            </h1>
            <a href="{{ route('wilayah.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Wilayah Baru
            </a>
        </header>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Form Pencarian -->
        <div class="mb-4 flex flex-wrap items-center justify-between">
            <form id="wilayah-search-form" class="flex items-center gap-2" method="GET" action="{{ route('wilayah.index') }}">
                <input type="text" name="keyword" id="wilayah-keyword" value="{{ request('keyword') }}" class="border rounded-lg px-3 py-2" placeholder="Cari desa/kecamatan/kabupaten...">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Cari</button>
            </form>
        </div>
        <div id="wilayah-table-container">
            @include('wilayah.partials.table', ['wilayahs' => $wilayahs])
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).on('click', '#wilayah-table-container .pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url, function(data) {
                $('#wilayah-table-container').html(data);
            });
        });

        $('#wilayah-search-form').on('submit', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var keyword = $('#wilayah-keyword').val();
            $.get(url, { keyword: keyword }, function(data) {
                $('#wilayah-table-container').html(data);
            });
        });
        </script>
    </div>
</div>
@endsection
