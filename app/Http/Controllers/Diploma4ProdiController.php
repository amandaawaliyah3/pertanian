<?php

namespace App\Http\Controllers;

use App\Models\Diploma4Prodi;
use Illuminate\Http\Request;

class Diploma4ProdiController extends Controller
{
    public function index()
    {
        $prodis = Diploma4Prodi::all();
        return view('d4.index', compact('prodis'));
    }

    public function show($id)
    {
        $prodi = Diploma4Prodi::findOrFail($id);
        return view('d4.show', compact('prodi'));
    }
}
