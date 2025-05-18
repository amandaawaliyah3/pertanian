<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengabdian extends Model
{
    use HasFactory;

    protected $fillable = [
        'kerjasama_id',
        'judul',
        'pelaksana',
        'tahun',
    ];

    public function kerjasama()
    {
        return $this->belongsTo(Kerjasama::class);
    }
}
