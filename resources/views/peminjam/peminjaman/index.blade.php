@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Peminjaman Saya</h1>
                    <p class="text-indigo-100 text-lg">Kelola status pengajuan peminjaman</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-list mr-2"></i>
                            <span>{{ ($menunggu ?? 0) + ($disetujui ?? 0) + ($dipinjam ?? 0) + ($selesai ?? 0) }} total peminjaman</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ $menunggu ?? 0 }} menunggu</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-hand-holding mr-2"></i>
                            <span>{{ $dipinjam ?? 0 }} dipinjam</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-chart-line text-4xl mb-2"></i>
                            <p class="text-sm">Aktivitas</p>
                            <p class="text-2xl font-bold">{{ $dipinjam ?? 0 }} Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8">
        {{-- Elegant Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-500 to-orange-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Menunggu</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $menunggu ?? 0 }}</p>
                    <p class="text-sm text-gray-500 mt-1">Menunggu persetujuan</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-check text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Disetujui</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $disetujui ?? 0 }}</p>
                    <p class="text-sm text-gray-500 mt-1">Telah disetujui</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-hand-holding text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Dipinjam</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $dipinjam ?? 0 }}</p>
                    <p class="text-sm text-gray-500 mt-1">Sedang dipinjam</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-500 to-slate-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-flag text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Selesai</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $selesai ?? 0 }}</p>
                    <p class="text-sm text-gray-500 mt-1">Telah selesai</p>
                </div>
            </div>
        </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-list text-indigo-600 text-xl mr-3"></i>
                    <h2 class="text-xl font-bold text-gray-900">Daftar Peminjaman</h2>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('peminjam.alat.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Ajukan Baru
                    </a>
                </div>
            </div>
        </div>

        {{-- Elegant Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($peminjamans as $peminjaman)
                    <tr class="hover:bg-indigo-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr($peminjaman->alat->nama_alat ?? 'A', 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <p class="text-base font-semibold text-gray-900">{{ $peminjaman->alat->nama_alat ?? 'Unknown' }}</p>
                                    <p class="text-sm text-gray-500">{{ $peminjaman->alat->kategori->nama_kategori ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-calendar text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->format('d M Y') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($peminjaman->status == 'menunggu')
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <i class="fas fa-clock mr-1.5"></i>
                                    Menunggu
                                </div>
                            @elseif($peminjaman->status == 'disetujui')
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Disetujui
                                </div>
                            @elseif($peminjaman->status == 'dipinjam')
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    <i class="fas fa-hand-holding mr-1.5"></i>
                                    Dipinjam
                                </div>
                            @elseif($peminjaman->status == 'selesai')
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                    <i class="fas fa-flag mr-1.5"></i>
                                    Selesai
                                </div>
                            @else
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                                    <i class="fas fa-times-circle mr-1.5"></i>
                                    Ditolak
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="showDetail({{ $peminjaman->id }})" 
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </button>
                                @if($peminjaman->status == 'menunggu')
                                <form action="{{ route('peminjam.peminjaman.destroy', $peminjaman->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan peminjaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                                        <i class="fas fa-times mr-2"></i>
                                        Batal
                                    </button>
                                </form>
                                @endif
                                @if($peminjaman->status == 'dipinjam')
                                <a href="{{ route('peminjam.pengembalian.create', $peminjaman->id) }}" 
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors">
                                    <i class="fas fa-undo mr-2"></i>
                                    Kembalikan
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16">
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                    <i class="fas fa-inbox text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada peminjaman</h3>
                                <p class="text-gray-500 mb-4">Ajukan peminjaman alat untuk memulai</p>
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

<!-- Modal Detail Peminjaman -->
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-6 border-0 rounded-2xl shadow-2xl bg-white max-w-lg w-full">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-900">Detail Peminjaman</h3>
            <button onclick="closeDetail()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div id="detailContent" class="space-y-4"></div>
    </div>
</div>

@push('scripts')
<script>
function confirmCancel(button) {
    if (confirm('Apakah Anda yakin ingin membatalkan pengajuan peminjaman ini?')) {
        button.form.submit();
    }
}

function showDetail(id) {
    const data = @json($peminjamans);
    const peminjaman = data.find(p => p.id === id);
    
    if (peminjaman) {
        const content = `
            <div class="space-y-4">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">ID Peminjaman</p>
                            <p class="text-xl font-bold text-gray-900">#${peminjaman.id}</p>
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
                            <p class="text-lg font-bold text-gray-900">${peminjaman.alat.nama}</p>
                            <p class="text-sm text-gray-500">Kode: ${peminjaman.alat.kode || '-'}</p>
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
                            <p class="text-lg font-bold text-gray-900">${peminjaman.jumlah} unit</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-cubes"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-orange-50 to-red-50 p-4 rounded-xl border border-orange-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Tanggal Pinjam</p>
                            <p class="text-lg font-bold text-gray-900">${peminjaman.tanggal_pinjam}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Rencana Kembali</p>
                            <p class="text-lg font-bold text-gray-900">${peminjaman.tanggal_kembali_rencana}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-gray-50 to-slate-50 p-4 rounded-xl border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Status</p>
                            <p class="text-lg font-bold capitalize text-gray-900">${peminjaman.status}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-slate-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    </div>
                </div>
                
                ${peminjaman.keterangan ? `
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 p-4 rounded-xl border border-yellow-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Keterangan</p>
                            <p class="text-sm text-gray-900">${peminjaman.keterangan}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl flex items-center justify-center text-white font-bold">
                            <i class="fas fa-comment"></i>
                        </div>
                    </div>
                </div>
                ` : ''}
            </div>
        `;
        
        document.getElementById('detailContent').innerHTML = content;
        document.getElementById('detailModal').classList.remove('hidden');
    }
}

function closeDetail() {
    document.getElementById('detailModal').classList.add('hidden');
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('fixed') || event.target.classList.contains('bg-opacity-50')) {
        document.getElementById('detailModal').classList.add('hidden');
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.getElementById('detailModal').classList.add('hidden');
    }
});
</script>
@endpush
@endsection
