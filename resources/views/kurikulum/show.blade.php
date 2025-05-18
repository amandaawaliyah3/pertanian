@extends('layouts.app')

@section('title', 'Kurikulum ' . $semesterName . ' TPTP')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
         <div class="container mt-5 pt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-success">{{ $semesterName }}</h2>
            <a href="{{ route('kurikulum') }}" class="btn btn-outline-success">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Kurikulum
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @foreach($matkuls as $mk)
                <div class="mb-4 pb-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="mb-0">{{ $mk->nama }}</h4>
                        <span class="badge bg-{{ $mk->jenis == 'wajib' ? 'success' : 'warning' }}">
                            {{ ucfirst($mk->jenis) }}
                        </span>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <strong>Kode MK:</strong> {{ $mk->kode }}
                        </div>
                        <div class="col-md-3">
                            <strong>SKS:</strong> 
                            {{ $mk->sks_teori }} Teori + {{ $mk->sks_praktikum }} Praktikum
                            (Total {{ $mk->sks_teori + $mk->sks_praktikum }} SKS)
                        </div>
                        <div class="col-md-6">
                            <strong>Prasyarat:</strong> 
                            {{ $mk->prasyarat ? $mk->prasyaratMatkul->nama ?? $mk->prasyarat : 'Tidak ada' }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <strong>Deskripsi:</strong>
                        <p>{{ $mk->deskripsi }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Capaian Pembelajaran:</strong>
                        <p>{{ $mk->capaian_pembelajaran }}</p>
                    </div>
                    <div>
                        <strong>Referensi:</strong>
                        <p>{{ $mk->referensi }}</p>
                    </div>
                </div>
                @endforeach

                <div class="mt-4 pt-3 border-top">
                    <h5 class="text-success">Rekap SKS {{ $semesterName }}</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Total SKS Teori:</strong> {{ $matkuls->sum('sks_teori') }}
                        </div>
                        <div class="col-md-4">
                            <strong>Total SKS Praktikum:</strong> {{ $matkuls->sum('sks_praktikum') }}
                        </div>
                        <div class="col-md-4">
                            <strong>Total SKS:</strong> {{ $matkuls->sum('sks_teori') + $matkuls->sum('sks_praktikum') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection