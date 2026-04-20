@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Manajemen Kategori</h1>
                    <p class="text-purple-100 text-lg">Kelola dan organisasi kategori alat dengan mudah</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-folder-open mr-2"></i>
                            <span>{{ $kategoris->count() }} kategori</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-tools mr-2"></i>
                            <span>{{ $kategoris->sum(function($cat) { return $cat->alats ? $cat->alats->count() : 0; }) }} total alat</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-layer-group text-4xl mb-2"></i>
                            <p class="text-sm">Kategori Aktif</p>
                            <p class="text-2xl font-bold">{{ $kategoris->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8">
        {{-- Elegant Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-folder text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Total Kategori</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $kategoris->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Kategori terdaftar</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Kategori Aktif</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $kategoris->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Sedang digunakan</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-tools text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Total Alat</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $kategoris->sum(function($cat) { return $cat->alats ? $cat->alats->count() : 0; }) }}</p>
                    <p class="text-sm text-gray-500 mt-1">Alat terdaftar</p>
                </div>
            </div>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-list text-purple-600 text-xl mr-3"></i>
                        <h2 class="text-xl font-bold text-gray-900">Daftar Kategori</h2>
                    </div>
                    <div class="flex items-center space-x-3">
                    <form method="GET" action="{{ route('admin.kategori.index') }}" class="flex items-center">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request()->input('search') }}" 
                                   placeholder="Cari kategori..." 
                                   class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        @if(request()->input('search'))
                            <a href="{{ route('admin.kategori.index') }}" class="ml-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </form>
                    <a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition-colors shadow-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kategori
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

            {{-- Elegant Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah Alat</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($kategoris as $kategori)
                        <tr class="hover:bg-purple-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                        {{ substr($kategori->nama_kategori, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-base font-semibold text-gray-900">{{ $kategori->nama_kategori }}</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-tools text-purple-500 text-xs mr-2"></i>
                                            <span class="text-sm text-gray-600">{{ $kategori->alats ? $kategori->alats->count() : 0 }} alat</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    <i class="fas fa-boxes mr-1"></i>
                                    {{ $kategori->alats ? $kategori->alats->count() : 0 }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.kategori.edit', $kategori->id) }}" 
                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-edit mr-2"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                                            <i class="fas fa-trash mr-2"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-16">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                        <i class="fas fa-folder-open text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Kategori</h3>
                                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan kategori pertama untuk mengelola alat Anda</p>
                                    <a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition-colors shadow-lg">
                                        <i class="fas fa-plus mr-2"></i>
                                        Tambah Kategori Pertama
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

@push('scripts')
<script>
function confirmDelete(button) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Kategori ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#8B5CF6',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            button.form.submit();
        }
    });
}
</script>
@endpush
@endsection
