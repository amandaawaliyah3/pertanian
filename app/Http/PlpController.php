<?php

namespace App\Http\Controllers;

use App\Models\Plp;
use Illuminate\Http\Request;

class PlpController extends Controller
{
    public function index()
    {
        $plps = Plp::where('status', true)
                  ->orderBy('nama')
                  ->get();

        return view('plp.index', compact('plps'));
    }

    public function show($id)
    {
        $plp = Plp::findOrFail($id);
        return view('plp.show', compact('plp'));
    }
}
