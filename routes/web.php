<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BerandaController,
    BeritaController,
    DosenController,
    FasilitasController,
    GaleriController,
    KerjasamaController,
    ProfilController,
    PrestasiController,
    Diploma3ProdiController,
    Diploma4ProdiController,
    JalurMasukController,
    PlpController,
};

// Halaman Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Prestasi
Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');

// Dosen
Route::resource('dosen', DosenController::class)->only(['index', 'show']);
Route::post('/dosen/set-kaprodi', [DosenController::class, 'setKaprodi'])->name('dosen.set-kaprodi');

// Fasilitas
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');

// Galeri
Route::prefix('galeri')->name('galeri.')->group(function () {
    // Public
    Route::get('/', [GaleriController::class, 'index'])->name('index');
    Route::get('/kategori/{kategori}', [GaleriController::class, 'byCategory'])->name('category');
    Route::get('/{id}', [GaleriController::class, 'show'])->name('show');

    // Hanya untuk yang login
    Route::middleware(['auth'])->group(function () {
        Route::get('/create', [GaleriController::class, 'create'])->name('create');
        Route::post('/', [GaleriController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [GaleriController::class, 'edit'])->name('edit');
        Route::put('/{id}', [GaleriController::class, 'update'])->name('update');
        Route::delete('/{id}', [GaleriController::class, 'destroy'])->name('destroy');
    });
});

// API Galeri (jika diperlukan)
Route::prefix('api')->group(function () {
    Route::get('/galeri', [GaleriController::class, 'apiIndex']);
    Route::get('/galeri/{id}', [GaleriController::class, 'apiShow']);
});

// Kerjasama
Route::get('/kerjasama', [KerjasamaController::class, 'index'])->name('kerjasama.index');
Route::get('/kerjasama/{id}', [KerjasamaController::class, 'show'])->name('kerjasama.show');

// Profil
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Diploma 3
Route::prefix('d3')->name('d3.')->group(function () {
    Route::get('/', [Diploma3ProdiController::class, 'index'])->name('index');
    Route::get('/{id}', [Diploma3ProdiController::class, 'show'])->name('show');
});

// Diploma 4
Route::prefix('d4')->name('d4.')->group(function () {
    Route::get('/', [Diploma4ProdiController::class, 'index'])->name('index');
    Route::get('/{id}', [Diploma4ProdiController::class, 'show'])->name('show');
});

// Jalur Masuk
Route::get('/jalurmasuk', [JalurMasukController::class, 'index'])->name('jalurmasuk.index');
Route::get('/jalurmasuk/{id}', [JalurMasukController::class, 'show'])->name('jalurmasuk.show');

// PLP
Route::prefix('plp')->name('plp.')->group(function () {
    Route::get('/', [PlpController::class, 'index'])->name('index');
    Route::get('/{id}', [PlpController::class, 'show'])->name('show');
});
