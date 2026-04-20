@extends('layouts.dashboard')

@section('content')
<div class="p-8">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- Header --}}
        <div class="px-8 py-6 bg-white border-b border-gray-200">
            <div class="flex items-center">
                <a href="{{ route('admin.alat.index') }}" class="mr-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Alat</h1>
                    <p class="text-sm text-gray-500 mt-1">Perbarui informasi alat yang ada</p>
                </div>
            </div>
        </div>
        {{-- Form --}}
        <div class="px-8 py-6">
            <form action="{{ route('admin.alat.update', $alat->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama Alat --}}
                <div>
                    <label for="nama_alat" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Alat <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="nama_alat"
                               name="nama_alat" 
                               value="{{ $alat->nama_alat }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                               placeholder="Masukkan nama alat" 
                               required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="kategori_id" 
                                name="kategori_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none" 
                                required>
                            <option value="">Pilih kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $alat->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Stok --}}
                <div class="hidden">
                    <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" 
                               id="stok"
                               name="stok" 
                               value="{{ $alat->stok }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                               placeholder="0" 
                               min="0" 
                               required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Jumlah alat yang tersedia untuk dipinjam</p>
                </div>

                {{-- Denda per Hari --}}
                <div>
                    <label for="harga_denda" class="block text-sm font-medium text-gray-700 mb-2">
                        Denda per Hari <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                        </div>
                        <input type="number" 
                               id="harga_denda"
                               name="harga_denda" 
                               value="{{ $alat->harga_denda }}" 
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                               placeholder="0" 
                               min="0" 
                               required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Biaya denda jika terlambat mengembalikan alat</p>
                </div>

                {{-- Kondisi Section --}}
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Kondisi Alat
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Kondisi Baik --}}
                        <div>
                            <label for="kondisi_baik" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Kondisi Baik
                                </span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="kondisi_baik"
                                   name="kondisi_baik" 
                                   value="{{ $alat->kondisi_baik ?? 0 }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" 
                                   placeholder="0" 
                                   min="0" 
                                   required>
                            <p class="mt-1 text-xs text-gray-500">Unit yang dalam kondisi baik dan bisa dipinjam</p>
                        </div>

                        {{-- Kondisi Rusak --}}
                        <div>
                            <label for="kondisi_rusak" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    Kondisi Rusak
                                </span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="kondisi_rusak"
                                   name="kondisi_rusak" 
                                   value="{{ $alat->kondisi_rusak ?? 0 }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" 
                                   placeholder="0" 
                                   min="0" 
                                   required>
                            <p class="mt-1 text-xs text-gray-500">Unit yang rusak dan tidak bisa dipinjam</p>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <p class="text-sm text-blue-800">
                            <strong>Informasi:</strong> Stok tersedia akan otomatis dihitung berdasarkan jumlah unit dalam kondisi baik.
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.alat.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Alat
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection
