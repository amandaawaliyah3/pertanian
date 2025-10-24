<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\InfoBox;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function beranda()
    {
        $infoBoxes = InfoBox::all();
        
        // ✅ PERBAIKAN: Mengganti latest() dengan orderBy('tanggal', 'desc')
        // Ini memastikan berita ditampilkan sesuai tanggal yang diinput pengguna di Filament.
        $beritas = Berita::orderBy('tanggal', 'desc')->take(3)->get();
        
        // Tetap menggunakan latest() untuk Prestasi jika kolom 'tanggal' tidak ada di sana
        $prestasis = Prestasi::latest()->take(3)->get(); 

        return view('berita.beranda', compact('infoBoxes', 'beritas', 'prestasis'));
    }
}