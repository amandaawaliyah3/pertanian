<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma4Prodi extends Model
{
    use HasFactory;

    protected $table = 'diploma4_prodis';

    protected $fillable = [
        'nama_prodi',
        'visi',
        'misi',
        'masa_kuliah',
    ];
}
