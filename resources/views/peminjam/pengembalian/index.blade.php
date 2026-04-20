@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Riwayat Pengembalian</h1>
                    <p class="text-indigo-100 text-lg">Data seluruh pengembalian alat yang telah dilakukan</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-undo mr-2"></i>
                            <span>{{ $pengembalians->count() }} total pengembalian</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ $pengembalians->where('telat', 0)->count() }} tepat waktu</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span>{{ $pengembalians->where('telat', '>', 0)->count() }} terlambat</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-history text-4xl mb-2"></i>
                            <p class="text-sm">Aktivitas</p>
                            <p class="text-2xl font-bold">{{ $pengembalians->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8">
        {{-- Search and Filter Section --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <input type="text"
                               placeholder="Cari data pengembalian..."
                               class="w-full pl-12 pr-4 py-3 rounded-xl text-gray-700 bg-gray-50 border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                        <svg class="w-5 h-5 absolute left-4 top-3.5 text-gray-400"
                             fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <button class="inline-flex items-center px-4 py-3 text-sm font-medium text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-xl hover:bg-indigo-100 transition-colors">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                    <button class="inline-flex items-center px-4 py-3 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-xl hover:bg-green-100 transition-colors">
                        <i class="fas fa-download mr-2"></i>
                        Export
                    </button>
                </div>
            </div>
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
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors">
                            <i class="fas fa-file-excel mr-2"></i>
                            Export Excel
                        </button>
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                            <i class="fas fa-file-pdf mr-2"></i>
                            Export PDF
                        </button>
                    </div>
                </div>
            </div>

            {{-- Elegant Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Denda</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($pengembalians as $p)
                        <tr class="hover:bg-indigo-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ $loop->iteration }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                        {{ substr($p->peminjaman->alat->nama_alat ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-base font-semibold text-gray-900">{{ $p->peminjaman->alat->nama_alat }}</p>
                                        <p class="text-sm text-gray-500">{{ $p->peminjaman->alat->kode ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                        <i class="fas fa-cubes text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-base font-semibold text-gray-900">{{ $p->peminjaman->jumlah }}</p>
                                        <p class="text-sm text-gray-500">unit</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                        <i class="fas fa-calendar-check text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('H:i') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($p->telat > 0)
                                    <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                                        <i class="fas fa-exclamation-triangle mr-1.5"></i>
                                        {{ $p->telat }} hari terlambat
                                    </div>
                                @else
                                    <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                        <i class="fas fa-check-circle mr-1.5"></i>
                                        Tepat waktu
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($p->denda > 0)
                                    <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <i class="fas fa-money-bill-wave mr-1.5"></i>
                                        Rp {{ number_format($p->denda) }}
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
                                    <button onclick="showPengembalianDetail({{ $p->id }})" 
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-eye mr-2"></i>
                                        Detail
                                    </button>
                                    <a href="{{ route('peminjam.pengembalian.struk', $p->id) }}" 
                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors" 
                                       target="_blank">
                                        <i class="fas fa-print mr-2"></i>
                                        Struk
                                    </a>
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
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data pengembalian</h3>
                                    <p class="text-gray-500 mb-4">Anda belum melakukan pengembalian alat</p>
                                    <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-lg">
                                        <i class="fas fa-list mr-2"></i>
                                        Lihat Peminjaman
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
</div>

<!-- Modal Detail Pengembalian -->
<div id="detailPengembalianModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-6 border-0 rounded-2xl shadow-2xl bg-white max-w-lg w-full">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-900">Detail Pengembalian</h3>
            <button onclick="closePengembalianDetail()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div id="detailPengembalianContent" class="space-y-4"></div>
    </div>
</div>

@push('scripts')
<script>
function showPengembalianDetail(id) {
    const data = @json($pengembalians);
    const pengembalian = data.find(p => p.id === id);
    
    if (pengembalian) {
        const telatClass = pengembalian.telat > 0 ? 'text-red-600' : 'text-green-600';
        const telatText = pengembalian.telat > 0 ? `${pengembalian.telat} hari` : 'Tepat waktu';
        
        const content = `
            <div class="space-y-4">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">ID Pengembalian</p>
                            <p class="text-xl font-bold text-gray-900">#${pengembalian.id}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-hashtag"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-xl border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Alat</p>
                            <p class="text-lg font-bold text-gray-900">${pengembalian.peminjaman.alat.nama}</p>
                            <p class="text-sm text-gray-500">Kode: ${pengembalian.peminjaman.alat.kode || '-'}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-tools"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-xl border border-purple-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Jumlah</p>
                            <p class="text-lg font-bold text-gray-900">${pengembalian.peminjaman.jumlah} unit</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-cubes"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-orange-50 to-red-50 p-4 rounded-xl border border-orange-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Tanggal Pengembalian</p>
                            <p class="text-lg font-bold text-gray-900">${pengembalian.tanggal_pengembalian}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-gray-50 to-slate-50 p-4 rounded-xl border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Status Kembali</p>
                            <p class="text-lg font-bold ${telatClass}">${telatText}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-slate-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 p-4 rounded-xl border border-yellow-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Denda</p>
                            <p class="text-lg font-bold ${pengembalian.denda > 0 ? 'text-red-600' : 'text-green-600'}">
                                Rp ${number_format(pengembalian.denda, 0, ',', '.')}
                            </p>
                            ${pengembalian.denda > 0 ? `<p class="text-sm text-gray-500">${pengembalian.telat} hari × ${number_format(pengembalian.peminjaman.alat.harga_denda, 0, ',', '.')}/hari</p>` : ''}
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.getElementById('detailPengembalianContent').innerHTML = content;
        document.getElementById('detailPengembalianModal').classList.remove('hidden');
    }
}

function closePengembalianDetail() {
    document.getElementById('detailPengembalianModal').classList.add('hidden');
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('fixed') || event.target.classList.contains('bg-opacity-50')) {
        const modals = document.querySelectorAll('[id$="Modal"]:not(.hidden)');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('[id$="Modal"]:not(.hidden)');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
    }
});
</script>
@endpush
@endsection
