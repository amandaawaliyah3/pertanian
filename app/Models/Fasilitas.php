<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenis',
        'deskripsi',
        'foto',
        'lokasi',
        'kapasitas',
        'spesifikasi',
        'link_virtual_tour'
    ];

    protected $casts = ['kapasitas' => 'integer'];

    public const JENIS = [
        'laboratorium' => 'Laboratorium',
        'greenhouse' => 'Greenhouse',
        'lahan_praktikum' => 'Lahan Praktikum',
        'ruang_kelas' => 'Ruang Kelas',
        'lainnya' => 'Lainnya'
    ];

    public function getJenisLabelAttribute()
    {
        return self::JENIS[$this->jenis] ?? $this->jenis;
    }

    public function getFotoUrlAttribute()
    {
        if (!$this->foto) {
            return asset('images/default-fasilitas.jpg');
        }

        return Storage::url($this->foto);
    }
}