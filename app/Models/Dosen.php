<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dosen extends Model
{
    protected $fillable = [
        'nidn', 'nama', 'email', 'no_hp', 'bidang_keahlian',
        'riwayat_pendidikan', 'pengalaman_kerja', 
        'penelitian', 'publikasi', 'foto', 'is_kaprodi'
    ];

    protected $casts = [
        'is_kaprodi' => 'boolean',
        // Jika bidang_keahlian disimpan dalam bentuk JSON, aktifkan baris ini:
        // 'bidang_keahlian' => 'array',
    ];

    /**
     * Accessor untuk mendapatkan URL foto dosen.
     */
    public function getFotoUrlAttribute()
    {
        if (empty($this->foto)) {
            return asset('images/default-avatar.jpg');
        }

        return Storage::disk('public')->exists('dosen/' . $this->foto)
            ? asset('storage/dosen/' . $this->foto)
            : asset('images/default-avatar.jpg');
    }

    /**
     * Mengembalikan bidang keahlian dalam bentuk array.
     */
    public function getBidangKeahlianArrayAttribute()
    {
        return $this->formatTextToArray($this->bidang_keahlian);
    }

    /**
     * Mengembalikan riwayat pendidikan dalam bentuk array.
     */
    public function getRiwayatPendidikanArrayAttribute()
    {
        return $this->formatTextToArray($this->riwayat_pendidikan);
    }

    /**
     * Mengembalikan pengalaman kerja dalam bentuk array.
     */
    public function getPengalamanKerjaArrayAttribute()
    {
        return $this->formatTextToArray($this->pengalaman_kerja);
    }

    /**
     * Mengembalikan daftar penelitian dalam bentuk array.
     */
    public function getPenelitianArrayAttribute()
    {
        return $this->formatTextToArray($this->penelitian);
    }

    /**
     * Mengembalikan daftar publikasi dalam bentuk array.
     */
    public function getPublikasiArrayAttribute()
    {
        return $this->formatTextToArray($this->publikasi);
    }

    /**
     * Helper untuk memecah teks dengan newline menjadi array.
     */
    protected function formatTextToArray($text)
    {
        if (empty($text)) {
            return [];
        }

        return array_filter(
            array_map('trim', explode("\n", $text))
        );
    }
}
