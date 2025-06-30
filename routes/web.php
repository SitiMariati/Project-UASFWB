<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SetupController;

Route::get('/', function () {
    return view('welcome');
});

// Setup route untuk membuat user admin (hapus setelah digunakan)
Route::get('/setup', [SetupController::class, 'createAdmin'])->name('setup');

// ========= DASHBOARD BERDASARKAN ROLE ==========

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [AdminController::class, 'home'])->name('home');
    
    // CRUD Film
    Route::get('/film', [AdminController::class, 'filmIndex'])->name('film.index');
    Route::get('/film/create', [AdminController::class, 'filmCreate'])->name('film.create');
    Route::post('/film', [AdminController::class, 'filmStore'])->name('film.store');
    Route::get('/film/{id}/edit', [AdminController::class, 'filmEdit'])->name('film.edit');
    Route::put('/film/{id}', [AdminController::class, 'filmUpdate'])->name('film.update');
    Route::delete('/film/{id}', [AdminController::class, 'filmDestroy'])->name('film.destroy');
    
    // CRUD Jadwal
    Route::get('/jadwal', [AdminController::class, 'jadwalIndex'])->name('jadwal.index');
    Route::get('/jadwal/create', [AdminController::class, 'jadwalCreate'])->name('jadwal.create');
    Route::post('/jadwal', [AdminController::class, 'jadwalStore'])->name('jadwal.store');
    Route::get('/jadwal/{id}/edit', [AdminController::class, 'jadwalEdit'])->name('jadwal.edit');
    Route::put('/jadwal/{id}', [AdminController::class, 'jadwalUpdate'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [AdminController::class, 'jadwalDestroy'])->name('jadwal.destroy');
    
    // Laporan
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
    
    // Manajemen Petugas
    Route::get('/petugas', [AdminController::class, 'petugasIndex'])->name('petugas.index');
    Route::get('/petugas/create', [AdminController::class, 'petugasCreate'])->name('petugas.create');
    Route::post('/petugas', [AdminController::class, 'petugasStore'])->name('petugas.store');
    Route::get('/petugas/{id}/edit', [AdminController::class, 'petugasEdit'])->name('petugas.edit');
    Route::put('/petugas/{id}', [AdminController::class, 'petugasUpdate'])->name('petugas.update');
    Route::delete('/petugas/{id}', [AdminController::class, 'petugasDestroy'])->name('petugas.destroy');
    
    // Manajemen Pengguna
    Route::get('/pengguna', [AdminController::class, 'penggunaIndex'])->name('pengguna.index');
    Route::delete('/pengguna/{id}', [AdminController::class, 'penggunaDestroy'])->name('pengguna.destroy');

    // Transaksi Pemesanan
    Route::get('/transaksi', [AdminController::class, 'transaksiIndex'])->name('transaksi.index');

    // Role Management
    Route::get('/role', [AdminController::class, 'roleIndex'])->name('role.index');
    Route::put('/role/{id}', [AdminController::class, 'roleUpdate'])->name('role.update');
});

// Dashboard Petugas
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [PetugasController::class, 'home'])->name('home');
    
    // Kelola Pemesanan
    Route::get('/pemesanan', [PetugasController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/{id}', [PetugasController::class, 'show'])->name('pemesanan.show');
    Route::post('/pemesanan/{id}/konfirmasi', [PetugasController::class, 'konfirmasi'])->name('konfirmasi');
    Route::post('/pemesanan/{id}/batal', [PetugasController::class, 'batal'])->name('batal');
    
    // Kelola Tiket
    Route::get('/tiket', [PetugasController::class, 'tiketIndex'])->name('tiket.index');
    Route::get('/tiket/scan', [PetugasController::class, 'scanTiket'])->name('tiket.scan');
    Route::put('/tiket/{id}/status', [PetugasController::class, 'updateTiketStatus'])->name('tiket.updateStatus');
    
    // Cek Jadwal
    Route::get('/jadwal', [PetugasController::class, 'jadwalIndex'])->name('jadwal');
});

// Dashboard Pengguna
Route::middleware(['auth', 'role:pengguna'])->prefix('pengguna')->name('pengguna.')->group(function () {
    Route::get('/dashboard', [FilmController::class, 'dashboard'])->name('dashboard');
    
    // Lihat Film
    Route::get('/film', [FilmController::class, 'index'])->name('film.index');
    Route::get('/film/{film}', [FilmController::class, 'show'])->name('film.show');
    
    // Pemesanan Tiket
    Route::get('/jadwal', [PemesananController::class, 'jadwalIndex'])->name('jadwal');
    Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/pesanan', [PemesananController::class, 'myOrders'])->name('pesanan');
    Route::get('/pesanan', [PemesananController::class, 'myOrders'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PemesananController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan/{id}/cancel', [PemesananController::class, 'cancel'])->name('pesanan.cancel');
    
    // Pembayaran
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'form'])->name('pembayaran.form');
    Route::post('/pembayaran/{id}', [PembayaranController::class, 'proses'])->name('pembayaran.proses');
});

// Dashboard umum (redirect berdasarkan role)
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'petugas':
            return redirect()->route('petugas.dashboard');
        case 'pengguna':
            return redirect()->route('pengguna.dashboard');
        default:
            return redirect('/');
    }
})->middleware(['auth'])->name('dashboard');

// Routes untuk film (umum)
Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/films', [FilmController::class, 'store'])->name('films.store');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');
Route::get('/films/{film}/edit', [FilmController::class, 'edit'])->name('films.edit');
Route::put('/films/{film}', [FilmController::class, 'update'])->name('films.update');
Route::delete('/films/{film}', [FilmController::class, 'destroy'])->name('films.destroy');

require __DIR__.'/auth.php'; 