<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('site_logos', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path')->nullable()->comment('Path penyimpanan logo');
            $table->string('institution_name')->default('Jurusan Pertanian');
            $table->string('institution_subname')->default('Politeknik Pertanian Negeri Samarinda');
            $table->timestamps();
        });

        // Insert default record
        DB::table('site_logos')->insert([
            'logo_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('site_logos');
    }
};
