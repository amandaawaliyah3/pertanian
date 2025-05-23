<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahTable extends Migration
{
    public function up()
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama', 255);
            $table->integer('semester');
            $table->enum('jenis', ['wajib', 'pilihan']);
            $table->string('prasyarat')->nullable();
            $table->integer('sks_teori')->default(0);
            $table->integer('sks_praktikum')->default(0);
            $table->text('deskripsi');
            $table->text('capaian_pembelajaran');
            $table->text('referensi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mata_kuliah');
    }
}
