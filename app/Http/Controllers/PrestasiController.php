<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;

class PrestasiController extends Controller
{
    // Halaman daftar prestasi
    public function index()
    {
        $prestasi = Prestasi::latest()->paginate(6); // ambil semua prestasi, bisa pagination

        return view('prestasi.index', [
            'prestasi' => $prestasi,
            'title' => 'Daftar Prestasi'
        ]);
    }

    // Halaman detail prestasi
    public function show($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        $relatedPrestasi = Prestasi::where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('prestasi.show', [
            'prestasi' => $prestasi,
            'relatedPrestasi' => $relatedPrestasi,
            'title' => $prestasi->judul
        ]);
    }
}
