<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;

class PrestasiController extends Controller
{
    public function show($id)
    {
        // Get the specific achievement with proper error handling
        $prestasi = Prestasi::findOrFail($id);
        
        // Get 3 related achievements (excluding current one)
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