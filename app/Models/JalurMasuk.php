<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    use HasFactory;

    protected $table = 'jalur_masuks';

    protected $fillable = [
        'nama_jalur',
        'deskripsi',
        'tanggal_buka',
        'tanggal_tutup',
        'kuota',
        'status'
    ];

    protected $casts = [
        'tanggal_buka' => 'date',
        'tanggal_tutup' => 'date',
        'status' => 'boolean'
    ];
}
