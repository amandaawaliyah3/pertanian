<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function index()
    {
        $laboratorium = Fasilitas::where('jenis', 'laboratorium')->get();
        $greenhouse = Fasilitas::where('jenis', 'greenhouse')->get();
        $lahanPraktikum = Fasilitas::where('jenis', 'lahan_Praktikum')->get();
        $ruangKelas = Fasilitas::where('jenis', 'ruang_kelas')->get(); // Penting!
        $lainnya = Fasilitas::whereNotIn('jenis', ['laboratorium', 'greenhouse', 'lahan_Praktikum', 'ruang_kelas'])->get();

        return view('fasilitas.index', compact(
            'laboratorium',
            'greenhouse',
            'lahanPraktikum',
            'ruangKelas',
            'lainnya'
        ));
    }
}
