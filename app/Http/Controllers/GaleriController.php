<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $galeris = Galeri::filter($request->only(['kategori', 'search']))
            ->latest()
            ->paginate(8) // Pagination 8 item per halaman
            ->withQueryString(); // Agar filter tetap saat pindah halaman

        return view('galeri.index', compact('galeris'));
    }

    public function show($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.show', compact('galeri'));
    }
}
