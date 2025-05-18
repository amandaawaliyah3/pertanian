<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis', [
                'laboratorium',
                'greenhouse', 
                'lahan_praktikum',
                'ruang_kelas',
                'lainnya'
            ])->default('lainnya');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->string('lokasi')->nullable();
            $table->integer('kapasitas')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->string('link_virtual_tour')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};