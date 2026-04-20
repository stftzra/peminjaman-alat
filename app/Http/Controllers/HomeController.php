<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get statistics for homepage
        $totalAlat = Alat::count();
        $totalKategori = Kategori::count();
        $totalStok = Alat::sum('stok');
        $totalPeminjaman = Peminjaman::count();

        // Get some sample alat for display
        $featuredAlat = Alat::with('kategori')
            ->where('stok', '>', 0)
            ->take(6)
            ->get();

        // Get active peminjaman count
        $activePeminjaman = Peminjaman::whereIn('status', ['disetujui', 'dipinjam'])->count();

        return view('home', compact(
            'totalAlat',
            'totalKategori', 
            'totalStok',
            'totalPeminjaman',
            'featuredAlat',
            'activePeminjaman'
        ));
    }
}
