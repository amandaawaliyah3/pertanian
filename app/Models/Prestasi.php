<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis'; // <- tambahkan baris ini kalau nama tabel bukan "prestasis"

    protected $fillable = ['judul', 'deskripsi', 'gambar', 'tanggal'];
}
