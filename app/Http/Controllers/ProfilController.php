<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use App\Models\VisiMisi;
use App\Models\Akreditasi;
use App\Models\Berita;

class ProfilController extends Controller
{
    /**
     * Tampilkan halaman profil berisi Sejarah, Visi Misi, Akreditasi, dan 5 berita terbaru.
     */
    public function index()
    {
        // Ambil satu data sejarah
        $sejarah = Sejarah::first();

        // Ambil satu data visi dan misi
        $visiMisi = VisiMisi::first();

        // Ambil semua data akreditasi
        $akreditasi = Akreditasi::all();

        // Ambil 5 berita terbaru
        $beritas = Berita::latest()->take(5)->get();

        // Kirim data ke view profil/index.blade.php
        return view('profil.index', compact('sejarah', 'visiMisi', 'akreditasi', 'beritas'));
    }
}
