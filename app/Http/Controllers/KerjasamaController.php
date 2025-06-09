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

        $kerjasamas = $query->with(['penelitians', 'pengabdians'])
                          ->latest('tanggal_mulai')
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
            'title' => 'Kerjasama'
        ]);
    }

    public function show($id)
    {
        $kerjasama = Kerjasama::with([
            'penelitians' => function($query) {
                $query->latest()->take(3);
            },
            'pengabdians' => function($query) {
                $query->latest()->take(3);
            },
            'dokumen'
        ])->findOrFail($id);

        return view('kerjasama.show', [
            'kerjasama' => $kerjasama,
            'title' => $kerjasama->nama_mitra
        ]);
    }
}
