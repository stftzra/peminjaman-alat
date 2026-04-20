@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Laporan Pengembalian Saya</h1>
                    <p class="text-indigo-100 text-lg">Riwayat pengembalian alat yang telah Anda lakukan</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-undo mr-2"></i>
                            <span>{{ $totalPengembalian }} total pengembalian</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ $tepatWaktu }} tepat waktu</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span>{{ $terlambat }} terlambat</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-chart-line text-4xl mb-2"></i>
                            <p class="text-sm">Total Denda</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($totalDenda) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8">

    {{-- Filter --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <form action="{{ route('peminjam.laporan.pengembalian') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Mulai
                    </label>
                    <input type="date" 
                           name="start_date" 
                           value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Selesai
                    </label>
                    <input type="date" 
                           name="end_date" 
                           value="{{ request('end_date', now()->endOfDay()->format('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>
                
                <div class="flex items-end">
                    <button type="submit" 
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    
    {{-- Main Card --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-undo text-indigo-600 text-xl mr-3"></i>
                    <h2 class="text-xl font-bold text-gray-900">Riwayat Pengembalian</h2>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('peminjam.laporan.pengembalian.export-pdf', request()->query()) }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                        <i class="fas fa-file-pdf mr-2"></i>Export PDF
                    </a>
                </div>
            </div>
        </div>

        {{-- Elegant Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Kembali</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Telat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Denda</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($pengembalians as $pengembalian)
                    <tr class="hover:bg-indigo-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                #{{ $pengembalian->id }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr($pengembalian->peminjaman->alat->nama ?? 'A', 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <p class="text-base font-semibold text-gray-900">{{ $pengembalian->peminjaman->alat->nama ?? 'Unknown' }}</p>
                                    <p class="text-sm text-gray-500">{{ $pengembalian->peminjaman->alat->kode ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-calendar-check text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('H:i') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($pengembalian->telat > 0)
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                                    <i class="fas fa-exclamation-triangle mr-1.5"></i>
                                    {{ $pengembalian->telat }} hari
                                </div>
                            @else
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Tepat Waktu
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($pengembalian->denda > 0)
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <i class="fas fa-money-bill-wave mr-1.5"></i>
                                    Rp {{ number_format($pengembalian->denda) }}
                                </div>
                            @else
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                    <i class="fas fa-times-circle mr-1.5"></i>
                                    Tidak ada
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="showDetail({{ $pengembalian->id }})" 
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </button>
                                <a href="{{ route('peminjam.pengembalian.struk', $pengembalian->id) }}" 
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors" 
                                   target="_blank">
                                    <i class="fas fa-print mr-2"></i>
                                    Struk
                                </a>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                <i class="fas fa-check-double mr-1.5"></i>
                                Selesai
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16">
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                    <i class="fas fa-undo text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data pengembalian</h3>
                                <p class="text-gray-500 mb-4">Belum ada pengembalian dalam periode ini</p>
                                <a href="{{ route('peminjam.alat.index') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-lg">
                                    <i class="fas fa-search mr-2"></i>
                                    Cari Alat
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Detail Pengembalian -->
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Detail Pengembalian</h3>
                <button onclick="closeDetail()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="detailContent"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showDetail(id) {
    const data = @json($pengembalians);
    const pengembalian = data.find(p => p.id === id);
    
    if (pengembalian) {
        const telatClass = pengembalian.telat > 0 ? 'text-red-600' : 'text-green-600';
        const telatText = pengembalian.telat > 0 ? `${pengembalian.telat} hari` : 'Tepat waktu';
        
        const content = `
            <div class="space-y-3">
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">ID Pengembalian</p>
                    <p class="text-lg font-semibold">#${pengembalian.id}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Alat</p>
                    <p class="text-lg font-semibold">${pengembalian.peminjaman.alat.nama}</p>
                    <p class="text-sm text-gray-500">Kode: ${pengembalian.peminjaman.alat.kode || '-'}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Jumlah</p>
                    <p class="text-lg font-semibold">${pengembalian.peminjaman.jumlah} unit</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Tanggal Kembali</p>
                    <p class="text-lg font-semibold">${\Carbon\Carbon::parse(pengembalian.tanggal_pengembalian).format('d M Y')}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Status Kembali</p>
                    <p class="text-lg font-semibold ${telatClass}">${telatText}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Denda</p>
                    <p class="text-lg font-semibold ${pengembalian.denda > 0 ? 'text-red-600' : 'text-green-600'}">
                        Rp ${number_format(pengembalian.denda, 0, ',', '.')}
                    </p>
                    ${pengembalian.denda > 0 ? `<p class="text-xs text-gray-500">${pengembalian.telat} hari × ${number_format(pengembalian.peminjaman.alat.harga_denda, 0, ',', '.')}/hari</p>` : ''}
                </div>
            </div>
        `;
        
        document.getElementById('detailContent').innerHTML = content;
        document.getElementById('detailModal').classList.remove('hidden');
    }
}

function closeDetail() {
    document.getElementById('detailModal').classList.add('hidden');
}
</script>
@endpush
@endsection
