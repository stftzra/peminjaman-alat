@extends('layouts.dashboard')

@section('content')
<div class="p-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-undo text-indigo-600 text-xl mr-3"></i>
                    <h2 class="text-xl font-bold text-gray-900">Detail Pengembalian</h2>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.pengembalian.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
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

        {{-- Detail Card --}}
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Informasi Peminjam --}}
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Peminjam</h4>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Username:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->user->username ?? 'Unknown' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Email:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->user->email ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Tanggal Pinjam:</span>
                            <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Tanggal Rencana Kembali:</span>
                            <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_kembali_rencana)->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Tanggal Kembali:</span>
                            <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Jumlah:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->jumlah }} unit</span>
                        </div>
                    </div>
                </div>

                {{-- Informasi Alat --}}
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Alat</h4>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Nama Alat:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->alat->nama_alat ?? 'Unknown' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Kode Alat:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->alat->kode_alat ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Kategori:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->alat->kategori->nama_kategori ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Informasi Pengembalian --}}
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pengembalian</h4>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Tanggal Pengembalian:</span>
                            <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Kondisi:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $pengembalian->kondisi ?? 'Tidak diketahui' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Total Denda:</span>
                            <span class="text-sm font-medium text-red-600">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Status Pembayaran:</span>
                            <span class="text-sm font-medium text-gray-900">
                                @if($pengembalian->status_pembayaran == 'lunas')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Lunas
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Belum Lunas
                                    </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
