<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    // Menampilkan semua mata kuliah
    public function index()
    {
        $mataKuliahs = MataKuliah::orderBy('semester')->get();
        return view('mata_kuliah.index', compact('mataKuliahs'));
    }

    // Menampilkan detail satu mata kuliah
    public function show($kode)
    {
        $mataKuliah = MataKuliah::where('kode', $kode)->firstOrFail();
        return view('mata_kuliah.show', compact('mataKuliah'));
    }

    // Untuk menampilkan form tambah (jika dibutuhkan di sisi frontend non-Filament)
    public function create()
    {
        $prasyaratOptions = MataKuliah::pluck('nama', 'kode');
        return view('mata_kuliah.create', compact('prasyaratOptions'));
    }

    // Simpan data mata kuliah baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:mata_kuliahs,kode',
            'nama' => 'required|string|max:255',
            'semester' => 'required|integer|between:1,8',
            'jenis' => 'required|in:wajib,pilihan',
            'sks_teori' => 'required|integer|min:0|max:10',
            'sks_praktikum' => 'required|integer|min:0|max:10',
            'deskripsi' => 'required|string',
            'capaian_pembelajaran' => 'required|string',
            'referensi' => 'required|string',
            'prasyarat' => 'nullable|string|exists:mata_kuliahs,kode',
        ]);

        MataKuliah::create($validated);

        return redirect()->route('mata-kuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($kode)
    {
        $mataKuliah = MataKuliah::where('kode', $kode)->firstOrFail();
        $prasyaratOptions = MataKuliah::pluck('nama', 'kode');
        return view('mata_kuliah.edit', compact('mataKuliah', 'prasyaratOptions'));
    }

    // Update data mata kuliah
    public function update(Request $request, $kode)
    {
        $mataKuliah = MataKuliah::where('kode', $kode)->firstOrFail();

        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:mata_kuliahs,kode,' . $mataKuliah->id,
            'nama' => 'required|string|max:255',
            'semester' => 'required|integer|between:1,8',
            'jenis' => 'required|in:wajib,pilihan',
            'sks_teori' => 'required|integer|min:0|max:10',
            'sks_praktikum' => 'required|integer|min:0|max:10',
            'deskripsi' => 'required|string',
            'capaian_pembelajaran' => 'required|string',
            'referensi' => 'required|string',
            'prasyarat' => 'nullable|string|exists:mata_kuliahs,kode',
        ]);

        $mataKuliah->update($validated);

        return redirect()->route('mata-kuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    // Hapus data mata kuliah
    public function destroy($kode)
    {
        $mataKuliah = MataKuliah::where('kode', $kode)->firstOrFail();
        $mataKuliah->delete();

        return redirect()->route('mata-kuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
