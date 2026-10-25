<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('lapor.create');
});

Route::get('/lapor', [LaporanController::class, 'create'])
    ->name('lapor.create');

Route::post('/lapor', [LaporanController::class, 'store'])
    ->name('lapor.store');


// Halaman konfirmasi laporan
Route::get('/laporan/{laporan}/konfirmasi', [
    LaporanController::class,
    'konfirmasi'
])->name('laporan.konfirmasi');

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

