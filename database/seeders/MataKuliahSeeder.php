<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        // Semester 1 - 9 mata kuliah
        $semester1 = [
            [
                'kode' => 'MK001',
                'nama' => 'Bahasa Indonesia',
                'semester' => 1,
                'sks_teori' => 2,
                'sks_praktikum' => 0,
                'jenis' => 'wajib',
                'deskripsi' => 'Mata kuliah ini membahas tentang penggunaan bahasa Indonesia yang baik dan benar dalam konteks akademik dan profesional.',
                'capaian_pembelajaran' => 'Mahasiswa mampu menggunakan bahasa Indonesia secara baik dan benar dalam penulisan karya ilmiah.',
                'referensi' => '1. Buku Pedoman Bahasa Indonesia\n2. Ejaan Yang Disempurnakan',
            ],
            [
                'kode' => 'MK002',
                'nama' => 'Pendidikan Agama',
                'semester' => 1,
                'sks_teori' => 2,
                'sks_praktikum' => 0,
                'jenis' => 'wajib',
                'deskripsi' => 'Mata kuliah ini membahas tentang nilai-nilai agama dan penerapannya dalam kehidupan sehari-hari.',
                'capaian_pembelajaran' => 'Mahasiswa memahami nilai-nilai agama dan mampu menerapkannya dalam kehidupan.',
                'referensi' => '1. Kitab Suci\n2. Buku Ajar Pendidikan Agama',
            ],
            // Tambahkan 7 mata kuliah lainnya untuk semester 1
        ];

        // Semester 2 - 7 mata kuliah
        $semester2 = [
            [
                'kode' => 'MK010',
                'nama' => 'Manajemen Agribisnis',
                'semester' => 2,
                'sks_teori' => 2,
                'sks_praktikum' => 0,
                'jenis' => 'wajib',
                'deskripsi' => 'Pengenalan konsep manajemen dalam agribisnis.',
                'capaian_pembelajaran' => 'Mahasiswa memahami prinsip dasar manajemen agribisnis.',
                'referensi' => '1. Dasar-Dasar Agribisnis\n2. Manajemen Usaha Tani',
                'prasyarat' => 'MK001',
            ],
            // Tambahkan 6 mata kuliah lainnya untuk semester 2
        ];

        // Semester 3 - 8 mata kuliah
        $semester3 = [
            [
                'kode' => 'MK020',
                'nama' => 'Statistika Pertanian',
                'semester' => 3,
                'sks_teori' => 2,
                'sks_praktikum' => 1,
                'jenis' => 'wajib',
                'deskripsi' => 'Penerapan statistika dalam analisis data pertanian.',
                'capaian_pembelajaran' => 'Mahasiswa mampu menganalisis data pertanian menggunakan metode statistika.',
                'referensi' => '1. Statistika untuk Pertanian\n2. Analisis Data dengan R',
                'prasyarat' => 'MK010',
            ],
            // Tambahkan 7 mata kuliah lainnya untuk semester 3
        ];

        // Semester 4 - 7 mata kuliah
        $semester4 = [
            [
                'kode' => 'MK030',
                'nama' => 'Perancangan Percobaan',
                'semester' => 4,
                'sks_teori' => 2,
                'sks_praktikum' => 1,
                'jenis' => 'wajib',
                'deskripsi' => 'Teknik perancangan percobaan dalam penelitian pertanian.',
                'capaian_pembelajaran' => 'Mahasiswa mampu merancang percobaan penelitian pertanian.',
                'referensi' => '1. Metode Penelitian Pertanian\n2. Desain Eksperimen',
                'prasyarat' => 'MK020',
            ],
            // Tambahkan 6 mata kuliah lainnya untuk semester 4
        ];

        // Semester 5 - 8 mata kuliah
        $semester5 = [
            [
                'kode' => 'MK040',
                'nama' => 'Teknologi Pasca Panen',
                'semester' => 5,
                'sks_teori' => 1,
                'sks_praktikum' => 1,
                'jenis' => 'wajib',
                'deskripsi' => 'Teknologi pengolahan hasil panen tanaman pangan.',
                'capaian_pembelajaran' => 'Mahasiswa memahami teknologi pasca panen tanaman pangan.',
                'referensi' => '1. Teknologi Pasca Panen\n2. Penyimpanan Hasil Pertanian',
                'prasyarat' => 'MK030',
            ],
            // Tambahkan 7 mata kuliah lainnya untuk semester 5
        ];

        // Semester 6 - 8 mata kuliah
        $semester6 = [
            [
                'kode' => 'MK050',
                'nama' => 'Teknologi Produksi Tanaman Pangan Alternatif',
                'semester' => 6,
                'sks_teori' => 1,
                'sks_praktikum' => 1,
                'jenis' => 'wajib',
                'deskripsi' => 'Teknologi produksi tanaman pangan non-konvensional.',
                'capaian_pembelajaran' => 'Mahasiswa memahami teknologi produksi tanaman pangan alternatif.',
                'referensi' => '1. Tanaman Pangan Alternatif\n2. Budidaya Tanaman Non-Konvensional',
                'prasyarat' => 'MK040',
            ],
            // Tambahkan 7 mata kuliah lainnya untuk semester 6
        ];

        // Semester 7 - 1 mata kuliah
        $semester7 = [
            [
                'kode' => 'MK060',
                'nama' => 'Magang Industri',
                'semester' => 7,
                'sks_teori' => 0,
                'sks_praktikum' => 20,
                'jenis' => 'wajib',
                'deskripsi' => 'Praktik kerja di industri terkait produksi tanaman pangan.',
                'capaian_pembelajaran' => 'Mahasiswa memiliki pengalaman kerja langsung di industri.',
                'referensi' => '1. Panduan Magang\n2. Buku Pedoman PKL',
                'prasyarat' => null,
            ],
        ];

        // Semester 8 - 2 mata kuliah
        $semester8 = [
            [
                'kode' => 'MK070',
                'nama' => 'Praktek Kerja Nyata (PKN)',
                'semester' => 8,
                'sks_teori' => 0,
                'sks_praktikum' => 3,
                'jenis' => 'wajib',
                'deskripsi' => 'Penerapan ilmu di masyarakat melalui program kerja nyata.',
                'capaian_pembelajaran' => 'Mahasiswa mampu menerapkan ilmu untuk memecahkan masalah masyarakat.',
                'referensi' => '1. Panduan PKN\n2. Metode Pemberdayaan Masyarakat',
                'prasyarat' => 'MK060',
            ],
            [
                'kode' => 'MK071',
                'nama' => 'Proyek Usaha Mandiri/Skripsi',
                'semester' => 8,
                'sks_teori' => 0,
                'sks_praktikum' => 6,
                'jenis' => 'wajib',
                'deskripsi' => 'Proyek akhir berupa usaha mandiri atau penelitian skripsi.',
                'capaian_pembelajaran' => 'Mahasiswa mampu menyusun karya ilmiah atau rencana usaha mandiri.',
                'referensi' => '1. Pedoman Penulisan Skripsi\n2. Kewirausahaan Pertanian',
                'prasyarat' => 'MK060',
            ],
        ];

        // Gabungkan semua mata kuliah
        $allMataKuliah = array_merge(
            $semester1, $semester2, $semester3, $semester4,
            $semester5, $semester6, $semester7, $semester8
        );

        // Insert ke database
        foreach ($allMataKuliah as $mk) {
            MataKuliah::create($mk);
        }
    }
}