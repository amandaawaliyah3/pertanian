<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function show($id)
    {
        // Get the current news with proper error handling
        $berita = Berita::findOrFail($id);
        
        // Get 3 related news (excluding current one)
        $relatedBeritas = Berita::where('id', '!=', $id)
            ->whereNotNull('konten') // Only get news with content
            ->latest()
            ->take(3)
            ->get();
        
        return view('berita.show', [
            'berita' => $berita,
            'relatedBeritas' => $relatedBeritas,
            'title' => $berita->judul
        ]);
    }
}