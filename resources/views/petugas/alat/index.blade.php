@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Manajemen Alat</h1>
                    <p class="text-blue-100 text-lg">Kelola stok alat dan informasi inventaris dengan mudah</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-tools mr-2"></i>
                            <span>{{ $alats->count() }} total alat</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-layer-group mr-2"></i>
                            <span>{{ $kategoris->count() }} kategori</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-chart-line text-4xl mb-2"></i>
                            <p class="text-sm">Tingkat Ketersediaan</p>
                            <p class="text-2xl font-bold">{{ $tersedia > 0 ? round(($tersedia / $totalStok) * 100) : 0 }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8">
        {{-- Elegant Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-blue-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-tools text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Total Stok</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-blue-600">{{ $totalStok }}</p>
                    <p class="text-sm text-gray-500 mt-1">Jumlah total semua alat</p>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-yellow-50 to-amber-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-yellow-100 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-500 to-amber-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-hand-holding text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Sedang Dipinjam</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-yellow-600">{{ $dipinjam }}</p>
                    <p class="text-sm text-gray-500 mt-1">Alat yang dipinjam</p>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-green-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Tersedia</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-green-600">{{ $tersedia }}</p>
                    <p class="text-sm text-gray-500 mt-1">Alat tersedia</p>
                </div>
            </div>
        </div>

    {{-- Filter Form --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-purple-100">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-filter text-purple-600 mr-3"></i>
                    Filter Pencarian
                </h2>
            </div>
            <div class="p-6">
                <form method="GET" action="{{ route('petugas.alat.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Alat</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="{{ request()->input('search') }}" 
                                       placeholder="Nama atau kode alat..."
                                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-layer-group text-gray-400"></i>
                                </div>
                                <select name="kategori_id" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 appearance-none transition-colors">
                                    <option value="">Semua Kategori</option>
                                    @foreach(\App\Models\Kategori::all() as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request()->input('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 py-2 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fas fa-filter mr-2"></i>Filter
                            </button>
                            <a href="{{ route('petugas.alat.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Main Table --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-list text-gray-600 mr-3"></i>
                    Inventaris Alat
                </h2>
                <div class="flex items-center space-x-3">
                    <form method="GET" action="{{ route('petugas.laporan.export.alat-pdf') }}" class="inline">
                        @if(request()->input('search'))
                            <input type="hidden" name="search" value="{{ request()->input('search') }}">
                        @endif
                        @if(request()->input('kategori_id'))
                            <input type="hidden" name="kategori_id" value="{{ request()->input('kategori_id') }}">
                        @endif
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                            <i class="fas fa-file-pdf mr-2"></i>Export PDF
                        </button>
                    </form>
                </div>
            </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kondisi</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($alats as $alat)
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-gray-500 to-slate-600 rounded-lg flex items-center justify-center text-white font-bold text-xs mr-3">
                                    {{ $alat->id }}
                                </div>
                                <span class="text-sm font-medium text-gray-900">#{{ $alat->id }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-tools text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $alat->nama_alat }}</p>
                                    <p class="text-xs text-gray-500">{{ $alat->kode_alat }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-layer-group text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $alat->kategori->nama_kategori ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-boxes text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-gray-900">{{ $alat->stok - ($peminjamanAktif[$alat->id] ?? 0) }}</p>
                                    <p class="text-xs text-gray-500">unit tersedia</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <div class="mb-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Baik: {{ $alat->kondisi_baik ?? 0 }}
                                    </span>
                                </div>
                                <div class="mb-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Rusak: {{ $alat->kondisi_rusak ?? 0 }}
                                    </span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    Total: {{ $alat->stok }} unit
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="editStok({{ $alat->id }}, {{ $alat->stok }}, {{ $alat->kondisi_baik ?? 0 }}, {{ $alat->kondisi_rusak ?? 0 }})" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-edit mr-2"></i>Update Stok
                                </button>
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
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data Alat</h3>
                                <p class="text-gray-500">Belum ada data alat yang tercatat dalam sistem</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi Baik</label>
                            <input type="number" id="kondisiBaik" name="kondisi_baik" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0" placeholder="Jumlah alat dalam kondisi baik">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi Rusak</label>
                            <input type="number" id="kondisiRusak" name="kondisi_rusak" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0" placeholder="Jumlah alat dalam kondisi rusak">
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
        const kondisiBaik = formData.get('kondisi_baik');
        const kondisiRusak = formData.get('kondisi_rusak');
        
        fetch('{{ route('petugas.alat.updateStok') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                alat_id: alatId,
                stok: newStok,
                kondisi_baik: kondisiBaik,
                kondisi_rusak: kondisiRusak
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
