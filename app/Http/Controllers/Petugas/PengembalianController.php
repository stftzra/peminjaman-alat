<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat', 'pengembalian'])
            ->where('status', 'dipinjam')
            ->get();

        return view('petugas.pengembalian.index', compact('peminjamans'));
    }

      public function show(Peminjaman $peminjaman)
    {
        $tanggalRencana = Carbon::parse($peminjaman->tanggal_kembali_rencana);
        $hariIni = Carbon::today();

        $hariTelat = $hariIni->greaterThan($tanggalRencana)
            ? $tanggalRencana->diffInDays($hariIni)
            : 0;

        $denda = $hariTelat * ($peminjaman->alat->harga_denda ?? 0);

        return view('petugas.pengembalian.show', compact(
            'peminjaman',
            'hariTelat',
            'denda'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_pengembalian' => 'required|date',
            'kondisi' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Debug log
        \Log::info('Kondisi yang diterima: ' . $request->kondisi);
        \Log::info('All request data: ' . json_encode($request->all()));

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        // Hitung keterlambatan dan denda
        $tanggalKembali = \Carbon\Carbon::parse($request->tanggal_pengembalian);
        $tanggalRencana = \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana);
        $telat = $tanggalKembali->diffInDays($tanggalRencana, false);
        
        $denda = 0;
        if ($telat > 0) {
            $denda = $telat * $peminjaman->alat->harga_denda;
        }

        // Simpan pengembalian
        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
            'telat' => $telat,
            'denda' => $denda,
        ]);

        // Update stok alat (hanya tambah jika kondisi baik)
        if ($request->kondisi === 'baik') {
            $peminjaman->alat->increment('stok', $peminjaman->jumlah);
        }

        // Update kondisi alat berdasarkan kondisi saat pengembalian
        \Log::info('Update kondisi alat - Kondisi: ' . $request->kondisi);
        \Log::info('Sebelum update - Kondisi Baik: ' . $peminjaman->alat->kondisi_baik . ', Kondisi Rusak: ' . $peminjaman->alat->kondisi_rusak);
        
        if ($request->kondisi === 'rusak') {
            // Kurangi kondisi baik dan tambah kondisi rusak
            $peminjaman->alat->decrement('kondisi_baik', $peminjaman->jumlah);
            $peminjaman->alat->increment('kondisi_rusak', $peminjaman->jumlah);
            \Log::info('Alat rusak - dikurangi ' . $peminjaman->jumlah . ' dari kondisi baik');
        } else {
            // Pastikan kondisi baik tidak kurang dari total stok
            $currentKondisiBaik = $peminjaman->alat->kondisi_baik ?? 0;
            $newKondisiBaik = $currentKondisiBaik + $peminjaman->jumlah;
            $peminjaman->alat->update(['kondisi_baik' => $newKondisiBaik]);
            \Log::info('Alat baik - ditambah ' . $peminjaman->jumlah . ' ke kondisi baik');
        }
        
        // Refresh untuk melihat perubahan
        $peminjaman->alat->refresh();
        \Log::info('Setelah update - Kondisi Baik: ' . $peminjaman->alat->kondisi_baik . ', Kondisi Rusak: ' . $peminjaman->alat->kondisi_rusak);

        // Update status peminjaman
        $peminjaman->update(['status' => 'selesai']);

        // Log aktivitas
        logAktivitas("Memproses pengembalian alat: {$peminjaman->alat->nama}");

        return redirect()->route('petugas.pengembalian.index')
            ->with('success', 'Pengembalian berhasil diproses');
    }

public function struk(Pengembalian $pengembalian)
{
    $pengembalian->load([
        'peminjaman.user',
        'peminjaman.alat'
    ]);

    return view('petugas.pengembalian.struk', compact('pengembalian'));
}

    public function history()
    {
        $pengembalians = \App\Models\Pengembalian::with([
            'peminjaman.user',
            'peminjaman.alat'
        ])->latest()->get();

        return view('petugas.pengembalian.history', compact('pengembalians'));
    }

    public function kirimEmail(Pengembalian $pengembalian)
{
    $pengembalian->load([
        'peminjaman.user',
        'peminjaman.alat'
    ]);

    // ambil email user
    $email = $pengembalian->peminjaman->user->email;

    // generate PDF dari view struk
    $pdf = Pdf::loadView('petugas.pengembalian.struk', compact('pengembalian'));

    // kirim email
Mail::send([], [], function ($message) use ($email, $pdf, $pengembalian) {
    $message->to($email)
        ->subject('Bukti Pengembalian #' . $pengembalian->id)
        ->html('<p>Berikut kami lampirkan bukti pengembalian alat.</p>')
        ->attachData($pdf->output(), 'struk-pengembalian.pdf');
});

    return back()->with('success', 'Struk berhasil dikirim ke email!');
}
}
