@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Manajemen Peminjaman</h1>
                    <p class="text-green-100 text-lg">Kelola semua transaksi peminjaman alat dengan mudah</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-exchange-alt mr-2"></i>
                            <span>{{ $peminjamans->count() }} total transaksi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-hand-holding mr-2"></i>
                            <span>{{ $peminjamans->where('status', 'dipinjam')->count() }} sedang dipinjam</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-chart-line text-4xl mb-2"></i>
                            <p class="text-sm">Transaksi Aktif</p>
                            <p class="text-2xl font-bold">{{ $peminjamans->whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])->count() }}</p>
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
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Menunggu</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $peminjamans->where('status', 'menunggu')->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Menunggu persetujuan</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Disetujui</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $peminjamans->where('status', 'disetujui')->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Sudah disetujui</p>
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
                    <p class="text-3xl font-bold text-gray-900">{{ $peminjamans->where('status', 'dipinjam')->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Sedang dipinjam</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-clipboard-check text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Selesai</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $peminjamans->where('status', 'selesai')->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Selesai dikembalikan</p>
                </div>
            </div>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-exchange-alt text-green-600 text-xl mr-3"></i>
                        <h2 class="text-xl font-bold text-gray-900">Daftar Peminjaman</h2>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-search mr-2"></i>
                            Cari Peminjaman
                        </button>
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                    </div>
                </div>
            </div>

            {{-- Success Alert --}}
            @if(session('success'))
            <div class="mx-6 mt-4 bg-green-50 border border-green-200 rounded-xl p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-green-800">Berhasil!</h3>
                        <div class="mt-2 text-sm text-green-700">{{ session('success') }}</div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Elegant Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Peminjam</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Pinjam</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($peminjamans as $peminjaman)
                        <tr class="hover:bg-green-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                        {{ substr($peminjaman->user->username ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-base font-semibold text-gray-900">{{ $peminjaman->user->username ?? 'Unknown' }}</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-envelope text-blue-500 text-xs mr-2"></i>
                                            <span class="text-sm text-gray-600">{{ $peminjaman->user->email ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center text-white font-bold">
                                        <i class="fas fa-tools text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $peminjaman->alat->nama_alat }}</p>
                                        <p class="text-xs text-gray-500">{{ $peminjaman->alat->kode_alat }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold">
                                        <i class="fas fa-calendar text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('H:i') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold">
                                        <i class="fas fa-calendar-check text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->format('H:i') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-boxes mr-1"></i>
                                    {{ $peminjaman->jumlah }} unit
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @switch($peminjaman->status)
                                    @case('menunggu')
                                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>
                                            Menunggu
                                        </div>
                                        @break
                                    @case('disetujui')
                                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Disetujui
                                        </div>
                                        @break
                                    @case('dipinjam')
                                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-hand-holding mr-1"></i>
                                            Dipinjam
                                        </div>
                                        @break
                                    @case('selesai')
                                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-clipboard-check mr-1"></i>
                                            Selesai
                                        </div>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <button onclick="showDetailModal({{ $peminjaman->id }})" 
                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-eye mr-2"></i>
                                        Detail
                                    </button>
                                    @if($peminjaman->status == 'menunggu')
                                        <button onclick="showApproveModal({{ $peminjaman->id }})" class="inline-flex items-center px-3 py-2 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors">
                                            <i class="fas fa-check mr-2"></i>
                                            Setujui
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                        <i class="fas fa-exchange-alt text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Peminjaman</h3>
                                    <p class="text-gray-500 mb-4">Belum ada transaksi peminjaman yang tercatat dalam sistem</p>
                                    <a href="{{ route('admin.peminjaman.create') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 transition-colors shadow-lg">
                                        <i class="fas fa-plus mr-2"></i>
                                        Tambah Peminjaman
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

{{-- Modal Detail Peminjaman --}}
@foreach($peminjamans as $peminjaman)
    <div id="detailModal{{ $peminjaman->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Detail Peminjaman</h3>
                        <button type="button" onclick="closeDetailModal('detailModal{{ $peminjaman->id }}')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Peminjam</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Username:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $peminjaman->user->username ?? 'Unknown' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Email:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $peminjaman->user->email ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Tanggal Pinjam:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Tanggal Rencana Kembali:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Alat</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Nama Alat:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $peminjaman->alat->nama_alat ?? 'Unknown' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Kode Alat:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $peminjaman->alat->kode_alat ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Kategori:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $peminjaman->alat->kategori->nama_kategori ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Jumlah:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $peminjaman->jumlah }} unit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" onclick="closeDetailModal('detailModal{{ $peminjaman->id }}')" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Modal Approve Peminjaman --}}
@foreach($peminjamans as $peminjaman)
    @if($peminjaman->status == 'menunggu')
    <div id="approveModal{{ $peminjaman->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Setujui Peminjaman</h3>
                        <button type="button" onclick="closeApproveModal('approveModal{{ $peminjaman->id }}')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Peminjam:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $peminjaman->user->username ?? 'Unknown' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Alat:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $peminjaman->alat->nama_alat ?? 'Unknown' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Jumlah:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $peminjaman->jumlah }} unit</span>
                        </div>
                    </div>
                    <div class="border-t pt-3">
                        <p class="text-sm text-gray-600 mb-3">Apakah Anda yakin ingin menyetujui peminjaman ini?</p>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" onclick="closeApproveModal('approveModal{{ $peminjaman->id }}')" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Batal
                    </button>
                    <form action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Setujui
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach

@push('scripts')
<script>
function showDetailModal(peminjamanId) {
    const modal = document.getElementById('detailModal' + peminjamanId);
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function closeDetailModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

function showApproveModal(peminjamanId) {
    const modal = document.getElementById('approveModal' + peminjamanId);
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function closeApproveModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('fixed') || event.target.classList.contains('bg-opacity-50')) {
        const modals = document.querySelectorAll('[id^="detailModal"]:not(.hidden), [id^="approveModal"]:not(.hidden)');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = 'auto';
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('[id^="detailModal"]:not(.hidden), [id^="approveModal"]:not(.hidden)');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = 'auto';
    }
});
</script>
@endpush
@endsection
