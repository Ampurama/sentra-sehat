<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Desa</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kecamatan</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kabupaten</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($wilayahs as $wilayah)
            <tr>
                <td class="px-6 py-4">{{ $wilayah->nama_desa }}</td>
                <td class="px-6 py-4">{{ $wilayah->nama_kecamatan }}</td>
                <td class="px-6 py-4">{{ $wilayah->nama_kabupaten }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('wilayah.edit', $wilayah->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('wilayah.destroy', $wilayah->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">
    {!! $wilayahs->links() !!}
</div>
