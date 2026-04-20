@extends('layouts.dashboard')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Manajemen Alat</h1>
        <p class="text-gray-600">Kelola stok alat dan informasi inventaris</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="fas fa-tools text-purple-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-500">Total Alat</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $totalAlat }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-500">Tersedia</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $tersedia }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-500">Kondisi</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $alats->where('kondisi_rusak', '>', 0)->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg">
                    <i class="fas fa-times-circle text-red-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-500">Habis</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $habis }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-boxes text-blue-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-500">Total Stok</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $totalStok }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Form --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <form method="GET" action="{{ route('petugas.laporan.alat') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Alat</label>
                    <input type="text" name="search" value="{{ request()->input('search') }}" 
                           placeholder="Nama atau kode alat..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategori_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Semua Kategori</option>
                        @foreach(\App\Models\Kategori::all() as $kategori)
                            <option value="{{ $kategori->id }}" {{ request()->input('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="flex-1 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    <a href="{{ route('petugas.laporan.alat') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Main Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Inventaris Alat</h2>
            <div class="flex items-center space-x-3">
                <form method="GET" action="{{ route('petugas.laporan.export.alat-pdf') }}" class="inline">
                    @if(request()->input('search'))
                        <input type="hidden" name="search" value="{{ request()->input('search') }}">
                    @endif
                    @if(request()->input('kategori_id'))
                        <input type="hidden" name="kategori_id" value="{{ request()->input('kategori_id') }}">
                    @endif
                    <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-300 rounded-lg hover:bg-red-100">
                        <i class="fas fa-file-pdf mr-2"></i>Export PDF
                    </button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($alats as $alat)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">#{{ $alat->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center text-white font-semibold text-xs">
                                    {{ substr($alat->nama_alat ?? 'A', 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $alat->nama_alat }}</p>
                                    <p class="text-xs text-gray-500">{{ $alat->kode_alat }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white font-semibold text-xs">
                                    {{ substr($alat->kategori->nama_kategori ?? 'K', 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $alat->kategori->nama_kategori ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="text-lg font-semibold text-gray-900">{{ $alat->stok }}</div>
                                <div class="ml-2 text-xs text-gray-500">unit</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <div class="mb-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Baik: {{ $alat->kondisi_baik ?? 0 }}
                                    </span>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>Rusak: {{ $alat->kondisi_rusak ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="editStok({{ $alat->id }}, {{ $alat->stok }}, {{ $alat->kondisi_baik ?? 0 }}, {{ $alat->kondisi_rusak ?? 0 }})" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-300 rounded-lg hover:bg-blue-100 transition-colors">
                                <i class="fas fa-edit mr-2"></i>Edit Stok
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-tools text-4xl text-gray-300 mb-3"></i>
                                <p class="text-sm font-medium">Tidak ada data alat</p>
                                <p class="text-xs text-gray-400 mt-1">Belum ada alat yang terdaftar</p>
                            </div>
                        </td>   
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Edit Stok --}}
    <div id="editStokModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Stok Alat</h3>
                </div>
                <form id="editStokForm" method="POST" action="{{ route('petugas.alat.updateStok') }}">
                    @csrf
                    <input type="hidden" id="alatId" name="alat_id">
                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stok Saat Ini</label>
                            <input type="text" id="currentStok" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stok Baru</label>
                            <input type="number" id="newStok" name="stok" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0" required>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button type="button" onclick="closeEditStokModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function editStok(alatId, currentStok, kondisiBaik, kondisiRusak) {
        document.getElementById('alatId').value = alatId;
        document.getElementById('currentStok').value = currentStok;
        document.getElementById('newStok').value = currentStok;
        document.getElementById('kondisiBaik').value = kondisiBaik || 0;
        document.getElementById('kondisiRusak').value = kondisiRusak || 0;
        document.getElementById('editStokModal').classList.remove('hidden');
    }

    function closeEditStokModal() {
        document.getElementById('editStokModal').classList.add('hidden');
    }

    // Handle form submission
    document.getElementById('editStokForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const alatId = formData.get('alat_id');
        const newStok = formData.get('stok');
        
        fetch('{{ route('petugas.alat.updateStok') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                alat_id: alatId,
                stok: newStok
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeEditStokModal();
                location.reload();
            } else {
                alert('Gagal mengupdate stok: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupdate stok');
        });
    });
    </script>
@endsection
