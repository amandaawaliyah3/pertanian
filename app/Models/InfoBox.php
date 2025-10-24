<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoBox extends Model
{
    protected $table = 'info_boxes';

    protected $fillable = [
        'icon',
        'judul',
        'deskripsi',
    ];
}
