<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();

            // Social Media
            $table->string('facebook_url', 200)->nullable();
            $table->string('instagram_url', 200)->nullable();
            $table->string('youtube_url', 200)->nullable();

            // Contact Info
            $table->string('address', 500);
            $table->string('phone', 20);
            $table->string('email', 100);

            // Map Embed
            $table->text('map_embed_url');

            $table->timestamps();
        });

        // Insert default data
        DB::table('footer_settings')->insert([
            'facebook_url' => 'https://facebook.com/yourpage',
            'instagram_url' => 'https://instagram.com/youraccount',
            'youtube_url' => 'https://youtube.com/yourchannel',
            'address' => 'Jl. Pertanian No. 123, Kota',
            'phone' => '(021) 12345678',
            'email' => 'JurusanPertanian@universitas.ac.id',
            'map_embed_url' => 'https://maps.google.com/maps?q=Politeknik%20Pertanian%20Negeri%20Samarinda',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('footer_settings');
    }
};
