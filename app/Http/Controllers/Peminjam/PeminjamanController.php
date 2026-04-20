<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;


class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah > $alat->kondisi_baik) {
            return back()->with('error', 'Jumlah melebihi stok baik tersedia. Tersedia: ' . $alat->kondisi_baik . ' unit baik');
        }

        Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status' => 'menunggu',
        ]);

        // Kurangi stok dan kondisi baik saat peminjaman diajukan
        $alat->decrement('stok', $request->jumlah);
        $alat->decrement('kondisi_baik', $request->jumlah);

        logAktivitas('Mengajukan peminjaman alat');

        return redirect()->route('peminjam.peminjaman.index')
            ->with('success', 'Peminjaman berhasil diajukan');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Hanya bisa membatalkan peminjaman sendiri yang masih menunggu
        if ($peminjaman->user_id !== auth()->id() || $peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Tidak dapat membatalkan peminjaman ini');
        }

        // Kembalikan stok yang sudah dikurangi
        $peminjaman->alat->increment('stok', $peminjaman->jumlah);
        
        // Kembalikan kondisi baik yang sudah dikurangi
        $peminjaman->alat->increment('kondisi_baik', $peminjaman->jumlah);

        $peminjaman->delete();

        logAktivitas('Membatalkan pengajuan peminjaman');

        return redirect()->route('peminjam.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dibatalkan');
    }

    public function struk(Peminjaman $peminjaman)
    {
        // Pastikan hanya bisa lihat struk peminjaman sendiri
        if ($peminjaman->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke struk ini');
        }

        return view('peminjam.peminjaman.struk', compact('peminjaman'));
    }
}
