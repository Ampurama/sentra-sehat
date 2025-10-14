<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Wilayah</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah Intervensi</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Penyakit</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($wilayahs as $index => $dist)
            <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                <span class="text-white font-bold text-sm">{{ substr($dist->nama_desa ?? $dist['name'], 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">{{ $dist->nama_desa ?? $dist['name'] }}</div>
                            <div class="text-sm text-gray-500">{{ $dist->nama_kecamatan ?? '' }}, {{ $dist->nama_kabupaten ?? '' }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if(($dist->intervention_count ?? $dist['count']) > 10) bg-red-100 text-red-800
                        @elseif(($dist->intervention_count ?? $dist['count']) > 5) bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800 @endif">
                        {{ $dist->intervention_count ?? $dist['count'] }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $dist->diseases ?? $dist['diseases'] }}">
                        {{ $dist->diseases ?? $dist['diseases'] }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        @if(($dist->intervention_count ?? $dist['count']) > 10) bg-red-100 text-red-800
                        @elseif(($dist->intervention_count ?? $dist['count']) > 5) bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800 @endif">
                        @if(($dist->intervention_count ?? $dist['count']) > 10) ⚠️ Tinggi
                        @elseif(($dist->intervention_count ?? $dist['count']) > 5) ⚡ Sedang
                        @else ✅ Rendah @endif
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
    <div class="flex items-center justify-between text-sm text-gray-600">
        <span>Menampilkan {{ $wilayahs->count() }} dari {{ $wilayahs->total() }} wilayah</span>
        <div class="flex items-center space-x-4">
            <span class="flex items-center">
                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                Rendah (≤5)
            </span>
            <span class="flex items-center">
                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                Sedang (6-10)
            </span>
            <span class="flex items-center">
                <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                Tinggi (>10)
            </span>
        </div>
    </div>
    <div class="mt-4">
        {!! $wilayahs->links() !!}
    </div>
</div>
