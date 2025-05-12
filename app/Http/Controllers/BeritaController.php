<?php
namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(6);
        return view('berita.index', compact('berita'));
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.beranda', compact('berita'));
    }
}
