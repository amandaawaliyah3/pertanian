<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    public function run()
    {
        FooterSetting::create([
            'facebook_url' => 'https://facebook.com/pertanian.univ',
            'instagram_url' => 'https://instagram.com/pertanian.univ',
            'youtube_url' => 'https://youtube.com/c/pertanianchannel',
            'address' => 'Jl. Pertanian No. 123, Kampus Universitas, Kota Samarinda, Kalimantan Timur',
            'phone' => '(0541) 1234567',
            'email' => 'info@pertanian.univ.ac.id',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.680234589743!2d117.120530!3d-0.536822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df68080334dac99%3A0x5327a22a4028b267!2sPoliteknik%20Pertanian%20Negeri%20Samarinda!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
