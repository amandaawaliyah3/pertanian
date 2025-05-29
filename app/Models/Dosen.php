<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';
    protected $primaryKey = 'id';

    protected $fillable = [
        'foto',
        'nama',
        'nip',
        'bidang_keahlian',
        'riwayat_pendidikan',
        'pengalaman_kerja',
        'penelitian',
        'publikasi',
        'email',
        'no_hp',
        'is_kaprodi',
    ];

    protected $casts = [
        'penelitian' => 'array',
        'publikasi' => 'array',
        'is_kaprodi' => 'boolean',
    ];

    protected $appends = ['foto_url', 'penelitian_count', 'publikasi_count'];

    /**
     * Get the foto URL attribute
     */
    public function getFotoUrlAttribute()
    {
        if (!$this->foto) {
            return null;
        }
        
        return Storage::disk('public')->exists($this->foto) 
            ? Storage::disk('public')->url($this->foto)
            : null;
    }

    /**
     * Get penelitian count attribute
     */
    public function getPenelitianCountAttribute()
    {
        return is_array($this->penelitian) ? count($this->penelitian) : 0;
    }

    /**
     * Get publikasi count attribute
     */
    public function getPublikasiCountAttribute()
    {
        return is_array($this->publikasi) ? count($this->publikasi) : 0;
    }

    /**
     * Set bidang keahlian attribute
     */
    public function setBidangKeahlianAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['bidang_keahlian'] = implode(', ', $value);
        } else {
            $this->attributes['bidang_keahlian'] = $value;
        }
    }

    /**
     * Get bidang keahlian as array
     */
    public function getBidangKeahlianArrayAttribute()
    {
        if (empty($this->bidang_keahlian)) {
            return [];
        }
        return explode(', ', $this->bidang_keahlian);
    }

    /**
     * Set foto attribute with proper path
     */
    public function setFotoAttribute($value)
    {
        if ($value && !str_starts_with($value, 'dosen/')) {
            $this->attributes['foto'] = 'dosen/' . ltrim($value, '/');
        } else {
            $this->attributes['foto'] = $value;
        }
    }

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($dosen) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
        });
    }
}