@extends('layouts.dashboard')

@section('content')
<div class="p-8">
    <div class="max-w-4xl mx-auto">
        {{-- Header Card --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-indigo-700 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Konfirmasi Pengembalian</h1>
                        <p class="text-blue-100 text-sm mt-1">Proses pengembalian alat yang dipinjam</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                {{-- Info Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    {{-- Peminjam Info --}}
                    <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-xl p-6 border border-green-200">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-gray-800">Data Peminjam</h3>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Username:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $peminjaman->user->username }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Email:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $peminjaman->user->email }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Alat Info --}}
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-.826 2.37a1.724 1.724 0 00-2.572 1.065c-.426-1.756-2.924-1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31.826-2.37 2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31.826-2.37zm1.065-2.572c1.756-.426 1.756-2.924 0-3.35a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31.826-2.37 2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31.826-2.37z"></path>
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-gray-800">Data Alat</h3>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Nama Alat:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $peminjaman->alat->nama_alat }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Kategori:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $peminjaman->alat->kategori->nama_kategori }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Jumlah:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $peminjaman->jumlah }} unit</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Denda Info --}}
                <div class="bg-gradient-to-br from-orange-50 to-amber-100 rounded-xl p-6 border border-orange-200 mb-8">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v8m0-8c-1.11 0-2.08.402-2.599 1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-800">Informasi Denda</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <span class="text-xs text-gray-500 block mb-1">Hari Telat</span>
                            <span class="text-2xl font-bold {{ $hariTelat > 0 ? 'text-red-600' : 'text-green-600' }}">
                                {{ $hariTelat }}
                            </span>
                            <span class="text-xs text-gray-500 block">hari</span>
                        </div>
                        <div class="text-center">
                            <span class="text-xs text-gray-500 block mb-1">Denda/Hari</span>
                            <span class="text-2xl font-bold text-orange-600">
                                {{ number_format($peminjaman->alat->harga_denda, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-500 block">Rp</span>
                        </div>
                        <div class="text-center">
                            <span class="text-xs text-gray-500 block mb-1">Total Denda</span>
                            <span class="text-2xl font-bold {{ $denda > 0 ? 'text-red-600' : 'text-green-600' }}">
                                {{ number_format($denda, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-500 block">Rp</span>
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <form action="{{ route('petugas.pengembalian.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <a href="{{ route('petugas.pengembalian.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Kembali
                        </a>
                        
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Proses Pengembalian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
