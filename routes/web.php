<?php

use App\Http\Controllers\AnggotaKeluargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\KeluargaKKGuestController;
use App\Http\Controllers\KeluargaKKController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('guest.dashboard');
});
Route::get('/ketua', function () {
    return view('ketua');
});
Route::get('/anggota', function () {
    return view('anggota');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Resource routes
Route::resource('anggota-keluarga', AnggotaKeluargaController::class)->names('anggota')->parameters(['anggota-keluarga' => 'anggota']);
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('warga', WargaController::class);
    Route::resource('keluarga_kk', KeluargaKKController::class);
    Route::resource('peristiwa_kelahiran', \App\Http\Controllers\PeristiwaKelahiranController::class);
    Route::resource('peristiwa_kematian', \App\Http\Controllers\PeristiwaKematianController::class);
    Route::resource('peristiwa_pindah', \App\Http\Controllers\PeristiwaPindahController::class);
    Route::resource('media', \App\Http\Controllers\MediaController::class);
});


// Auth routes
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [\App\Http\Controllers\AuthController::class, 'profile'])->middleware('auth')->name('profile');
// Registration disabled in production deployment

// Guest routes
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Guest\DashboardController::class, 'index'])->name('dashboard');
    // Optional old alias: keep redirect for compatibility
    Route::resource('keluarga-kk', \App\Http\Controllers\Guest\KeluargaKKGuestController::class)->except(['destroy']);
    Route::resource('warga', \App\Http\Controllers\Guest\WargaGuestController::class)->except(['destroy']);
    Route::resource('anggota-keluarga', \App\Http\Controllers\Guest\AnggotaKeluargaGuestController::class)->except(['destroy']);
    Route::resource('kelahiran', \App\Http\Controllers\Guest\PeristiwaKelahiranGuestController::class)->except(['destroy']);
    Route::resource('kematian', \App\Http\Controllers\Guest\PeristiwaKematianGuestController::class)->except(['destroy']);
    Route::resource('pindah', \App\Http\Controllers\Guest\PeristiwaPindahGuestController::class)->except(['destroy']);
    Route::resource('users', \App\Http\Controllers\Guest\UserGuestController::class);
    Route::post('users/{user}/media', [\App\Http\Controllers\Guest\UserGuestController::class, 'storeMedia'])->name('users.media.store');
    Route::resource('media', \App\Http\Controllers\Guest\MediaGuestController::class);
});
// Convenience redirects
Route::redirect('/guest', '/guest/dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/admin/dashboard', function () {
    //     return redirect('/argon-dashboard/index.html');
    // })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // Route::get('/user/dashboard', function () {
    //     return redirect('/argon-dashboard/index.html');
    // })->name('user.dashboard');
});
