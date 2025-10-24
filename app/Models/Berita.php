<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $guarded = [];

    // 👇 TAMBAHKAN INI
    protected $casts = [
        'tanggal' => 'date', // Ini memberitahu Laravel untuk mengonversi string tanggal menjadi objek Carbon
    ];
    // 👆 TAMBAHKAN INI

    protected static function booted()
    {
        // Event saat record diperbarui (Update/Edit)
        static::updating(function (Berita $berita) {
            // Cek apakah field 'gambar' telah diubah
            if ($berita->isDirty('gambar') && ($berita->getOriginal('gambar') !== null)) {
                // Hapus file gambar lama dari storage
                Storage::disk('public')->delete($berita->getOriginal('gambar'));
            }
        });

        // Event saat record dihapus (Single atau Bulk Delete)
        static::deleted(function (Berita $berita) { 
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
        });
    }
}