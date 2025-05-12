<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('berita.beranda', [
            'beritas' => Berita::latest()->take(3)->get(),
            'prestasis' => Prestasi::latest()->take(3)->get(),
        ]);
    }
}
