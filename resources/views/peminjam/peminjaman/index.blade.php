@extends('layouts.dashboard')

@section('content')
<div class="p-4">

    {{-- Header --}}
    <div class="mb-4">
        <h1 class="text-xl font-bold text-gray-900">Peminjaman Saya</h1>
        <p class="text-sm text-gray-600">Kelola status pengajuan peminjaman</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-100 rounded flex items-center justify-center">
                    <i class="fas fa-clock text-blue-600 text-sm"></i>
                </div>
                <div class="ml-2">
                    <p class="text-xs text-gray-500">Menunggu</p>
                    <p class="text-base font-semibold text-gray-900">{{ $menunggu ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-green-100 rounded flex items-center justify-center">
                    <i class="fas fa-check text-green-600 text-sm"></i>
                </div>
                <div class="ml-2">
                    <p class="text-xs text-gray-500">Disetujui</p>
                    <p class="text-base font-semibold text-gray-900">{{ $disetujui ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-purple-100 rounded flex items-center justify-center">
                    <i class="fas fa-hand-holding text-purple-600 text-sm"></i>
                </div>
                <div class="ml-2">
                    <p class="text-xs text-gray-500">Dipinjam</p>
                    <p class="text-base font-semibold text-gray-900">{{ $dipinjam ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-100 rounded flex items-center justify-center">
                    <i class="fas fa-flag text-gray-600 text-sm"></i>
                </div>
                <div class="ml-2">
                    <p class="text-xs text-gray-500">Selesai</p>
                    <p class="text-base font-semibold text-gray-900">{{ $selesai ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-lg border border-gray-200">

        {{-- Card Header --}}
        <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-base font-semibold text-gray-900">Daftar Peminjaman</h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('peminjam.alat.index') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-1.5 text-xs"></i>
                    Ajukan Baru
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Alat</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Tanggal</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Status</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($peminjamans as $peminjaman)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr($peminjaman->alat->nama_alat ?? 'A', 0, 1) }}
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm font-medium text-gray-900">{{ $peminjaman->alat->nama_alat ?? 'Unknown' }}</p>
                                    <p class="text-xs text-gray-500">{{ $peminjaman->alat->kategori->nama_kategori ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M') }}</p>
                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->format('d M') }}</p>
                        </td>
                        <td class="px-4 py-3">
                            @if($peminjaman->status == 'menunggu')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1 text-xs"></i>
                                    Menunggu
                                </span>
                            @elseif($peminjaman->status == 'disetujui')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1 text-xs"></i>
                                    Disetujui
                                </span>
                            @elseif($peminjaman->status == 'dipinjam')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-hand-holding mr-1 text-xs"></i>
                                    Dipinjam
                                </span>
                            @elseif($peminjaman->status == 'selesai')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-flag mr-1 text-xs"></i>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times mr-1 text-xs"></i>
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <button class="p-1 text-gray-400 hover:text-blue-600">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                                @if($peminjaman->status == 'menunggu')
                                <form action="{{ route('peminjam.peminjaman.destroy', $peminjaman->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmCancel(this)" class="p-1 text-gray-400 hover:text-red-600">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-inbox text-3xl text-gray-300 mb-2"></i>
                                <p class="text-sm font-medium">Belum ada peminjaman</p>
                                <p class="text-xs text-gray-400">Ajukan peminjaman alat untuk memulai</p>
                            </div>
                        </td>   
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@push('scripts')
<script>
function confirmCancel(button) {
    if (confirm('Apakah Anda yakin ingin membatalkan pengajuan peminjaman ini?')) {
        button.form.submit();
    }
}
</script>
@endpush
@endsection
