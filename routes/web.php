<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;

// 1. Halaman Login & Autentikasi
Route::get('/', function () {
    return view('login');
});
Route::post('/login', [AdminController::class, 'authenticate'])->name('login.process');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

// 2. Rute Sisi Admin (Pengelola Kantin)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/menu/store', [AdminController::class, 'storeMenu'])->name('admin.menu.store');
Route::post('/admin/pesanan/status/{id}', [AdminController::class, 'updateStatusPesanan'])->name('admin.pesanan.status');

// 3. Rute Sisi Siswa (Pembeli)
Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
Route::post('/siswa/pesan', [SiswaController::class, 'storePesanan'])->name('siswa.pesan');