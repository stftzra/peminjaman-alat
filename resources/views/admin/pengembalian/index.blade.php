@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Manajemen Pengembalian</h1>
                    <p class="text-indigo-100 text-lg">Kelola semua transaksi pengembalian alat dengan mudah</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-undo mr-2"></i>
                            <span>{{ $pengembalians->count() }} total pengembalian</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span>{{ $pengembalians->where('denda', '>', 0)->count() }} terlambat</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-chart-pie text-4xl mb-2"></i>
                            <p class="text-sm">Kepatuhan</p>
                            <p class="text-2xl font-bold">{{ $pengembalians->where('denda', 0)->count() }} tepat waktu</p>
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
                            <i class="fas fa-undo text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Total Pengembalian</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $pengembalians->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Semua transaksi</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Tepat Waktu</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $pengembalians->where('denda', 0)->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Tidak ada denda</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-red-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Terlambat</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $pengembalians->where('denda', '>', 0)->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Ada denda</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-coins text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Total Denda</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($pengembalians->sum('denda'), 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total kumulatif</p>
                </div>
            </div>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-undo text-indigo-600 text-xl mr-3"></i>
                        <h2 class="text-xl font-bold text-gray-900">Daftar Pengembalian</h2>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-search mr-2"></i>
                            Cari Pengembalian
                        </button>
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pengembali</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Pinjam</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($pengembalians as $pengembalian)
                        <tr class="hover:bg-indigo-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                        {{ substr($pengembalian->peminjaman->user->username ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-base font-semibold text-gray-900">{{ $pengembalian->peminjaman->user->username ?? 'Unknown' }}</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-envelope text-blue-500 text-xs mr-2"></i>
                                            <span class="text-sm text-gray-600">{{ $pengembalian->peminjaman->user->email ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center text-white font-bold">
                                        <i class="fas fa-tools text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->alat->nama_alat ?? 'Tidak diketahui' }}</p>
                                        <p class="text-xs text-gray-500">{{ $pengembalian->peminjaman->alat->kode_alat ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold">
                                        <i class="fas fa-calendar text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('H:i') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold">
                                        <i class="fas fa-calendar-check text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_kembali)->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_kembali)->format('H:i') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-boxes mr-1"></i>
                                    {{ $pengembalian->jumlah }} unit
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($pengembalian->denda > 0)
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Terlambat
                                    </div>
                                @else
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Tepat Waktu
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.pengembalian.show', $pengembalian->id) }}" 
                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-eye mr-2"></i>
                                        Detail
                                    </a>
                                    @if($pengembalian->denda > 0)
                                        <button onclick="showBayarDendaModal({{ $pengembalian->id }})" class="inline-flex items-center px-3 py-2 text-sm font-medium text-orange-600 bg-orange-50 border border-orange-200 rounded-lg hover:bg-orange-100 transition-colors">
                                            <i class="fas fa-money-bill-wave mr-2"></i>
                                            Bayar Denda
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                        <i class="fas fa-undo text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pengembalian</h3>
                                    <p class="text-gray-500 mb-4">Belum ada transaksi pengembalian yang tercatat dalam sistem</p>
                                    <button class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-lg">
                                        <i class="fas fa-sync mr-2"></i>
                                        Refresh Data
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Bayar Denda --}}
    @foreach($pengembalians as $pengembalian)
        @if($pengembalian->denda > 0)
        <div id="bayarDendaModal{{ $pengembalian->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Bayar Denda</h3>
                            <button type="button" onclick="closeBayarDendaModal('bayarDendaModal{{ $pengembalian->id }}')" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-500">Pengembali:</span>
                                <span class="text-sm text-gray-900">{{ $pengembalian->peminjaman->user->username ?? 'Unknown' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-500">Alat:</span>
                                <span class="text-sm text-gray-900">{{ $pengembalian->peminjaman->alat->nama_alat ?? 'Unknown' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-500">Total Denda:</span>
                                <span class="text-sm font-medium text-red-600">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t pt-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="lunas">Lunas</option>
                                    <option value="cicil">Cicil</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button type="button" onclick="closeBayarDendaModal('bayarDendaModal{{ $pengembalian->id }}')" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <form action="{{ route('admin.pengembalian.bayarDenda', $pengembalian->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach

    @push('scripts')
    <script>
    function showBayarDendaModal(pengembalianId) {
        const modal = document.getElementById('bayarDendaModal' + pengembalianId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeBayarDendaModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('fixed') || event.target.classList.contains('bg-opacity-50')) {
            const modals = document.querySelectorAll('[id^="bayarDendaModal"]:not(.hidden)');
            modals.forEach(modal => {
                modal.classList.add('hidden');
            });
            document.body.style.overflow = 'auto';
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modals = document.querySelectorAll('[id^="bayarDendaModal"]:not(.hidden)');
            modals.forEach(modal => {
                modal.classList.add('hidden');
            });
            document.body.style.overflow = 'auto';
        }
    });
    </script>
    @endpush
@endsection
