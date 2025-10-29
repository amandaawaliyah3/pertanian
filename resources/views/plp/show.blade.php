@extends('layouts.app')

{{-- Judul halaman diambil dari nama PLP --}}
@section('title', $plp->nama . ' - PLP') 

@section('content')
<div class="container py-5">
    {{-- Tambahkan padding di atas untuk mengatasi navbar --}}
    <div class="row justify-content-center mt-5 pt-3"> 
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Detail Profil Pendamping Lapangan Pertanian</h5>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        
                        {{-- Bagian Kiri: Foto dan Nama --}}
                        <div class="col-md-4 text-center border-end mb-4 mb-md-0">
                            <div class="mb-3">
                                @if($plp->foto)
                                    {{-- Kotak Pas Foto (Rasio 3:4) --}}
                                    <div style="width: 150px; height: 200px; overflow: hidden; margin: 0 auto; border: 3px solid #e9ecef; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                        <img src="{{ $plp->foto ? asset('storage/' . $plp->foto) : asset('images/default-avatar.png') }}" 
                                             class="img-fluid"
                                             alt="Foto {{ $plp->nama }}"
                                             style="width: 100%; height: 100%; object-fit: cover;"> 
                                    </div>
                                @else
                                    <div class="text-muted py-5 border">Tidak Ada Foto</div>
                                @endif
                            </div>
                            
                            <h4 class="mt-3 fw-bold">{{ $plp->nama }}</h4>
                        </div>
                        
                        {{-- Bagian Kanan: Detail Informasi & Deskripsi (Di kolom yang sama) --}}
                        <div class="col-md-8 align-self-center">
                            
                            {{-- 1. INFORMASI DETAIL (Tabel) --}}
                            <h4 class="mb-3 text-success">Informasi Detail</h4>
                            <table class="table table-striped table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <th style="width: 35%;">NIP</th>
                                        <td>{{ $plp->nip ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jabatan</th>
                                        <td>{{ $plp->jabatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bidang Keahlian</th>
                                        <td>{{ $plp->bidang_keahlian }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="badge {{ $plp->status ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $plp->status ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            {{-- 2. DESKRIPSI / PROFIL SINGKAT (Dipindahkan di sini) --}}
                            <h4 class="mt-4 mb-3 text-success">Deskripsi</h4>
                            <div class="mt-3">
                                {!! $plp->deskripsi ?? '<p class="text-muted">Tidak ada deskripsi profil yang tersedia.</p>' !!}
                            </div>
                            
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    {{-- Tombol Kembali --}}
                    <div class="mt-4">
                        <a href="{{ route('plp.index') }}" class="btn btn-outline-success">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar PLP
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection