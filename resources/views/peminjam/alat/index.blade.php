@extends('layouts.dashboard')

@section('content')
<div class="p-8">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- Gradient Header --}}
        <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 px-8 py-7 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                
                <div>
                    <h2 class="text-2xl font-bold tracking-wide">
                        📦 Daftar Alat
                    </h2>
                    <p class="text-sm opacity-90 mt-1">
                        List seluruh alat yang tersedia untuk dipinjam
                    </p>
                </div>

                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                    {{-- Search Bar --}}
                    <div class="relative w-full md:w-72">
                        <input type="text"
                               placeholder="Cari alat..."
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl text-sm text-gray-700 bg-white shadow-md focus:ring-2 focus:ring-white focus:outline-none transition duration-300">
                        
                        <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400"
                             fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                        </svg>
                    </div>

                    {{-- Tambah Alat Button --}}
                    <a href="{{ route('admin.alat.create') }}" class="inline-flex items-center px-4 py-2.5 bg-white text-indigo-600 rounded-xl shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-white transition duration-300 font-medium text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Alat
                    </a>
                </div>

            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full">

                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Alat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($alats as $alat)
                    <tr class="hover:bg-gray-50 transition-colors">

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $alat->nama_alat }}
                            </div>
                            @if($alat->stok <= 5 && $alat->stok > 0)
                            <div class="text-xs text-orange-600">
                                Stok terbatas
                            </div>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $alat->kategori->nama_kategori }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($alat->stok > 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $alat->stok }} tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Habis
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-2">

                                <a href="{{ route('peminjam.alat.show', $alat->id) }}"
                                   class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                    Detail
                                </a>

                                @if($alat->stok > 0)
                                <a href="{{ route('peminjam.alat.show', $alat->id) }}"
                                   class="ml-3 text-green-600 hover:text-green-900 text-sm font-medium">
                                    Pinjam
                                </a>
                                @endif

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="text-sm font-medium">Tidak ada data alat</p>
                                <p class="text-xs text-gray-400 mt-1">Tambahkan alat untuk memulai</p>
                            </div>
                        </td>   
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>
@endsection
