<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    /**
     * Menampilkan daftar kerjasama dengan filter dan search.
     */
    public function index(Request $request)
    {
        $query = Kerjasama::query();

        // Search berdasarkan nama mitra atau keterangan
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_mitra', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan jenis kerjasama
        if ($request->filled('jenis')) {
            $query->where('jenis_kerjasama', $request->jenis);
        }

        $kerjasamas = $query->latest()->get();

        // Ambil semua jenis_kerjasama unik untuk filter dropdown
        $jenisOptions = Kerjasama::select('jenis_kerjasama')->distinct()->pluck('jenis_kerjasama');

        return view('kerjasama.index', compact('kerjasamas', 'jenisOptions'));
    }

    /**
     * Menampilkan detail satu kerjasama dan relasinya.
     */
    public function show($id)
    {
        $kerjasama = Kerjasama::with(['penelitians', 'pengabdians'])->findOrFail($id);
        return view('kerjasama.show', compact('kerjasama'));
    }
}
