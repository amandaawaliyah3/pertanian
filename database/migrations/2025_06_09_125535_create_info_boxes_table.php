<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('info_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('icon');       // contoh: 'fas fa-graduation-cap'
            $table->string('judul');      // contoh: 'Akreditasi'
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Undo migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_boxes');
    }
};
