<?php

namespace App\Imports;

use App\Models\MataKuliah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class MataKuliahImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Penyesuaian untuk header yang mungkin berbeda
        $kode = $row['kode'] ?? $row['kode_mk'] ?? null;
        $nama = $row['nama'] ?? $row['nama_mata_kuliah'] ?? null;

        return new MataKuliah([
            'kode' => $kode,
            'nama' => $nama,
            'semester' => $row['semester'] ?? $row['sem'] ?? 1,
            'jenis' => $row['jenis'] ?? 'wajib',
            'prasyarat' => $row['prasyarat'] ?? null,
            'sks_teori' => $row['sks_teori'] ?? $row['teori'] ?? 0,
            'sks_praktikum' => $row['sks_praktikum'] ?? $row['praktikum'] ?? 0,
            'deskripsi' => $row['deskripsi'] ?? '-',
            'capaian_pembelajaran' => $row['capaian_pembelajaran'] ?? $row['capaian'] ?? '-',
            'referensi' => $row['referensi'] ?? '-',
        ]);
    }

    public function rules(): array
    {
        return [
            '*.kode' => ['required', 'max:10', Rule::unique('mata_kuliahs', 'kode')], // <- perbaikan nama tabel
            '*.nama' => 'required|max:255',
            '*.semester' => 'required|integer|min:1|max:8',
            '*.jenis' => 'required|in:wajib,pilihan',
            '*.sks_teori' => 'required|integer|min:0|max:10',
            '*.sks_praktikum' => 'required|integer|min:0|max:10',
            '*.deskripsi' => 'required',
            '*.capaian_pembelajaran' => 'required',
            '*.referensi' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.kode.required' => 'Kode mata kuliah wajib diisi',
            '*.kode.unique' => 'Kode mata kuliah sudah digunakan',
            '*.nama.required' => 'Nama mata kuliah wajib diisi',
        ];
    }
}
