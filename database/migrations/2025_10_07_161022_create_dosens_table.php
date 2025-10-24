ini kode ku 
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();

            // Data utama dosen
            $table->string('nama_dosen');                // ✅ Sesuai dengan seeder
            $table->string('nip')->nullable()->unique(); // NIP unik, boleh null
            $table->string('nidn')->nullable();          // Nomor Induk Dosen Nasional
            $table->string('jabatan')->nullable();       // ✅ Tambahkan ini, sesuai error
            $table->string('email')->nullable();         // Email dosen
            $table->string('no_hp')->nullable();         // Nomor HP

            // Informasi tambahan
            $table->text('bidang_keahlian')->nullable(); 
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->json('penelitian')->nullable();
            $table->json('publikasi')->nullable();
            $table->boolean('is_kaprodi')->default(false);

            // Foto dan relasi
            $table->string('foto')->nullable();          
            $table->foreignId('prodi_id')
                ->constrained('prodis')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
