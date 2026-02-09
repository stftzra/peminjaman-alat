@extends('layouts.dashboard')

@section('content')
<div class="p-6">

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

        {{-- Gradient Header --}}
        <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 px-6 py-5 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                
                <div>
                    <h2 class="text-2xl font-semibold tracking-wide">
                        📦 Daftar Alat
                    </h2>
                    <p class="text-sm opacity-90">
                        List seluruh alat yang tersedia untuk dipinjam
                    </p>
                </div>

                {{-- Search Bar --}}
                <div class="relative">
                    <input type="text"
                           placeholder="Cari alat..."
                           class="pl-10 pr-4 py-2 rounded-lg text-sm text-gray-700 focus:ring-2 focus:ring-white focus:outline-none shadow-md">
                    
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                    </svg>
                </div>

            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Alat</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3 text-center">Stok</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($alats as $alat)
                    <tr class="hover:bg-indigo-50 transition duration-300 ease-in-out">
                        
                        <td class="px-6 py-4 text-gray-600 font-medium">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $alat->nama_alat }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700">
                                🏷 {{ $alat->kategori->nama_kategori }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($alat->stok > 0)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    {{ $alat->stok }}
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">
                                    Habis
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('peminjam.alat.show', $alat->id) }}"
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 hover:scale-105 transition duration-300">
                                Detail
                            </a>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                            Tidak ada data alat tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection
