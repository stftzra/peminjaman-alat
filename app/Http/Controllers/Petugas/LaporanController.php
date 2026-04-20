<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class LaporanController extends Controller
{
    public function index()
    {
        return view('petugas.laporan.index');
    }

    public function peminjaman(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfDay();
        $status = $request->input('status', 'all');

        $query = Peminjaman::with(['user', 'alat'])
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $peminjamans = $query->latest()->get();

        // Statistics
        $totalPeminjaman = $peminjamans->count();
        $menunggu = $peminjamans->where('status', 'menunggu')->count();
        $disetujui = $peminjamans->where('status', 'disetujui')->count();
        $dipinjam = $peminjamans->where('status', 'dipinjam')->count();
        $selesai = $peminjamans->where('status', 'selesai')->count();

        return view('petugas.laporan.peminjaman', compact(
            'peminjamans',
            'startDate',
            'endDate',
            'status',
            'totalPeminjaman',
            'menunggu',
            'disetujui',
            'dipinjam',
            'selesai'
        ));
    }

    public function pengembalian(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfDay();

        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        // Statistics
        $totalPengembalian = $pengembalians->count();
        $tepatWaktu = $pengembalians->where('telat', 0)->count();
        $terlambat = $pengembalians->where('telat', '>', 0)->count();
        $totalDenda = $pengembalians->sum('denda');

        return view('petugas.laporan.pengembalian', compact(
            'pengembalians',
            'startDate',
            'endDate',
            'totalPengembalian',
            'tepatWaktu',
            'terlambat',
            'totalDenda'
        ));
    }

    public function alat(Request $request)
    {
        $query = Alat::with('kategori');

        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where('nama_alat', 'like', "%{$search}%");
        }

        if ($request->input('kategori_id')) {
            $query->where('kategori_id', $request->input('kategori_id'));
        }

        $alats = $query->get();

        // Sinkronisasi otomatis kondisi_baik dengan stok untuk petugas
        foreach ($alats as $alat) {
            if ($alat->kondisi_baik != $alat->stok) {
                $alat->update(['kondisi_baik' => $alat->stok]);
                // Pastikan kondisi rusak tetap
                $totalUnit = $alat->kondisi_baik + $alat->kondisi_rusak;
                if ($totalUnit < $alat->stok + $alat->kondisi_rusak) {
                    $alat->update(['kondisi_rusak' => max(0, $totalUnit - $alat->stok)]);
                }
            }
        }

        // Get peminjaman aktif per alat
        $peminjamanAktif = Peminjaman::whereIn('status', ['disetujui', 'dipinjam'])
            ->get()
            ->groupBy('alat_id')
            ->map(function($item) {
                return $item->sum('jumlah');
            });

        // Get kategoris for filter
        $kategoris = Kategori::all();

        // Statistics - sesuai dengan logika stok tersedia
        $totalStok = $alats->sum('stok'); // Total stok asli
        $tersedia = $alats->sum('stok') - $peminjamanAktif->sum(); // Stok tersedia (total - dipinjam)
        $dipinjam = $peminjamanAktif->sum(); // Total yang sedang dipinjam

        return view('petugas.alat.index', compact(
            'alats',
            'kategoris',
            'totalStok',
            'tersedia',
            'dipinjam',
            'peminjamanAktif'
        ));
    }

    public function exportAlatPdf(Request $request)
    {
        $query = Alat::with('kategori');

        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where('nama_alat', 'like', "%{$search}%");
        }

        if ($request->input('kategori_id')) {
            $query->where('kategori_id', $request->input('kategori_id'));
        }

        $alats = $query->get();

        // Statistics
        $totalAlat = $alats->count();
        $tersedia = $alats->where('stok', '>', 0)->count();
        $stokRendah = $alats->where('stok', '>', 0)->where('stok', '<=', 5)->count();
        $habis = $alats->where('stok', 0)->count();
        $totalStok = $alats->sum('stok');

        return view('petugas.laporan.export.alat-pdf', compact(
            'alats',
            'totalAlat',
            'tersedia',
            'stokRendah',
            'habis',
            'totalStok'
        ));
    }

    public function user(Request $request)
    {
        $query = User::where('role', 'peminjam');

        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
        }

        $users = $query->latest()->get();

        // Statistics
        $totalUser = $users->count();
        $activeUser = $users->where('status', 'active')->count();
        $inactiveUser = $users->where('status', 'inactive')->count();

        return view('petugas.laporan.user', compact(
            'users',
            'totalUser',
            'activeUser',
            'inactiveUser'
        ));
    }

    public function exportPeminjaman(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfDay();

        // Ambil semua data peminjaman dengan relasi pengembalian
        $peminjamans = Peminjaman::with(['user', 'alat', 'pengembalian'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        // Statistics
        $totalPeminjaman = $peminjamans->count();
        $menunggu = $peminjamans->where('status', 'menunggu')->count();
        $disetujui = $peminjamans->where('status', 'disetujui')->count();
        $dipinjam = $peminjamans->where('status', 'dipinjam')->count();
        $selesai = $peminjamans->where('status', 'selesai')->count();

        return view('petugas.laporan.export.peminjaman-pdf', compact(
            'peminjamans',
            'startDate',
            'endDate',
            'totalPeminjaman',
            'menunggu',
            'disetujui',
            'dipinjam',
            'selesai'
        ));
    }

    public function exportPeminjamanPdf(Request $request)
    {
        return $this->exportPeminjaman($request);
    }

    public function exportPengembalian(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfDay();

        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        // Statistics
        $totalPengembalian = $pengembalians->count();
        $tepatWaktu = $pengembalians->where('telat', 0)->count();
        $terlambat = $pengembalians->where('telat', '>', 0)->count();
        $totalDenda = $pengembalians->sum('denda');

        return view('petugas.laporan.export.pengembalian-pdf', compact(
            'pengembalians',
            'startDate',
            'endDate',
            'totalPengembalian',
            'tepatWaktu',
            'terlambat',
            'totalDenda'
        ));
    }

    public function exportPengembalianPdf(Request $request)
    {
        return $this->exportPengembalian($request);
    }

    // Fungsi untuk mengirim laporan pengembalian ke email peminjam
    public function kirimLaporanPengembalianKePeminjam(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Ambil semua pengembalian dalam rentang tanggal
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Kelompokkan berdasarkan user
        $pengembaliansByUser = $pengembalians->groupBy('peminjaman.user_id');

        foreach ($pengembaliansByUser as $userId => $userPengembalians) {
            $user = User::find($userId);
            
            if ($user && $user->email) {
                try {
                    // Kirim email ke peminjam
                    Mail::send([], [], function ($message) use ($user, $userPengembalians, $startDate, $endDate) {
                        $message->to($user->email)
                            ->subject('Laporan Pengembalian Alat - ' . $startDate->format('d M Y') . ' s/d ' . $endDate->format('d M Y'))
                            ->view('emails.laporan_pengembalian', [
                                'user' => $user,
                                'pengembalians' => $userPengembalians,
                                'startDate' => $startDate,
                                'endDate' => $endDate
                            ]);
                    });

                    logAktivitas('Mengirim laporan pengembalian ke email peminjam: ' . $user->email);
                } catch (\Exception $e) {
                    logAktivitas('Gagal mengirim laporan pengembalian ke email: ' . $e->getMessage());
                }
            }
        }

        return back()->with('success', 'Laporan pengembalian berhasil dikirim ke email semua peminjam');
    }

    public function updateStok(Request $request): JsonResponse
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'stok' => 'required|integer|min:0',
            'kondisi_baik' => 'required|integer|min:0',
            'kondisi_rusak' => 'required|integer|min:0'
        ]);

        try {
            $alat = Alat::findOrFail($request->alat_id);
            
            // Update kondisi
            $alat->kondisi_baik = $request->kondisi_baik;
            $alat->kondisi_rusak = $request->kondisi_rusak;
            
            // Update stok berdasarkan kondisi baik
            $alat->stok = $request->kondisi_baik;
            
            $alat->save();

            return response()->json([
                'success' => true,
                'message' => 'Stok dan kondisi alat berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui stok: ' . $e->getMessage()
            ], 500);
        }
    }
}
