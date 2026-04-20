<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function pengembalian(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfDay();

        // Ambil pengembalian untuk user yang sedang login
        $pengembalians = Pengembalian::with(['peminjaman.alat'])
            ->whereHas('peminjaman', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        // Statistics
        $totalPengembalian = $pengembalians->count();
        $tepatWaktu = $pengembalians->where('telat', 0)->count();
        $terlambat = $pengembalians->where('telat', '>', 0)->count();
        $totalDenda = $pengembalians->sum('denda');

        return view('peminjam.laporan.pengembalian', compact(
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
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfDay();

        // Ambil pengembalian untuk user yang sedang login
        $pengembalians = Pengembalian::with(['peminjaman.alat'])
            ->whereHas('peminjaman', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        // Statistics
        $totalPengembalian = $pengembalians->count();
        $tepatWaktu = $pengembalians->where('telat', 0)->count();
        $terlambat = $pengembalians->where('telat', '>', 0)->count();
        $totalDenda = $pengembalians->sum('denda');

        return view('peminjam.laporan.export.pengembalian-pdf', compact(
            'pengembalians',
            'startDate',
            'endDate',
            'totalPengembalian',
            'tepatWaktu',
            'terlambat',
            'totalDenda'
        ));
    }
}
