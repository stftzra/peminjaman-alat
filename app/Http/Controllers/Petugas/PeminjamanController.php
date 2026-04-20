<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{

    public function index(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfDay();

        $query = Peminjaman::with(['user', 'alat'])
            ->whereBetween('created_at', [$startDate, $endDate]);

        $peminjamans = $query->latest()->get();

        return view('petugas.peminjaman.index', compact('peminjamans', 'startDate', 'endDate'));
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $alat = $peminjaman->alat;

        // Cek apakah stok (kondisi baik) mencukupi
        if ($peminjaman->jumlah > $alat->kondisi_baik) {
            return back()->with('error', 'Stok alat baik tidak mencukupi. Tersedia: ' . $alat->kondisi_baik . ' unit baik');
        }

        // Kurangi stok dan kondisi baik
        $alat->decrement('stok', $peminjaman->jumlah);
        $alat->decrement('kondisi_baik', $peminjaman->jumlah);

        $peminjaman->update([
            'status' => 'disetujui'
        ]);

        logAktivitas('Menyetujui peminjaman alat');

        return back()->with('success', 'Peminjaman disetujui. Silakan peminjam mengambil alat.');
    }

    public function serahkan($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        $peminjaman->update([
            'status' => 'dipinjam'
        ]);

        logAktivitas('Menyerahkan alat ke peminjam');


        return back()->with('success', 'Alat berhasil diserahkan ke peminjam');
    }

    public function reject($id)
    {
        Peminjaman::findOrFail($id)->update([
            'status' => 'ditolak'
        ]);

        logAktivitas('Menolak peminjaman alat');

        return back()->with('success', 'Peminjaman ditolak');
    }
}
