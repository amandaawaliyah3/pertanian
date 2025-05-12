<?php

use App\Models\Berita;
use App\Filament\Resources\BeritaResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;

// Halaman Beranda (misalnya menampilkan info lain)
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// ✅ Ganti route /berita agar pakai controller yang menggunakan paginate()
Route::get('/berita', [BerandaController::class, 'index'])->name('berita.index');

// Detail berita berdasarkan ID (public-facing)
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Admin panel berita (Filament)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/berita', [BeritaResource::class, 'index'])->name('berita.index.admin');
    Route::get('/admin/berita/create', [BeritaResource::class, 'create'])->name('berita.create.admin');
    Route::get('/admin/berita/{id}/edit', [BeritaResource::class, 'edit'])->name('berita.edit.admin');
});
