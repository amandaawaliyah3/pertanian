<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dosen',
        'nip',
        'nidn',
        'email',
        'no_hp',
        'bidang_keahlian',
        'riwayat_pendidikan',
        'pengalaman_kerja',
        'foto',
        'penelitian',
        'publikasi',
        'is_kaprodi',
        'prodi_id',
        'jabatan', // ✅ FIX: Kolom jabatan ditambahkan ke fillable
    ];

    protected $casts = [
        'penelitian' => 'array',
        'publikasi'  => 'array',
        'is_kaprodi' => 'boolean',
    ];

    /**
     * Relasi ke tabel Prodi
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    /**
     * Accessor untuk mendapatkan URL foto (otomatis handle jika tidak ada foto)
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }

        return asset('images/default-profile.png'); // fallback jika tidak ada foto
    }

    /**
     * Accessor untuk ubah bidang keahlian menjadi array (kalau disimpan pakai koma)
     */
    public function getBidangKeahlianArrayAttribute()
    {
        if (empty($this->bidang_keahlian)) {
            return [];
        }

        // Kalau sudah JSON decode dulu, kalau gagal baru split koma
        $decoded = json_decode($this->bidang_keahlian, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        return array_map('trim', explode(',', $this->bidang_keahlian));
    }
}