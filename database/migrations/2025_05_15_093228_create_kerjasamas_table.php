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
        Schema::create('kerjasamas', function (Blueprint $table) {
    $table->id();
    $table->string('nama_mitra');
    $table->string('jenis_kerjasama');
    $table->date('tanggal_mulai');
    $table->date('tanggal_selesai');
    $table->text('keterangan')->nullable();
    $table->string('logo')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerjasamas');
    }
};
