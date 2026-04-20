@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Laporan Pengembalian</h1>
                    <p class="text-green-100 text-lg">Laporan data pengembalian alat dan denda</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-undo mr-2"></i>
                            <span>{{ $totalPengembalian }} total pengembalian</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-money-bill mr-2"></i>
                            <span>Rp {{ number_format($totalDenda) }} total denda</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-chart-line text-4xl mb-2"></i>
                            <p class="text-sm">Tingkat Kepatuhan</p>
                            <p class="text-2xl font-bold">{{ $totalPengembalian > 0 ? round(($tepatWaktu / $totalPengembalian) * 100) : 0 }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8">
        {{-- Elegant Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-green-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-undo text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Total Pengembalian</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-green-600">{{ $totalPengembalian }}</p>
                    <p class="text-sm text-gray-500 mt-1">Semua pengembalian</p>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-blue-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Tepat Waktu</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-blue-600">{{ $tepatWaktu }}</p>
                    <p class="text-sm text-gray-500 mt-1">Pengembalian tepat waktu</p>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-red-50 to-rose-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-red-100 overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-rose-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Terlambat</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-red-600">{{ $terlambat }}</p>
                    <p class="text-sm text-gray-500 mt-1">Pengembalian terlambat</p>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-yellow-50 to-amber-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-yellow-100 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-500 to-amber-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-money-bill text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Total Denda</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-2xl font-bold text-yellow-600">Rp {{ number_format($totalDenda) }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total denda terkumpul</p>
                </div>
            </div>
        </div>

        {{-- Filter Form --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-green-50 to-teal-50 px-6 py-4 border-b border-green-100">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-filter text-green-600 mr-3"></i>
                    Filter Laporan
                </h2>
            </div>
            <div class="p-6">
                <form method="GET" action="{{ route('petugas.laporan.pengembalian') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                </div>
                                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" 
                                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                </div>
                                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" 
                                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            </div>
                        </div>
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-teal-600 text-white px-4 py-2 rounded-lg hover:from-green-700 hover:to-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fas fa-filter mr-2"></i>Filter
                            </button>
                            <a href="{{ route('petugas.laporan.pengembalian') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Main Table --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-list text-gray-600 mr-3"></i>
                    Data Pengembalian
                </h2>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('petugas.laporan.export.pengembalian-pdf') }}?start_date={{ $startDate->format('Y-m-d') }}&end_date={{ $endDate->format('Y-m-d') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                        <i class="fas fa-file-pdf mr-2"></i>Export PDF
                    </a>
                </div>
            </div>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Kembali</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Telat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Denda</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($pengembalians as $pengembalian)
                    <tr class="hover:bg-green-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-gray-500 to-slate-600 rounded-lg flex items-center justify-center text-white font-bold text-xs mr-3">
                                    {{ $pengembalian->id }}
                                </div>
                                <span class="text-sm font-medium text-gray-900">#{{ $pengembalian->id }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->user->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">{{ $pengembalian->peminjaman->user->email ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-tools text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->alat->nama_alat ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">{{ $pengembalian->peminjaman->alat->kode_alat ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-boxes text-sm"></i>
                                </div>
                                <span class="text-lg font-bold text-gray-900">{{ $pengembalian->peminjaman->jumlah }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-calendar-check text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-900">{{ $pengembalian->tanggal_pengembalian }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($pengembalian->telat > 0)
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-rose-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                        <i class="fas fa-exclamation-triangle text-sm"></i>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-clock mr-1"></i>{{ $pengembalian->telat }} hari
                                    </span>
                                </div>
                            @else
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                        <i class="fas fa-check-circle text-sm"></i>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Tepat Waktu
                                    </span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-money-bill text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-yellow-600">Rp {{ number_format($pengembalian->denda) }}</p>
                                    <p class="text-xs text-gray-500">denda</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('petugas.pengembalian.show', $pengembalian->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-eye mr-2"></i>Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16">
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                    <i class="fas fa-undo text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data Pengembalian</h3>
                                <p class="text-gray-500">Belum ada data pengembalian dalam periode ini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Tepat waktu
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($pengembalian->denda > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-money-bill mr-1"></i>Rp {{ number_format($pengembalian->denda) }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-times mr-1"></i>Tidak ada
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="showDetail({{ $pengembalian->id }})" 
                                        class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <a href="{{ route('petugas.pengembalian.struk', $pengembalian->id) }}" 
                                   class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors" 
                                   target="_blank">
                                    <i class="fas fa-print text-sm"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-undo text-4xl text-gray-300 mb-3"></i>
                                <p class="text-sm font-medium">Tidak ada data pengembalian</p>
                                <p class="text-xs text-gray-400 mt-1">Belum ada pengembalian dalam periode ini</p>
                            </div>
                        </td>   
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    </div>

<!-- Modal Detail Pengembalian Petugas -->
<div id="detailPetugasModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Detail Pengembalian</h3>
                <button onclick="closePetugasDetail()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="detailPetugasContent"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showDetail(id) {
    console.log('showDetail called with id:', id);
    
    const data = @json($pengembalians);
    console.log('pengembalians data:', data);
    
    const pengembalian = data.find(p => p.id === id);
    console.log('found pengembalian:', pengembalian);
    
    if (pengembalian && pengembalian.peminjaman) {
        const telatClass = pengembalian.telat > 0 ? 'text-red-600' : 'text-green-600';
        const telatText = pengembalian.telat > 0 ? `${pengembalian.telat} hari` : 'Tepat waktu';
        
        const content = `
            <div class="space-y-3">
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">ID Pengembalian</p>
                    <p class="text-lg font-semibold">#${pengembalian.id}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">User</p>
                    <p class="text-lg font-semibold">${pengembalian.peminjaman.user?.name || pengembalian.peminjaman.user?.email || 'Tidak diketahui'}</p>
                    <p class="text-sm text-gray-500">${pengembalian.peminjaman.user?.email || '-'}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Alat</p>
                    <p class="text-lg font-semibold">${pengembalian.peminjaman.alat?.nama || 'Alat tidak diketahui'}</p>
                    <p class="text-sm text-gray-500">Kode: ${pengembalian.peminjaman.alat?.kode || '-'}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Jumlah</p>
                    <p class="text-lg font-semibold">${pengembalian.peminjaman?.jumlah || 0} unit</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Tanggal Kembali</p>
                    <p class="text-lg font-semibold">${pengembalian.tanggal_pengembalian || '-'}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Status Kembali</p>
                    <p class="text-lg font-semibold ${telatClass}">${telatText}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-700">Denda</p>
                    <p class="text-lg font-semibold ${pengembalian.denda > 0 ? 'text-red-600' : 'text-green-600'}">
                        Rp ${number_format(pengembalian.denda || 0, 0, ',', '.')}
                    </p>
                    ${pengembalian.denda > 0 ? `<p class="text-xs text-gray-500">${pengembalian.telat} hari × ${number_format(pengembalian.peminjaman?.alat?.harga_denda || 0, 0, ',', '.')}/hari</p>` : ''}
                </div>
            </div>
        `;
        
        document.getElementById('detailPetugasContent').innerHTML = content;
        document.getElementById('detailPetugasModal').classList.remove('hidden');
        
        console.log('Modal should be visible now');
    } else {
        console.error('Pengembalian not found or incomplete data:', pengembalian);
        alert('Data pengembalian tidak lengkap. Silakan refresh halaman.');
    }
}

function closePetugasDetail() {
    console.log('Closing modal');
    document.getElementById('detailPetugasModal').classList.add('hidden');
}

// Test function
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, checking modal elements...');
    const modal = document.getElementById('detailPetugasModal');
    const content = document.getElementById('detailPetugasContent');
    console.log('Modal element:', modal);
    console.log('Content element:', content);
});
</script>
@endpush
@endsection
