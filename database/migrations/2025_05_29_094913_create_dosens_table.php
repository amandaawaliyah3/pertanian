<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->text('bidang_keahlian');
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('penelitian')->nullable();
            $table->text('publikasi')->nullable();
            $table->string('foto')->nullable(); // nama file foto di storage
            $table->boolean('is_kaprodi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
}
