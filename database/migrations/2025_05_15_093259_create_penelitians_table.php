<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('penelitians');
    }

    public function down(): void
    {
        // Opsional: bisa dibuat rollback-nya jika diperlukan
        Schema::create('penelitians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kerjasama_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->string('peneliti');
            $table->date('tahun');
            $table->timestamps();
        });
    }
};
