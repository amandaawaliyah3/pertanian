<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan seeder FooterSettingSeeder dan lainnya (jika ada)
        $this->call([
            FooterSettingSeeder::class,
            // Tambahkan seeder lain di sini jika perlu
        ]);

        // Menambahkan user dummy
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
