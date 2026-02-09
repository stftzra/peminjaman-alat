@extends('layouts.dashboard')

@section('content')
<div class="p-6 space-y-6">

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

        {{-- Gradient Header --}}
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold">Detail Alat</h2>
                    <p class="text-sm opacity-90">Informasi lengkap alat & pengajuan peminjaman</p>
                </div>
                <div class="text-4xl opacity-30">
                    📦
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-6 space-y-6">

            {{-- Informasi Alat --}}
            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-gray-50 rounded-xl p-4 hover:shadow-md transition duration-300">
                    <p class="text-sm text-gray-500">Nama Alat</p>
                    <p class="font-semibold text-gray-800 text-lg">
                        {{ $alat->nama }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 hover:shadow-md transition duration-300">
                    <p class="text-sm text-gray-500">Kategori</p>
                    <p class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                        🏷 {{ $alat->kategori->nama }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 hover:shadow-md transition duration-300">
                    <p class="text-sm text-gray-500">Stok Tersedia</p>
                    <p class="font-semibold text-lg">
                        @if($alat->stok > 0)
                            <span class="text-green-600">
                                {{ $alat->stok }} tersedia
                            </span>
                        @else
                            <span class="text-red-500">
                                Stok Habis
                            </span>
                        @endif
                    </p>
                </div>

            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-200"></div>

            {{-- Form --}}
            <form action="{{ route('peminjam.peminjaman.store') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="alat_id" value="{{ $alat->id }}">

                {{-- Jumlah --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Jumlah
                    </label>
                    <input type="number"
                           name="jumlah"
                           min="1"
                           max="{{ $alat->stok }}"
                           required
                           class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>

                {{-- Tanggal Pinjam --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Pinjam
                    </label>
                    <input type="date"
                           name="tanggal_pinjam"
                           required
                           class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>

                {{-- Tanggal Kembali --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Kembali Rencana
                    </label>
                    <input type="date"
                           name="tanggal_kembali_rencana"
                           required
                           class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 hover:scale-105 transition duration-300">
                        Ajukan Peminjaman
                    </button>

                    <a href="{{ route('peminjam.alat.index') }}"
                       class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
