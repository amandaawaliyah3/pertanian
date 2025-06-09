<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diploma4_prodis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prodi');
            $table->text('visi');
            $table->text('misi');
            $table->string('masa_kuliah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diploma4_prodis');
    }
};
