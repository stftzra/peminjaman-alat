@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Manajemen Alat</h1>
                    <p class="text-blue-100 text-lg">Kelola dan monitor semua peralatan dengan mudah</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-tools mr-2"></i>
                            <span>{{ $alats->count() }} alat</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-boxes mr-2"></i>
                            <span>{{ number_format($alats->sum('kondisi_baik') + $alats->sum('kondisi_rusak')) }} total unit</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-cogs text-4xl mb-2"></i>
                            <p class="text-sm">Sistem Aktif</p>
                            <p class="text-2xl font-bold">Online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8">

    {{-- Elegant Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                <div class="flex items-center justify-between">
                    <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-tools text-white text-xl"></i>
                    </div>
                    <div class="text-white/80 text-sm">Total Stok</div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-3xl font-bold text-gray-900">{{ number_format($alats->sum('kondisi_baik') + $alats->sum('kondisi_rusak')) }}</p>
                <p class="text-sm text-gray-500 mt-1">Semua unit tersedia</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                <div class="flex items-center justify-between">
                    <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-check-circle text-white text-xl"></i>
                    </div>
                    <div class="text-white/80 text-sm">Tersedia Baik</div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-3xl font-bold text-gray-900">{{ number_format($alats->sum('kondisi_baik')) }}</p>
                <p class="text-sm text-gray-500 mt-1">Unit dalam kondisi baik</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4">
                <div class="flex items-center justify-between">
                    <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-tools text-white text-xl"></i>
                    </div>
                    <div class="text-white/80 text-sm">Unit Rusak</div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-3xl font-bold text-gray-900">{{ number_format($alats->sum('kondisi_rusak')) }}</p>
                <p class="text-sm text-gray-500 mt-1">Unit perlu perbaikan</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-4">
                <div class="flex items-center justify-between">
                    <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-times-circle text-white text-xl"></i>
                    </div>
                    <div class="text-white/80 text-sm">Unit Habis</div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-3xl font-bold text-gray-900">{{ $alats->where('stok', 0)->count() }}</p>
                <p class="text-sm text-gray-500 mt-1">Alat tidak tersedia</p>
            </div>
        </div>
    </div>

      

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-list text-blue-600 text-xl mr-3"></i>
                    <h2 class="text-xl font-bold text-gray-900">Daftar Alat</h2>
                </div>
                <div class="flex items-center space-x-3">
                    <form method="GET" action="{{ route('admin.alat.index') }}" class="flex items-center">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request()->input('search') }}" 
                                   placeholder="Cari alat..." 
                                   class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        @if(request()->input('search'))
                            <a href="{{ route('admin.alat.index') }}" class="ml-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </form>
                    <a href="{{ route('admin.alat.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-colors shadow-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Alat
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
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tersedia Baik</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total Alat Rusak</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total Stok</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($alats as $alat)
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr($alat->nama_alat, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <p class="text-base font-semibold text-gray-900">{{ $alat->nama_alat }}</p>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-barcode text-blue-500 text-xs mr-2"></i>
                                        <span class="text-sm text-gray-600">{{ $alat->kode_alat }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold">
                                    {{ substr($alat->kategori->nama_kategori ?? 'K', 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $alat->kategori->nama_kategori ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                {{ $alat->kondisi_baik }} unit
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                <i class="fas fa-tools mr-1"></i>
                                {{ $alat->kondisi_rusak }} unit
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-boxes mr-1"></i>
                                {{ $alat->kondisi_baik + $alat->kondisi_rusak }} unit
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.alat.edit', $alat->id) }}" 
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-xl hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.alat.destroy', $alat->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-xl hover:bg-red-100 transition-colors">
                                        <i class="fas fa-trash mr-2"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16">
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                    <i class="fas fa-tools text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Alat</h3>
                                <p class="text-gray-500 mb-4">Mulai dengan menambahkan alat pertama untuk mengelola inventaris Anda</p>
                                <a href="{{ route('admin.alat.create') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-colors shadow-lg">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah Alat Pertama
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

@push('scripts')
<script>
function confirmDelete(button) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Alat ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3B82F6',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            button.form.submit();
        }
    });
}

function closeEditKondisi() {
    document.getElementById('modalEditKondisi').classList.add('hidden');
}

function openEditKondisi(alatId, kondisiBaik, kondisiRusak) {
    document.getElementById('alatId').value = alatId;
    document.getElementById('kondisiBaik').value = kondisiBaik;
    document.getElementById('kondisiRusak').value = kondisiRusak;
    document.getElementById('modalEditKondisi').classList.remove('hidden');
}

function saveKondisi() {
    const alatId = document.getElementById('alatId').value;
    const kondisiBaik = document.getElementById('kondisiBaik').value;
    const kondisiRusak = document.getElementById('kondisiRusak').value;
    
    fetch('{{ route("admin.alat.updateKondisi") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            alat_id: alatId,
            kondisi_baik: kondisiBaik,
            kondisi_rusak: kondisiRusak
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Gagal memperbarui kondisi');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui kondisi');
    });
}
</script>
@endpush

{{-- Modal Edit Kondisi --}}
<div id="modalEditKondisi" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Edit Kondisi Alat</h3>
                <button onclick="closeEditKondisi()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi Baik</label>
                    <input type="number" id="kondisiBaik" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi Rusak</label>
                    <input type="number" id="kondisiRusak" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <input type="hidden" id="alatId">
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button onclick="closeEditKondisi()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button onclick="saveKondisi()" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
