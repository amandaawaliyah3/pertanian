<?php

namespace App\Http\Controllers;

use App\Models\JalurMasuk;

class JalurMasukController extends Controller
{
    public function index()
    {
        $jalurs = JalurMasuk::where('aktif', true)
            ->orderByDesc('tanggal_buka')
            ->get();

        return view('jalurmasuk.index', [
            'jalurs' => $jalurs,
            'title' => 'Jalur Masuk'
        ]);
    }

    public function show($id)
    {
        $jalur = JalurMasuk::with('persyaratan')->findOrFail($id);

        return view('jalurmasuk.show', [
            'jalur' => $jalur,
            'title' => $jalur->nama_jalur
        ]);
    }
}
