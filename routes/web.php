<?php

use App\Models\Berita;
use App\Filament\Resources\BeritaResource;
use App\Filament\Resources\GaleriResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PrestasiController;



// Halaman Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

//prestasi
Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');

// Admin panel (Filament)
Route::middleware(['auth'])->group(function () {
    // Berita Admin
    Route::get('/admin/berita', [BeritaResource::class, 'index'])->name('berita.index.admin');
    Route::get('/admin/berita/create', [BeritaResource::class, 'create'])->name('berita.create.admin');
    Route::get('/admin/berita/{id}/edit', [BeritaResource::class, 'edit'])->name('berita.edit.admin');

    // Galeri Admin
    Route::get('/admin/galeri', [GaleriResource::class, 'index'])->name('galeri.index.admin');
    Route::get('/admin/galeri/create', [GaleriResource::class, 'create'])->name('galeri.create.admin');
    Route::get('/admin/galeri/{id}/edit', [GaleriResource::class, 'edit'])->name('galeri.edit.admin');
});

// Kurikulum
Route::get('/kurikulum', [KurikulumController::class, 'index'])->name('kurikulum');
Route::get('/kurikulum/semester-{semester}', [KurikulumController::class, 'show'])->name('kurikulum.show');

// Dosen
Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
Route::get('/dosen/{dosen}', [DosenController::class, 'show'])->name('dosen.show');
// Tambahkan ini di routes/web.php
Route::resource('dosen', \App\Http\Controllers\DosenController::class);
// Route khusus untuk bulk action
Route::post('/dosen/set-kaprodi', [DosenController::class, 'setKaprodi'])
    ->name('dosen.set-kaprodi');

// Fasilitas
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
Route::get('/fasilitas/{id}', [FasilitasController::class, 'show'])->name('fasilitas.show');

// 🖼️ Galeri Routes
Route::prefix('galeri')->name('galeri.')->group(function () {
    // Public Routes
    Route::get('/', [GaleriController::class, 'index'])->name('index');
    Route::get('/kategori/{kategori}', [GaleriController::class, 'byCategory'])->name('category');
    Route::get('/{id}', [GaleriController::class, 'show'])->name('show');

    // Auth Routes
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

 //kerjasama
Route::get('/kerjasama', [KerjasamaController::class, 'index'])->name('kerjasama.index');
Route::get('/kerjasama/{id}', [KerjasamaController::class, 'show'])->name('kerjasama.show');

//statis
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

