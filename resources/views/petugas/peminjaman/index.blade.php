@extends('layouts.dashboard')

@section('content')
<div class="p-6">

    {{-- Filter Form --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-6">
        <form method="GET" action="{{ route('petugas.peminjaman.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" name="end_date" value="{{ request('end_date', now()->endOfDay()->format('Y-m-d')) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="flex-1 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    <a href="{{ route('petugas.peminjaman.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-clock text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-yellow-700">Menunggu</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $peminjamans->where('status', 'menunggu')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-check-circle text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-green-700">Disetujui</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $peminjamans->where('status', 'disetujui')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-hand-holding text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-blue-700">Dipinjam</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $peminjamans->where('status', 'dipinjam')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-cyan-50 to-teal-50 border border-cyan-200 rounded-xl p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-teal-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-flag-checkered text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-cyan-700">Selesai</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $peminjamans->where('status', 'selesai')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-violet-50 border border-purple-200 rounded-xl p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-violet-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-chart-bar text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-purple-700">Total</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $peminjamans->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- Header --}}
        <div class="px-8 py-6 bg-gradient-to-r from-purple-50 to-indigo-50 border-b border-purple-100">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Pengajuan Peminjaman</h1>
                    <p class="text-sm text-gray-600 mt-1">Kelola semua pengajuan peminjaman alat</p>
                    @if(request('start_date') || request('end_date'))
                        <p class="text-xs text-purple-600 mt-1">
                            <i class="fas fa-filter mr-1"></i>
                            Filter: {{ request('start_date', 'Awal') }} - {{ request('end_date', 'Akhir') }}
                        </p>
                    @endif
                </div>
                <div class="flex items-center space-x-3">
                    <button class="inline-flex items-center px-4 py-2 border border-purple-300 rounded-lg text-sm font-medium text-purple-700 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                    <a href="{{ route('petugas.laporan.export.peminjaman-pdf') }}?start_date={{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}&end_date={{ request('end_date', now()->endOfDay()->format('Y-m-d')) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-300 rounded-lg hover:bg-red-100 transition-colors">
                        <i class="fas fa-file-pdf mr-2"></i>
                        Export PDF
                    </a>
                </div>
            </div>
        </div>
        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full">

                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($peminjamans as $p)
                    <tr class="hover:bg-gray-50 transition-colors">

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-gradient-to-br from-green-400 to-emerald-600 rounded-full text-white font-bold text-sm shadow-md">
                                    {{ substr($p->user->username ?? 'U', 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $p->user->username ?? 'Unknown' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $p->user->email ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-gradient-to-br from-blue-400 to-indigo-600 rounded-lg text-white font-bold text-sm shadow-md">
                                    {{ substr($p->alat->nama_alat ?? 'A', 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $p->alat->nama_alat ?? 'Unknown' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Kategori: {{ $p->alat->kategori->nama_kategori ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-boxes text-purple-600 text-sm"></i>
                                </div>
                                <div>
                                    <span class="text-sm font-semibold text-gray-900">{{ $p->jumlah }} unit</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($p->tanggal_kembali_rencana)->format('d M Y') }}</p>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($p->status == 'menunggu')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 border border-yellow-200">
                                    <i class="fas fa-clock mr-1.5"></i>
                                    Menunggu
                                </span>
                            @elseif($p->status == 'disetujui')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Disetujui
                                </span>
                            @elseif($p->status == 'dipinjam')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200">
                                    <i class="fas fa-hand-holding mr-1.5"></i>
                                    Dipinjam
                                </span>
                            @elseif($p->status == 'selesai')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 border border-gray-200">
                                    <i class="fas fa-flag-checkered mr-1.5"></i>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-200">
                                    <i class="fas fa-times-circle mr-1.5"></i>
                                    Ditolak
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                @if ($p->status === 'menunggu')
                                    <form action="{{ route('petugas.peminjaman.approve', $p->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-lg text-xs font-semibold text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-md transition-all duration-200">
                                            <i class="fas fa-check mr-1"></i>
                                            Approve
                                        </button>
                                    </form>
                                @endif

                                @if ($p->status === 'disetujui')
                                    <form action="{{ route('petugas.peminjaman.serahkan', $p->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-lg text-xs font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md transition-all duration-200">
                                            <i class="fas fa-hand-holding mr-1"></i>
                                            Serahkan
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('petugas.peminjaman.reject', $p->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="button" 
                                            onclick="confirmReject(this)" 
                                            class="inline-flex items-center px-3 py-1.5 border border-red-300 rounded-lg text-xs font-semibold text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                        <i class="fas fa-times mr-1"></i>
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-sm font-semibold text-gray-700">Tidak ada pengajuan peminjaman</p>
                                <p class="text-xs text-gray-400 mt-1">Belum ada pengajuan yang masuk</p>
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
function confirmReject(button) {
    if (confirm('Apakah Anda yakin ingin menolak pengajuan ini?')) {
        button.form.submit();
    }
}
</script>
@endpush
@endsection
