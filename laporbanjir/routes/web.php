<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('lapor.create');
});

// Form laporan banjir
Route::get('/lapor', [LaporanController::class, 'create'])
    ->name('lapor.create');

// Simpan laporan banjir
Route::post('/lapor', [LaporanController::class, 'store'])
    ->name('lapor.store');

// Halaman konfirmasi laporan
Route::get('/laporan/{laporan}/konfirmasi', [
    LaporanController::class,
    'konfirmasi'
])->name('laporan.konfirmasi');

// Login dan registrasi
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('/login', [LoginController::class, 'show'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])
        ->name('login.authenticate');
});

// Halaman khusus pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::delete('/laporan/{laporan}', [LaporanController::class, 'destroy'])
        ->name('laporan.destroy');

    Route::get('/profil', [ProfilController::class, 'show'])
        ->name('profil');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});