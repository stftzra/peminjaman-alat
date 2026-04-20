<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman.alat'])
            ->whereHas('peminjaman', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('peminjam.pengembalian.index', compact('pengembalians'));
    }

    public function struk(Pengembalian $pengembalian)
    {
        // Pastikan hanya bisa lihat struk pengembalian sendiri
        if ($pengembalian->peminjaman->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke struk ini');
        }

        return view('peminjam.pengembalian.struk', compact('pengembalian'));
    }
}
