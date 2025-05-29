<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'facebook_url',
        'twitter_url', 
        'instagram_url',
        'youtube_url',
        'address',
        'phone',
        'email',
        
    ];

    protected static function booted()
    {
        static::creating(function () {
            // Hanya izinkan satu record
            if (self::count() > 0) {
                return false;
            }
        });
    }
}