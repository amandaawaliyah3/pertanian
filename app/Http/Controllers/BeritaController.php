<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Comment;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita
     */
    public function index()
    {
        $beritas = Berita::whereNotNull('konten') // Hanya ambil yang memiliki konten
            ->latest()
            ->paginate(10);

        return view('berita.beranda', [
            'beritas' => $beritas,
            'title' => 'Daftar Berita'
        ]);
    }

    /**
     * Menampilkan detail berita + komentar
     */
    public function show($id)
    {
        $berita = Berita::findOrFail($id);

        // Ambil berita lain untuk rekomendasi
        $relatedBeritas = Berita::where('id', '!=', $id)
            ->whereNotNull('konten')
            ->latest()
            ->take(3)
            ->get();

        // Ambil komentar yang disetujui untuk berita ini
        $comments = Comment::where('berita_id', $berita->id)
            ->where('is_approved', true)
            ->latest()
            ->get();

        return view('berita.show', [
            'berita' => $berita,
            'relatedBeritas' => $relatedBeritas,
            'comments' => $comments,
            'title' => $berita->judul
        ]);
    }
}
