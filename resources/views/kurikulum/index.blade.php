@extends('layouts.app')

@section('title', 'Kurikulum TPTP')

@section('body-class', 'pt-5 mt-5')


@section('content')
<div class="py-5 bg-light">
    <div class="container mt-5 pt-5">
        <h2 class="fw-bold text-success text-center section-title">Kurikulum Program Studi</h2>
        <p class="text-muted fs-5 text-center mb-5">Struktur kurikulum Program Studi Teknologi Produksi Tanaman Pangan</p>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total SKS Teori</h5>
                        <h2 class="text-success">{{ $totalTeori }} SKS</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total SKS Praktikum</h5>
                        <h2 class="text-success">{{ $totalPraktikum }} SKS</h2>
                    </div>
                </div>
            </div>
        </div>

        @for($i = 1; $i <= 8; $i++)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Semester {{ $i }} ({{ $semesters[$i]->count() }} Mata Kuliah)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Mata Kuliah</th>
                                    <th>Jenis</th>
                                    <th>SKS Teori</th>
                                    <th>SKS Praktikum</th>
                                    <th>Total SKS</th>
                                    <th>Prasyarat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($semesters[$i] as $mk)
                                <tr>
                                    <td>{{ $mk->kode }}</td>
                                    <td>
                                        <a href="#" class="text-decoration-none">{{ $mk->nama }}</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $mk->jenis == 'wajib' ? 'success' : 'warning' }}">
                                            {{ ucfirst($mk->jenis) }}
                                        </span>
                                    </td>
                                    <td>{{ $mk->sks_teori }}</td>
                                    <td>{{ $mk->sks_praktikum }}</td>
                                    <td>{{ $mk->sks_teori + $mk->sks_praktikum }}</td>
                                    <td>{{ $mk->prasyarat ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="fw-bold">
                                    <td colspan="3">Total Semester {{ $i }}</td>
                                    <td>{{ $semesters[$i]->sum('sks_teori') }}</td>
                                    <td>{{ $semesters[$i]->sum('sks_praktikum') }}</td>
                                    <td>{{ $semesters[$i]->sum('sks_teori') + $semesters[$i]->sum('sks_praktikum') }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <a href="{{ route('kurikulum.show', $i) }}" class="btn btn-outline-success btn-sm">Lihat Detail Semester {{ $i }}</a>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection