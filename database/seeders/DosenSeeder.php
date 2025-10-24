<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;
use App\Models\Prodi;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan Prodi sudah ada
        if (Prodi::count() === 0) {
            $this->command->warn('⚠️ Seeder Prodi belum dijalankan. Jalankan ProdiSeeder terlebih dahulu.');
            return;
        }

        // Fungsi bantu cari ID prodi dari nama (case-insensitive)
        $getProdiId = function ($nama) {
            $prodi = Prodi::whereRaw('LOWER(nama_prodi) = ?', [strtolower(trim($nama))])->first();

            if (!$prodi) {
                echo "⚠️ Prodi '$nama' tidak ditemukan di database.\n";
                return null;
            }

            return $prodi->id;
        };

        $dosens = [
            [
                'nama_dosen' => 'Dr. Andi Saputra, M.P.',
                'nip' => '197501011999031001',
                'nidn' => '0011223344',
                'jabatan' => 'Ketua Program Studi',
                'email' => 'andi.saputra@example.com',
                'foto' => null,
                'is_kaprodi' => true,
                'prodi_id' => $getProdiId('Budidaya Tanaman Perkebunan (D3)'),
            ],
            [
                'nama_dosen' => 'Ir. Rina Kurnia, M.Sc.',
                'nip' => '198003051999032002',
                'nidn' => '0055667788',
                'jabatan' => 'Dosen',
                'email' => 'rina.kurnia@example.com',
                'foto' => null,
                'is_kaprodi' => false,
                'prodi_id' => $getProdiId('Teknologi Hasil Pangan (D3)'),
            ],
            [
                'nama_dosen' => 'Dr. Bambang Wibowo, M.Agr.',
                'nip' => '197812121999031003',
                'nidn' => '0099001122',
                'jabatan' => 'Dosen',
                'email' => 'bambang.wibowo@example.com',
                'foto' => null,
                'is_kaprodi' => false,
                'prodi_id' => $getProdiId('Pengelolaan Perkebunan (S1 Terapan)'),
            ],
            [
                'nama_dosen' => 'Dr. Lestari Widodo, M.T.',
                'nip' => '197912021999032004',
                'nidn' => '0077889900',
                'jabatan' => 'Dosen',
                'email' => 'lestari.widodo@example.com',
                'foto' => null,
                'is_kaprodi' => false,
                'prodi_id' => $getProdiId('Teknologi Rekayasa Pangan (D3)'),
            ],
            [
                'nama_dosen' => 'Prof. Dewi Hartati, M.Sc.',
                'nip' => '197511111999031005',
                'nidn' => '0088112233',
                'jabatan' => 'Dosen',
                'email' => 'dewi.hartati@example.com',
                'foto' => null,
                'is_kaprodi' => false,
                'prodi_id' => $getProdiId('Teknologi Pengolahan Tanaman Pangan (S1)'),
            ],
        ];

        foreach ($dosens as $dosen) {
            if (!$dosen['prodi_id']) {
                continue; // Skip dosen yang prodi-nya tidak ditemukan
            }

            Dosen::updateOrCreate(
                ['nip' => $dosen['nip']],
                $dosen
            );
        }

        $this->command->info('✅ Seeder Dosen berhasil dijalankan!');
    }
}
