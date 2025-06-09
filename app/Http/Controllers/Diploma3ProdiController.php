<?php

namespace App\Http\Controllers;

use App\Models\Diploma3Prodi;
use Illuminate\Http\Request;

class Diploma3ProdiController extends Controller
{
    public function index()
    {
        $prodis = Diploma3Prodi::all();
        return view('d3.index', compact('prodis'));
    }

    public function show($id)
    {
        $prodi = Diploma3Prodi::findOrFail($id);
        return view('d3.show', compact('prodi'));
    }
}
