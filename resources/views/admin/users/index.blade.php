@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Manajemen User</h1>
                    <p class="text-purple-100 text-lg">Kelola semua pengguna sistem dengan mudah</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-users mr-2"></i>
                            <span>{{ $users->count() }} total user</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user-check mr-2"></i>
                            <span>{{ $users->where('role', 'admin')->count() }} admin</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user-tie mr-2"></i>
                            <span>{{ $users->where('role', 'petugas')->count() }} petugas</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-user-shield text-4xl mb-2"></i>
                            <p class="text-sm">Sistem Keamanan</p>
                            <p class="text-2xl font-bold">Aktif</p>
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
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Total User</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $users->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Semua pengguna</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-user-check text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Admin</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $users->where('role', 'admin')->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Administrator</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-user-tie text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Petugas</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $users->where('role', 'petugas')->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Operator</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Peminjam</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $users->where('role', 'peminjam')->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Pengguna biasa</p>
                </div>
            </div>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-users text-purple-600 text-xl mr-3"></i>
                        <h2 class="text-xl font-bold text-gray-900">Daftar User</h2>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-search mr-2"></i>
                            Cari User
                        </button>
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition-colors shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i>
                            Tambah User
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($users as $u)
                        <tr class="hover:bg-purple-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                        {{ substr($u->username ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-base font-semibold text-gray-900">{{ $u->username }}</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-id-badge text-purple-500 text-xs mr-2"></i>
                                            <span class="text-sm text-gray-600">ID: #{{ $u->id }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center text-white font-bold">
                                        <i class="fas fa-envelope text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $u->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($u->role == 'admin')
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-user-shield mr-1"></i>
                                        Administrator
                                    </div>
                                @elseif($u->role == 'petugas')
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-user-tie mr-1"></i>
                                        Petugas
                                    </div>
                                @else
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-user mr-1"></i>
                                        Peminjam
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.users.edit', $u->id) }}" 
                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-edit mr-2"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline">
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
                            <td colspan="4" class="px-6 py-16">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                        <i class="fas fa-users text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada User</h3>
                                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan user pertama untuk mengelola sistem</p>
                                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-purple-600 rounded-xl hover:bg-purple-700 transition-colors shadow-lg">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Tambah User Pertama
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
        text: "User ini akan dihapus permanen!",
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
