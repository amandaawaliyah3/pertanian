<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jalur_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jalur');
            $table->text('deskripsi');
            $table->date('tanggal_buka');
            $table->date('tanggal_tutup');
            $table->integer('kuota')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jalur_masuks');
    }
};
