<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nidn')->unique();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('bidang_keahlian');
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('penelitian')->nullable();
            $table->text('publikasi')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_kaprodi')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosens');
    }
};