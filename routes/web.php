<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\PengembalianController as AdminPengembalianController;

use App\Http\Controllers\Peminjam\AlatController as PeminjamAlatController;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;
use App\Http\Controllers\Peminjam\PengembalianController as PeminjamPengembalianController;

use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\LaporanController as PetugasLaporanController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('admin.users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('admin.users.store');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('/users/{id}', [UserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    Route::get('/alat', [AlatController::class, 'index'])->name('admin.alat.index');
    Route::get('/alat/create', [AlatController::class, 'create'])->name('admin.alat.create');
    Route::post('/alat', [AlatController::class, 'store'])->name('admin.alat.store');
    Route::get('/alat/{id}/edit', [AlatController::class, 'edit'])->name('admin.alat.edit');
    Route::put('/alat/{id}', [AlatController::class, 'update'])->name('admin.alat.update');
    Route::delete('/alat/{id}', [AlatController::class, 'destroy'])->name('admin.alat.destroy');

    Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])
        ->name('admin.peminjaman.index');

    Route::get('/pengembalian', [AdminPengembalianController::class, 'index'])
        ->name('admin.pengembalian.index');

    Route::get('/pengembalian/{id}', [AdminPengembalianController::class, 'show'])
        ->name('admin.pengembalian.show');

    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('admin.log.index');
});

Route::prefix('petugas')
    ->middleware(['auth'])
    ->group(function () {

        // list pengajuan
        Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])
            ->name('petugas.peminjaman.index');

        // approve / reject
        Route::post('/peminjaman/{id}/approve', [PetugasPeminjamanController::class, 'approve'])
            ->name('petugas.peminjaman.approve');

        Route::post('/peminjaman/{id}/serahkan', [PetugasPeminjamanController::class, 'serahkan'])
            ->name('petugas.peminjaman.serahkan');

        Route::post('/peminjaman/{id}/reject', [PetugasPeminjamanController::class, 'reject'])
            ->name('petugas.peminjaman.reject');

     // pengembalian
        Route::get('/pengembalian', [PetugasPengembalianController::class, 'index'])
            ->name('petugas.pengembalian.index');

        Route::get('/pengembalian/history', [PetugasPengembalianController::class, 'history'])
            ->name('petugas.pengembalian.history');

        Route::get('/pengembalian/{peminjaman}', [PetugasPengembalianController::class, 'show'])
            ->name('petugas.pengembalian.show');

        Route::post('/pengembalian/selesai', [PetugasPengembalianController::class, 'store'])
            ->name('petugas.pengembalian.store');

     // laporan
        Route::get('/laporan', [PetugasLaporanController::class, 'index'])
            ->name('petugas.laporan.index');

        Route::get('/laporan/peminjaman', [PetugasLaporanController::class, 'peminjaman'])
            ->name('petugas.laporan.peminjaman');

        Route::get('/laporan/pengembalian', [PetugasLaporanController::class, 'pengembalian'])
            ->name('petugas.laporan.pengembalian');

        Route::get('/laporan/alat', [PetugasLaporanController::class, 'alat'])
            ->name('petugas.laporan.alat');

        Route::get('/laporan/user', [PetugasLaporanController::class, 'user'])
            ->name('petugas.laporan.user');

        Route::post('/laporan/export/peminjaman', [PetugasLaporanController::class, 'exportPeminjaman'])
            ->name('petugas.laporan.export.peminjaman');

        Route::post('/laporan/export/pengembalian', [PetugasLaporanController::class, 'exportPengembalian'])
            ->name('petugas.laporan.export.pengembalian');


        // Test route
        Route::get('/test', function() {
            return view('petugas.pengembalian.test');
        })->name('petugas.test');
    });


Route::prefix('peminjam')
    ->middleware(['auth'])
    ->group(function () {

        // lihat alat
        Route::get('/alat', [PeminjamAlatController::class, 'index'])
            ->name('peminjam.alat.index');

        Route::get('/alat/{id}', [PeminjamAlatController::class, 'show'])
            ->name('peminjam.alat.show');

        // ajukan peminjaman
        Route::get('/peminjaman', [PeminjamPeminjamanController::class, 'index'])
            ->name('peminjam.peminjaman.index');

        Route::post('/peminjaman', [PeminjamPeminjamanController::class, 'store'])
            ->name('peminjam.peminjaman.store');

        Route::delete('/peminjaman/{id}', [PeminjamPeminjamanController::class, 'destroy'])
            ->name('peminjam.peminjaman.destroy');

        Route::get(
            '/pengembalian',
            [PeminjamPengembalianController::class, 'index']
        )->name('peminjam.pengembalian.index');
    });

require __DIR__ . '/auth.php';
