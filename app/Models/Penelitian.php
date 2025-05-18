<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penelitian extends Model
{
    use HasFactory;

    protected $fillable = [
        'kerjasama_id',
        'judul',
        'peneliti',
        'tahun',
    ];

    public function kerjasama()
    {
        return $this->belongsTo(Kerjasama::class);
    }
}
