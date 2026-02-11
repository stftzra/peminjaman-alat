@extends('layouts.dashboard')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Laporan</h1>
        <p class="text-gray-600">Pilih jenis laporan yang ingin dilihat</p>
    </div>

    {{-- Report Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <a href="{{ route('petugas.laporan.peminjaman') }}" class="group">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-200 group-hover:border-blue-300">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                        <i class="fas fa-hand-holding text-blue-600 text-xl"></i>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Laporan Peminjaman</h3>
                <p class="text-sm text-gray-600">Laporan data peminjaman alat dengan berbagai filter</p>
                <div class="mt-4 text-blue-600 text-sm font-medium group-hover:text-blue-700">
                    Lihat Laporan <i class="fas fa-arrow-right ml-1"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('petugas.laporan.pengembalian') }}" class="group">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-200 group-hover:border-green-300">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                        <i class="fas fa-undo text-green-600 text-xl"></i>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Laporan Pengembalian</h3>
                <p class="text-sm text-gray-600">Laporan data pengembalian alat dan denda</p>
                <div class="mt-4 text-green-600 text-sm font-medium group-hover:text-green-700">
                    Lihat Laporan <i class="fas fa-arrow-right ml-1"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('petugas.laporan.alat') }}" class="group">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-200 group-hover:border-purple-300">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition-colors">
                        <i class="fas fa-tools text-purple-600 text-xl"></i>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Laporan Alat</h3>
                <p class="text-sm text-gray-600">Laporan data alat dan stok tersedia</p>
                <div class="mt-4 text-purple-600 text-sm font-medium group-hover:text-purple-700">
                    Lihat Laporan <i class="fas fa-arrow-right ml-1"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('petugas.laporan.user') }}" class="group">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-200 group-hover:border-orange-300">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-orange-100 rounded-lg group-hover:bg-orange-200 transition-colors">
                        <i class="fas fa-users text-orange-600 text-xl"></i>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Laporan User</h3>
                <p class="text-sm text-gray-600">Laporan data pengguna peminjam</p>
                <div class="mt-4 text-orange-600 text-sm font-medium group-hover:text-orange-700">
                    Lihat Laporan <i class="fas fa-arrow-right ml-1"></i>
                </div>
            </div>
        </a>
    </div>

    {{-- Quick Stats --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ \App\Models\Peminjaman::count() }}</div>
                <div class="text-sm text-gray-600">Total Peminjaman</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ \App\Models\Pengembalian::count() }}</div>
                <div class="text-sm text-gray-600">Total Pengembalian</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">{{ \App\Models\Alat::count() }}</div>
                <div class="text-sm text-gray-600">Total Alat</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-orange-600">{{ \App\Models\User::where('role', 'peminjam')->count() }}</div>
                <div class="text-sm text-gray-600">Total Peminjam</div>
            </div>
        </div>
    </div>

</div>
@endsection
