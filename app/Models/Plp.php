<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plp extends Model
{
    use HasFactory;

    protected $table = 'plps';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'bidang_keahlian',
        'foto',
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}
