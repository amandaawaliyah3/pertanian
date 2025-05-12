<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas'; // Sesuai dengan nama tabel di migration

    protected $fillable = [
        'judul',
        'gambar',
        'konten',
        'tanggal',
    ];

    protected $dates = [
        'tanggal',
    ];
}
