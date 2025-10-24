<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $prodis = [
            [
                'kode_prodi' => 'BTP-D3',
                'nama_prodi' => 'Budidaya Tanaman Perkebunan (D3)',
            ],
            [
                'kode_prodi' => 'THP-D3',
                'nama_prodi' => 'Teknologi Hasil Pangan (D3)',
            ],
            [
                'kode_prodi' => 'PP-S1T',
                'nama_prodi' => 'Pengelolaan Perkebunan (S1 Terapan)',
            ],
            [
                'kode_prodi' => 'TRP-D3',
                'nama_prodi' => 'Teknologi Rekayasa Pangan (D3)',
            ],
            [
                'kode_prodi' => 'TPTP-S1',
                'nama_prodi' => 'Teknologi Pengolahan Tanaman Pangan (S1)',
            ],
        ];

        foreach ($prodis as $prodi) {
            Prodi::firstOrCreate(['kode_prodi' => $prodi['kode_prodi']], $prodi);
        }
    }
}
