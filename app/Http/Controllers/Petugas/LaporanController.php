<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Alat;
use App\Models\User;
use Carbon\Carbon;

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
            $query->where('nama_alat', 'like', "%{$search}%")
                  ->orWhere('kode_alat', 'like', "%{$search}%");
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

        return view('petugas.laporan.alat', compact(
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
        $status = $request->input('status', 'all');

        $query = Peminjaman::with(['user', 'alat'])
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $peminjamans = $query->latest()->get();

        // Create CSV
        $filename = "laporan_peminjaman_{$startDate->format('Y-m-d')}_{$endDate->format('Y-m-d')}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($peminjamans) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, ['ID', 'User', 'Email', 'Alat', 'Jumlah', 'Tanggal Pinjam', 'Batas Kembali', 'Status', 'Dibuat']);

            // Data
            foreach ($peminjamans as $peminjaman) {
                fputcsv($file, [
                    $peminjaman->id,
                    $peminjaman->user->name ?? '-',
                    $peminjaman->user->email ?? '-',
                    $peminjaman->alat->nama_alat ?? '-',
                    $peminjaman->jumlah,
                    $peminjaman->tanggal_pinjam,
                    $peminjaman->batas_kembali,
                    $peminjaman->status,
                    $peminjaman->created_at->format('d M Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPengembalian(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfDay();

        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        // Create CSV
        $filename = "laporan_pengembalian_{$startDate->format('Y-m-d')}_{$endDate->format('Y-m-d')}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($pengembalians) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, ['ID', 'User', 'Email', 'Alat', 'Jumlah', 'Tanggal Kembali', 'Telat (Hari)', 'Denda', 'Dibuat']);

            // Data
            foreach ($pengembalians as $pengembalian) {
                fputcsv($file, [
                    $pengembalian->id,
                    $pengembalian->peminjaman->user->name ?? '-',
                    $pengembalian->peminjaman->user->email ?? '-',
                    $pengembalian->peminjaman->alat->nama_alat ?? '-',
                    $pengembalian->peminjaman->jumlah,
                    $pengembalian->tanggal_kembali,
                    $pengembalian->telat,
                    $pengembalian->denda,
                    $pengembalian->created_at->format('d M Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
