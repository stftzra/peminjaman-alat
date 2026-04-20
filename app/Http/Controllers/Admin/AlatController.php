<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $query = Alat::with('kategori');
        
        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where('nama_alat', 'like', "%{$search}%")
                  ->orWhere('kode_alat', 'like', "%{$search}%");
        }
        
        $alats = $query->latest()->get();
        
        // Update stok untuk setiap alat: stok = total unit - unit rusak
        foreach ($alats as $alat) {
            $totalUnit = $alat->kondisi_baik + $alat->kondisi_rusak;
            $stokTersedia = $totalUnit - $alat->kondisi_rusak; // = kondisi_baik
            
            // Debug log
            \Log::info("Alat: {$alat->nama_alat}");
            \Log::info("Kondisi Baik: {$alat->kondisi_baik}");
            \Log::info("Kondisi Rusak: {$alat->kondisi_rusak}");
            \Log::info("Total Unit: {$totalUnit}");
            \Log::info("Stok Tersedia (baru): {$stokTersedia}");
            \Log::info("Stok Saat Ini: {$alat->stok}");
            
            if ($alat->stok != $stokTersedia) {
                $alat->update(['stok' => $stokTersedia]);
                \Log::info("Stok diupdate ke: {$stokTersedia}");
            } else {
                \Log::info("Stok sudah benar, tidak perlu update");
            }
        }
        
        return view('admin.alat.index', compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok'        => 'required|integer|min:0',
            'harga_denda' => 'required|integer|min:0',
        ]);

        Alat::create([
            'nama_alat' => $request->nama_alat,
            'kategori_id' => $request->kategori_id,
            'harga_denda' => $request->harga_denda,
            'kondisi_baik' => $request->stok, // Semua unit awal dalam kondisi baik
            'kondisi_rusak' => 0, // Tidak ada unit rusak saat baru
            'stok' => $request->stok, // Stok = kondisi baik saat baru
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok'        => 'required|integer|min:0',
            'harga_denda' => 'required|integer|min:0',
            'kondisi_baik' => 'required|integer|min:0',
            'kondisi_rusak' => 'required|integer|min:0',
        ]);

        $alat = Alat::findOrFail($id);
        
        $alat->nama_alat = $request->nama_alat;
        $alat->kategori_id = $request->kategori_id;
        $alat->harga_denda = $request->harga_denda;
        $alat->kondisi_baik = $request->kondisi_baik;
        $alat->kondisi_rusak = $request->kondisi_rusak;
        
        $alat->stok = $request->stok;
        $alat->save();

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }

    public function updateKondisi(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'kondisi_baik' => 'required|integer|min:0',
            'kondisi_rusak' => 'required|integer|min:0',
        ]);

        try {
            $alat = Alat::findOrFail($request->alat_id);
            
            // Update kondisi
            $alat->kondisi_baik = $request->kondisi_baik;
            $alat->kondisi_rusak = $request->kondisi_rusak;
            
            // Update stok total (total unit - unit rusak)
            $totalUnit = $request->kondisi_baik + $request->kondisi_rusak;
            $alat->stok = $totalUnit - $request->kondisi_rusak; // = kondisi_baik
            
            $alat->save();

            return response()->json([
                'success' => true,
                'message' => 'Kondisi alat berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui kondisi: ' . $e->getMessage()
            ], 500);
        }
    }
}
