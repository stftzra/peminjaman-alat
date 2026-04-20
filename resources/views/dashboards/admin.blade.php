@php
    use App\Models\Alat;
    use App\Models\Peminjaman;
    use App\Models\User;
    use App\Models\Pengembalian;

    // Statistics - sesuai dengan tabel alat
    $totalStok = Alat::sum('kondisi_baik') + Alat::sum('kondisi_rusak');
    $tersediaBaik = Alat::sum('kondisi_baik');
    $totalUnitRusak = Alat::sum('kondisi_rusak');
    $unitHabis = Alat::where('stok', 0)->count();
    $totalUser = User::count();

    // Chart data - Last 7 days
    $chartData = [];
    $labels = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $labels[] = $date->format('d M');
        $chartData[] = Peminjaman::whereDate('created_at', $date->format('Y-m-d'))->count();
    }

    // Peminjaman by status
    $peminjamanByStatus = [
        'menunggu' => Peminjaman::where('status', 'menunggu')->count(),
        'disetujui' => Peminjaman::where('status', 'disetujui')->count(),
        'dipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
        'selesai' => Peminjaman::where('status', 'selesai')->count(),
    ];

    // Recent activities
    $peminjamanTerbaru = Peminjaman::with(['user', 'alat'])
        ->latest()
        ->limit(5)
        ->get();

    $pengembalianTerbaru = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
        ->latest()
        ->limit(5)
        ->get();
@endphp

@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Header with Welcome Section --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Dashboard Admin</h1>
                    <p class="text-indigo-100 text-lg">Selamat datang di sistem manajemen peminjaman alat</p>
                    <div class="mt-4 flex items-center space-x-4">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>{{ now()->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ now()->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-chart-line text-4xl mb-2"></i>
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
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
                <p class="text-3xl font-bold text-gray-900">{{ number_format($totalStok) }}</p>
                <p class="text-sm text-gray-500 mt-1">Unit tersedia</p>
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
                <p class="text-3xl font-bold text-gray-900">{{ number_format($tersediaBaik) }}</p>
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
                <p class="text-3xl font-bold text-gray-900">{{ number_format($totalUnitRusak) }}</p>
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
                <p class="text-3xl font-bold text-gray-900">{{ number_format($unitHabis) }}</p>
                <p class="text-sm text-gray-500 mt-1">Alat tidak tersedia</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                <div class="flex items-center justify-between">
                    <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div class="text-white/80 text-sm">User Terdaftar</div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-3xl font-bold text-gray-900">{{ number_format($totalUser) }}</p>
                <p class="text-sm text-gray-500 mt-1">Pengguna aktif</p>
            </div>
        </div>
    </div>

    {{-- Elegant Charts Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Peminjaman Chart --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Grafik Peminjaman 7 Hari Terakhir</h2>
                    <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                        <i class="fas fa-chart-line mr-2"></i>
                        <span class="text-sm">Analytics</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="h-64 flex items-end justify-between space-x-2">
                    @foreach($chartData as $index => $value)
                        <div class="flex-1 flex flex-col items-center group">
                            <div class="w-full bg-gradient-to-t from-blue-500 to-indigo-500 rounded-t-lg transition-all duration-300 group-hover:from-blue-600 group-hover:to-indigo-600" 
                                 style="height: {{ max($value, 1) * 20 }}px;">
                            </div>
                            <p class="text-xs text-gray-600 mt-2">{{ $labels[$index] }}</p>
                            <p class="text-xs font-semibold text-gray-900 bg-gray-100 px-2 py-1 rounded">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Peminjaman by Status --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Peminjaman Berdasarkan Status</h2>
                    <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                        <i class="fas fa-tasks mr-2"></i>
                        <span class="text-sm">Status</span>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                @foreach($peminjamanByStatus as $status => $count)
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center">
                            @switch($status)
                                @case('menunggu')
                                    <div class="w-4 h-4 bg-gray-500 rounded-full ring-2 ring-gray-200"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Menunggu</span>
                                    @break
                                @case('disetujui')
                                    <div class="w-4 h-4 bg-blue-500 rounded-full ring-2 ring-blue-200"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Disetujui</span>
                                    @break
                                @case('dipinjam')
                                    <div class="w-4 h-4 bg-yellow-500 rounded-full ring-2 ring-yellow-200"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Dipinjam</span>
                                    @break
                                @case('selesai')
                                    <div class="w-4 h-4 bg-green-500 rounded-full ring-2 ring-green-200"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Selesai</span>
                                    @break
                            @endswitch
                        </div>
                        <div class="flex items-center">
                            <div class="bg-gray-100 text-gray-900 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $count }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.alat.index') }}" 
               class="group border border-gray-200 rounded-xl p-4 hover:bg-gray-50 hover:border-blue-300 transition-all duration-200">
                <div class="flex items-center mb-2">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                        <i class="fas fa-tools text-blue-600"></i>
                    </div>
                    <p class="ml-3 font-semibold text-gray-900">Kelola Alat</p>
                </div>
                <p class="text-sm text-gray-500">Tambah, edit, hapus data alat</p>
            </a>

            <a href="{{ route('admin.peminjaman.index') }}" 
               class="group border border-gray-200 rounded-xl p-4 hover:bg-gray-50 hover:border-green-300 transition-all duration-200">
                <div class="flex items-center mb-2">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                        <i class="fas fa-clipboard-list text-green-600"></i>
                    </div>
                    <p class="ml-3 font-semibold text-gray-900">Data Peminjaman</p>
                </div>
                <p class="text-sm text-gray-500">Lihat peminjaman aktif</p>
            </a>

            <a href="{{ route('admin.users.index') }}" 
               class="group border border-gray-200 rounded-xl p-4 hover:bg-gray-50 hover:border-purple-300 transition-all duration-200">
                <div class="flex items-center mb-2">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                        <i class="fas fa-users text-purple-600"></i>
                    </div>
                    <p class="ml-3 font-semibold text-gray-900">Kelola User</p>
                </div>
                <p class="text-sm text-gray-500">Admin, petugas, peminjam</p>
            </a>
        </div>
    </div>

    {{-- Recent Activities --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Peminjaman --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Peminjaman Terbaru</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($peminjamanTerbaru as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-xs">
                                        {{ substr($p->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $p->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $p->user->username }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center text-white font-semibold text-xs">
                                        {{ substr($p->alat->nama_alat ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $p->alat->nama_alat }}</p>
                                        <p class="text-xs text-gray-500">{{ $p->alat->kode_alat }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('H:i') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @switch($p->status)
                                    @case('menunggu')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-clock mr-1"></i>Menunggu
                                        </span>
                                        @break
                                    @case('disetujui')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-check-circle mr-1"></i>Disetujui
                                        </span>
                                        @break
                                    @case('dipinjam')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exchange-alt mr-1"></i>Dipinjam
                                        </span>
                                        @break
                                    @case('selesai')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-double mr-1"></i>Selesai
                                        </span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-clipboard-list text-3xl text-gray-300 mb-2"></i>
                                    <p class="text-sm">Belum ada peminjaman</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Pengembalian --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Pengembalian Terbaru</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Denda</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pengembalianTerbaru as $pengembalian)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-semibold text-xs">
                                        {{ substr($pengembalian->peminjaman->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $pengembalian->peminjaman->user->username }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center text-white font-semibold text-xs">
                                        {{ substr($pengembalian->peminjaman->alat->nama_alat ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->alat->nama_alat }}</p>
                                        <p class="text-xs text-gray-500">{{ $pengembalian->peminjaman->alat->kode_alat }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('H:i') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($pengembalian->denda > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-money-bill mr-1"></i>Rp {{ number_format($pengembalian->denda) }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Tidak ada
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-undo text-3xl text-gray-300 mb-2"></i>
                                    <p class="text-sm">Belum ada pengembalian</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Tips --}}
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
        <div class="flex items-start">
            <i class="fas fa-lightbulb text-blue-600 mt-1 mr-3"></i>
            <div>
                <p class="text-sm text-blue-800 font-medium">Tips Administrasi</p>
                <p class="text-xs text-blue-700 mt-1">Pastikan data pengembalian diperbarui setiap hari untuk menjaga akurasi stok alat dan monitoring denda yang tepat waktu.</p>
            </div>
        </div>
    </div>

</div>
@endsection
