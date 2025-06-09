<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteLogo extends Model
{
    protected $fillable = [
        'id', // Tambahkan ini
        'logo_path',
        'institution_name',
        'institution_subname'
    ];

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute()
    {
        if (!$this->logo_path) {
            return asset('images/logo-Pertanian-default.png');
        }
        return Storage::url($this->logo_path);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            // Force ID to always be 1
            $model->id = 1;
        });

        static::updating(function ($logo) {
            if ($logo->isDirty('logo_path') && $logo->getOriginal('logo_path')) {
                Storage::disk('public')->delete($logo->getOriginal('logo_path'));
            }
        });
    }

    public static function getInstance()
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'logo_path' => null,
                'institution_name' => 'Jurusan Pertanian',
                'institution_subname' => 'Politeknik Pertanian Negeri Samarinda'
            ]
        );
    }
}
