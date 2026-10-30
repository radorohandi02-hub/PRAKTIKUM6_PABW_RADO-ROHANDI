<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporController;
use Illuminate\Support\Facades\Route;

// ---------- Publik (warga) ----------
Route::redirect('/', '/lapor');
Route::get('/lapor', [LaporController::class, 'create'])->name('lapor.create');
Route::post('/lapor', [LaporController::class, 'store'])->name('lapor.store');

// ---------- Petugas (wajib login) ----------
Route::middleware('auth')->group(function () {
    Route::resource('laporan', LaporanController::class)
        ->except(['create', 'store']);   // create/store ada di form warga (/lapor)
});

require __DIR__.'/auth.php';
