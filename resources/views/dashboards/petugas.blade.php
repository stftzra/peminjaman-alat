@php
    use App\Models\Peminjaman;
    use Carbon\Carbon;

    // Total peminjaman aktif (menunggu + disetujui + dipinjam)
    $peminjamanAktif = Peminjaman::whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])->count();

    // Pengembalian hari ini (yang rencana kembali hari ini)
    $pengembalianHariIni = Peminjaman::whereDate('tanggal_kembali_rencana', Carbon::today())
        ->whereIn('status', ['dipinjam', 'disetujui'])
        ->count();

    // Terlambat = masih dipinjam, tapi lewat tanggal rencana kembali
    $terlambat = Peminjaman::where('status', 'dipinjam')
        ->whereDate('tanggal_kembali_rencana', '<', Carbon::today())
        ->count();

    // Data yang perlu diproses petugas (menunggu + dipinjam)
    $perluDiproses = Peminjaman::with(['user', 'alat'])
        ->whereIn('status', ['menunggu', 'dipinjam'])
        ->latest('tanggal_pinjam')
        ->limit(5)
        ->get();
@endphp



<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-blue-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-hand-holding text-white text-xl"></i>
                </div>
                <div class="text-white/80 text-sm">Peminjaman Aktif</div>
            </div>
        </div>
        <div class="p-6">
            <p class="text-3xl font-bold text-blue-600">{{ $peminjamanAktif }}</p>
            <p class="text-sm text-gray-500 mt-1">Menunggu, disetujui, dipinjam</p>
        </div>
    </div>

    <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-green-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-calendar-check text-white text-xl"></i>
                </div>
                <div class="text-white/80 text-sm">Pengembalian Hari Ini</div>
            </div>
        </div>
        <div class="p-6">
            <p class="text-3xl font-bold text-green-600">{{ $pengembalianHariIni }}</p>
            <p class="text-sm text-gray-500 mt-1">Jatuh tempo hari ini</p>
        </div>
    </div>

    <div class="bg-gradient-to-br from-red-50 to-rose-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-red-100 overflow-hidden">
        <div class="bg-gradient-to-r from-red-500 to-rose-600 p-4">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                </div>
                <div class="text-white/80 text-sm">Peminjaman Terlambat</div>
            </div>
        </div>
        <div class="p-6">
            <p class="text-3xl font-bold text-red-600">{{ $terlambat }}</p>
            <p class="text-sm text-gray-500 mt-1">Lewat jatuh tempo</p>
        </div>
    </div>
</div>
<div class="mt-8 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-purple-100">
        <h2 class="text-xl font-bold text-gray-900 flex items-center">
            <i class="fas fa-bolt text-purple-600 mr-3"></i>
            Aksi Cepat
        </h2>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('petugas.peminjaman.index') }}" 
               class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4 hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 group">
                <div class="flex items-center mb-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold mr-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-hand-holding text-sm"></i>
                    </div>
                    <p class="font-semibold text-gray-900">Kelola Peminjaman</p>
                </div>
                <p class="text-sm text-gray-600">Setujui / tolak peminjaman</p>
            </a>

            <a href="{{ route('petugas.pengembalian.index') }}" 
               class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 hover:from-green-100 hover:to-emerald-100 transition-all duration-300 group">
                <div class="flex items-center mb-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white font-bold mr-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-undo text-sm"></i>
                    </div>
                    <p class="font-semibold text-gray-900">Kelola Pengembalian</p>
                </div>
                <p class="text-sm text-gray-600">Konfirmasi alat kembali</p>
            </a>

            <a href="{{ route('petugas.pengembalian.history') }}" 
               class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-4 hover:from-amber-100 hover:to-orange-100 transition-all duration-300 group">
                <div class="flex items-center mb-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center text-white font-bold mr-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-history text-sm"></i>
                    </div>
                    <p class="font-semibold text-gray-900">History Pengembalian</p>
                </div>
                <p class="text-sm text-gray-600">Lihat data pengembalian</p>
            </a>
        </div>
    </div>
</div>
<div class="mt-8 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-orange-100">
        <h2 class="text-xl font-bold text-gray-900 flex items-center">
            <i class="fas fa-exclamation-circle text-orange-600 mr-3"></i>
            Peminjaman Perlu Diproses
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Peminjam</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Pinjam</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jatuh Tempo</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($perluDiproses as $p)
                    <tr class="hover:bg-orange-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xs mr-3">
                                    {{ substr($p->user->username ?? 'U', 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $p->user->username ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center text-white font-bold text-xs mr-3">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $p->alat->nama_alat ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center text-white font-bold text-xs mr-3">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center text-white font-bold text-xs mr-3">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($p->tanggal_kembali_rencana)->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @switch($p->status)
                                @case('menunggu')
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Menunggu
                                    </div>
                                    @break
                                @case('dipinjam')
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-hand-holding mr-1"></i>
                                        Dipinjam
                                    </div>
                                    @break
                            @endswitch
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-sm font-semibold text-gray-700">Tidak ada peminjaman perlu diproses</p>
                                <p class="text-xs text-gray-400 mt-1">Semua peminjaman sudah diproses</p>
                            </div>
                        </td>   
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
    <p class="text-sm text-yellow-800">
        ⚠️ Reminder: Cek pengembalian hari ini untuk mencegah keterlambatan dan selisih stok.
    </p>
</div>
