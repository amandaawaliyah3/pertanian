<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    public function index(Request $request)
    {
        $query = Kerjasama::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                // Diasumsikan kolom 'lokasi' ada untuk filter
                $q->where('nama_mitra', 'like', '%'.$search.'%')
                  ->orWhere('keterangan', 'like', '%'.$search.'%')
                  ->orWhere('lokasi', 'like', '%'.$search.'%'); 
            });
        }

        // Filter jenis kerjasama
        if ($request->filled('jenis')) {
            $query->where('jenis_kerjasama', $request->jenis);
        }

        // Filter tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_mulai', $request->tahun);
        }

        $kerjasamas = $query->latest('tanggal_mulai')
                            ->paginate(10)
                            ->withQueryString();

        $jenisOptions = Kerjasama::distinct('jenis_kerjasama')
                               ->pluck('jenis_kerjasama');
        $tahunOptions = Kerjasama::selectRaw('YEAR(tanggal_mulai) as tahun')
                               ->distinct()
                               ->orderBy('tahun', 'desc')
                               ->pluck('tahun');

        return view('kerjasama.index', [
            'kerjasamas' => $kerjasamas,
            'jenisOptions' => $jenisOptions,
            'tahunOptions' => $tahunOptions,
            // Mengirimkan Judul Spesifik Halaman
            'title' => 'Daftar Kerjasama' 
        ]);
    }

    public function show($id)
    {
        $kerjasama = Kerjasama::findOrFail($id);

        return view('kerjasama.show', [
            'kerjasama' => $kerjasama,
            // Judul di halaman detail adalah nama mitra
            'title' => $kerjasama->nama_mitra
        ]);
    }
}