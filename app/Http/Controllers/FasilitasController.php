<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('created_at', 'desc')->get();
        
        return view('fasilitas.index', [
            'fasilitas' => $fasilitas
        ]);
    }
}