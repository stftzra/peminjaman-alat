<?php
    use App\Models\Peminjaman;
    use Carbon\Carbon;

    $userId = auth()->id();

    // Total peminjaman user
    $totalPeminjaman = Peminjaman::where('user_id', $userId)->count();

    // Peminjaman aktif user
    $peminjamanAktif = Peminjaman::where('user_id', $userId)
        ->whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])
        ->count();

    // Peminjaman jatuh tempo hari ini
    $jatuhTempoHariIni = Peminjaman::where('user_id', $userId)
        ->whereDate('tanggal_kembali_rencana', Carbon::today())
        ->where('status', 'dipinjam')
        ->count();

    // Peminjaman terlambat
    $terlambat = Peminjaman::where('user_id', $userId)
        ->where('status', 'dipinjam')
        ->whereDate('tanggal_kembali_rencana', '<', Carbon::today())
        ->count();

    // Riwayat terbaru milik user
    $riwayatTerbaru = Peminjaman::with('alat')
        ->where('user_id', $userId)
        ->latest('tanggal_pinjam')
        ->limit(5)
        ->get();
?>

<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl p-8 mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-2">Dashboard Peminjam</h1>
            <p class="text-indigo-100 text-lg">Ringkasan aktivitas peminjaman Anda</p>
            <div class="mt-4 flex items-center space-x-6">
                <div class="flex items-center">
                    <i class="fas fa-box mr-2"></i>
                    <span>{{ $totalPeminjaman }} total peminjaman</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    <span>{{ $peminjamanAktif }} aktif</span>
                </div>
            </div>
        </div>
        <div class="hidden md:block">
            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                <div class="text-center">
                    <i class="fas fa-user text-4xl mb-2"></i>
                    <p class="text-sm">Selamat Datang</p>
                    <p class="text-2xl font-bold">{{ auth()->user()->username }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-box text-white text-xl"></i>
                </div>
                <div class="text-white/80 text-sm">Total Peminjaman</div>
            </div>
        </div>
        <div class="p-6">
            <p class="text-3xl font-bold text-gray-900">{{ $totalPeminjaman }}</p>
            <p class="text-sm text-gray-500 mt-1">Seluruh riwayat</p>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
                <div class="text-white/80 text-sm">Peminjaman Aktif</div>
            </div>
        </div>
        <div class="p-6">
            <p class="text-3xl font-bold text-gray-900">{{ $peminjamanAktif }}</p>
            <p class="text-sm text-gray-500 mt-1">Menunggu / dipinjam</p>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-4">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                </div>
                <div class="text-white/80 text-sm">Jatuh Tempo Hari Ini</div>
            </div>
        </div>
        <div class="p-6">
            <p class="text-3xl font-bold text-gray-900">{{ $jatuhTempoHariIni }}</p>
            <p class="text-sm text-gray-500 mt-1">Perlu segera dikembalikan</p>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-red-500 to-red-600 p-4">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-times-circle text-white text-xl"></i>
                </div>
                <div class="text-white/80 text-sm">Terlambat</div>
            </div>
        </div>
        <div class="p-6">
            <p class="text-3xl font-bold text-gray-900">{{ $terlambat }}</p>
            <p class="text-sm text-gray-500 mt-1">Lewat batas waktu</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-900">Aksi Cepat</h2>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('peminjam.alat.index') }}"
               class="group flex flex-col items-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-search text-lg"></i>
                </div>
                <p class="font-semibold text-gray-900 text-center">Cari Alat</p>
                <p class="text-sm text-gray-500 text-center mt-1">Lihat daftar alat tersedia</p>
            </a>

            <a href="{{ route('peminjam.peminjaman.index') }}"
               class="group flex flex-col items-center p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-list text-lg"></i>
                </div>
                <p class="font-semibold text-gray-900 text-center">Peminjaman Saya</p>
                <p class="text-sm text-gray-500 text-center mt-1">Lihat status peminjaman</p>
            </a>

            <a href="{{ route('peminjam.pengembalian.index') }}"
               class="group flex flex-col items-center p-6 bg-gradient-to-br from-orange-50 to-yellow-50 rounded-xl border border-orange-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-yellow-600 rounded-xl flex items-center justify-center text-white mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-undo text-lg"></i>
                </div>
                <p class="font-semibold text-gray-900 text-center">Pengembalian</p>
                <p class="text-sm text-gray-500 text-center mt-1">Konfirmasi pengembalian</p>
            </a>

            <a href="{{ route('peminjam.laporan.pengembalian') }}"
               class="group flex flex-col items-center p-6 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl border border-purple-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-chart-bar text-lg"></i>
                </div>
                <p class="font-semibold text-gray-900 text-center">Laporan Saya</p>
                <p class="text-sm text-gray-500 text-center mt-1">Lihat laporan pengembalian</p>
            </a>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-900">Aktivitas Terbaru</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Pinjam</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jatuh Tempo</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($riwayatTerbaru as $p)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr($p->alat->nama_alat ?? 'A', 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $p->alat->nama_alat ?? 'Unknown' }}</p>
                                    <p class="text-xs text-gray-500">{{ $p->alat->kategori->nama_kategori ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-calendar text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ Carbon::parse($p->tanggal_pinjam)->format('H:i') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center text-white font-bold mr-3">
                                    <i class="fas fa-calendar-check text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ Carbon::parse($p->tanggal_kembali_rencana)->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ Carbon::parse($p->tanggal_kembali_rencana)->format('H:i') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($p->status == 'menunggu')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 border border-gray-200">
                                    <i class="fas fa-clock mr-1.5"></i>
                                    Menunggu
                                </span>
                            @elseif($p->status == 'disetujui')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Disetujui
                                </span>
                            @elseif($p->status == 'dipinjam')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <i class="fas fa-hand-holding mr-1.5"></i>
                                    Dipinjam
                                </span>
                            @elseif($p->status == 'dibatalkan' || $p->status == 'ditolak' || $p->status == 'expired')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                    <i class="fas fa-times-circle mr-1.5"></i>
                                    {{ ucfirst($p->status) }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-check mr-1.5"></i>
                                    Selesai
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16">
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                    <i class="fas fa-inbox text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada riwayat peminjaman</h3>
                                <p class="text-gray-500 mb-4">Ajukan peminjaman alat untuk memulai</p>
                                <a href="{{ route('peminjam.alat.index') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-lg">
                                    <i class="fas fa-search mr-2"></i>
                                    Cari Alat
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($terlambat > 0)
<div class="mt-8 bg-red-50 border border-red-200 rounded-lg p-4">
    <p class="text-sm text-red-800">
        ⚠️ Anda memiliki peminjaman yang terlambat. Harap segera lakukan pengembalian untuk menghindari sanksi.
    </p>
</div>
@else
<div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
    <p class="text-sm text-blue-800">
        💡 Tips: Selalu periksa tanggal jatuh tempo pada menu <b>Peminjaman Saya</b> agar pengembalian dapat dilakukan tepat waktu.
    </p>
</div>
@endif

