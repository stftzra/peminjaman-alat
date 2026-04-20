<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.alat')
            ->latest()
            ->get();

        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    public function show($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.alat')
            ->findOrFail($id);

        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    public function bayarDenda(Request $request, $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        
        // Update status pembayaran denda
        $pengembalian->status_pembayaran = 'lunas';
        $pengembalian->tanggal_pembayaran = now();
        $pengembalian->save();

        return redirect()->route('admin.pengembalian.index')
            ->with('success', 'Denda berhasil dibayarkan untuk ' . $pengembalian->peminjaman->user->username);
    }
}
