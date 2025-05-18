<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index()
    {
        // Ambil data mata kuliah per semester
        $semesters = [];
        for ($i = 1; $i <= 8; $i++) {
            $semesters[$i] = MataKuliah::where('semester', $i)
                ->orderBy('kode')
                ->get();
        }

        // Hitung total SKS teori dan praktikum
        $totalTeori = MataKuliah::sum('sks_teori');
        $totalPraktikum = MataKuliah::sum('sks_praktikum');

        return view('kurikulum.index', compact('semesters', 'totalTeori', 'totalPraktikum'));
    }

    public function show($semester)
    {
        $matkuls = MataKuliah::where('semester', $semester)
            ->orderBy('kode')
            ->get();
            
        $semesterName = "Semester $semester";
        
        return view('kurikulum.show', compact('matkuls', 'semesterName'));
    }
}