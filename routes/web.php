<?php

use App\Http\Controllers\AnggotaKeluargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\KeluargaKKGuestController;
use App\Http\Controllers\KeluargaKKController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluargaKKController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ketua', function () {
    return view('ketua');
});
Route::get('/anggota', function () {
    return view('anggota');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Resource routes
Route::resource('anggota-keluarga', AnggotaKeluargaController::class);
Route::resource('warga', WargaController::class);
Route::resource('keluarga_kk', KeluargaKKController::class);
Route::resource('products', \App\Http\Controllers\ProductController::class);
