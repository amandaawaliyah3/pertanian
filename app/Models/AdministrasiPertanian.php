<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrasiPertanian extends Model
{
    use HasFactory;

      protected $table = 'administrasi_pertanian';
      
    protected $fillable = [
        'nama',
        'nip',
        'bidang',
        'foto'
    ];
}
