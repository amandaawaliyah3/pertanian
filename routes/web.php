<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BerandaController,
    BeritaController,
    CommentController,
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
    InfoBoxController,
    AdministrasiPertanianController
};

/*

*/

// 🏠 Halaman Beranda
Route::get('/', [BerandaController::class, 'beranda'])->name('beranda');

// 📰 Berita
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{id}', [BeritaController::class, 'show'])->name('show');
});

// 🏅 Prestasi
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');

// 👨‍🏫 Dosen
// Folder view: resources/views/dosens/
Route::resource('dosen', DosenController::class)->names([
    'index'   => 'dosen.index',
    'create'  => 'dosen.create',
    'store'   => 'dosen.store',
    'show'    => 'dosen.show',
    'edit'    => 'dosen.edit',
    'update'  => 'dosen.update',
    'destroy' => 'dosen.destroy',
]);

// Route khusus untuk menjadikan dosen sebagai Kaprodi
Route::get('/dosen/set-kaprodi/{id}', [DosenController::class, 'setKaprodi'])->name('dosen.setKaprodi');

// 🏢 Fasilitas
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');

// 🖼️ Galeri
Route::prefix('galeri')->name('galeri.')->group(function () {
    // Public
    Route::get('/', [GaleriController::class, 'index'])->name('index');
    Route::get('/kategori/{kategori}', [GaleriController::class, 'byCategory'])->name('category');
    Route::get('/{id}', [GaleriController::class, 'show'])->name('show');

    // Admin (harus login)
    Route::middleware(['auth'])->group(function () {
        Route::get('/create', [GaleriController::class, 'create'])->name('create');
        Route::post('/', [GaleriController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [GaleriController::class, 'edit'])->name('edit');
        Route::put('/{id}', [GaleriController::class, 'update'])->name('update');
        Route::delete('/{id}', [GaleriController::class, 'destroy'])->name('destroy');
    });
});

// 🌐 API Galeri (opsional)
Route::prefix('api')->group(function () {
    Route::get('/galeri', [GaleriController::class, 'apiIndex']);
    Route::get('/galeri/{id}', [GaleriController::class, 'apiShow']);
});

// 🤝 Kerjasama
Route::get('/kerjasama', [KerjasamaController::class, 'index'])->name('kerjasama.index');
Route::get('/kerjasama/{id}', [KerjasamaController::class, 'show'])->name('kerjasama.show');

// 🧾 Profil
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// 🎓 Diploma 3
Route::prefix('d3')->name('d3.')->group(function () {
    Route::get('/', [Diploma3ProdiController::class, 'index'])->name('index');
    Route::get('/{id}', [Diploma3ProdiController::class, 'show'])->name('show');
});

// 🎓 Diploma 4
Route::prefix('d4')->name('d4.')->group(function () {
    Route::get('/', [Diploma4ProdiController::class, 'index'])->name('index');
    Route::get('/{id}', [Diploma4ProdiController::class, 'show'])->name('show');
});

// 🚪 Jalur Masuk
Route::prefix('jalurmasuk')->name('jalurmasuk.')->group(function () {
    Route::get('/', [JalurMasukController::class, 'index'])->name('index');
    Route::get('/{id}', [JalurMasukController::class, 'show'])->name('show');
});

// 👨‍🔬 PLP
Route::prefix('plp')->name('plp.')->group(function () {
    Route::get('/', [PlpController::class, 'index'])->name('index');
    Route::get('/{id}', [PlpController::class, 'show'])->name('show');
});

// 🧩 Info Box (Admin only)
Route::middleware(['auth'])->prefix('admin/info-box')->name('infobox.')->group(function () {
    Route::get('/', [InfoBoxController::class, 'index'])->name('index');
    Route::get('/create', [InfoBoxController::class, 'create'])->name('create');
    Route::post('/', [InfoBoxController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [InfoBoxController::class, 'edit'])->name('edit');
    Route::put('/{id}', [InfoBoxController::class, 'update'])->name('update');
    Route::delete('/{id}', [InfoBoxController::class, 'destroy'])->name('destroy');
});

// 🧑‍💼 Administrasi Pertanian
Route::resource('administrasi', AdministrasiPertanianController::class);

// 💬 Komentar
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
