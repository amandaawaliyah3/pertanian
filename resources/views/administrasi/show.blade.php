@extends('layouts.app')

{{-- Asumsi Controller mengirim $item --}}
@section('title', $item->nama . ' - Staf Administrasi') 

@section('content')
<div class="container py-5">
    {{-- Tambahkan padding di atas untuk mengatasi navbar --}}
    <div class="row justify-content-center mt-5 pt-3"> 
        <div class="col-md-9">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Detail Staf Administrasi</h5>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        
                        {{-- Bagian Kiri: Foto Pas Foto --}}
                        <div class="col-md-4 text-center border-end">
                            <div class="mb-3">
                                @if($item->foto)
                                    {{-- Kotak Pas Foto (Rasio 3:4) --}}
                                    <div style="width: 150px; height: 200px; overflow: hidden; margin: 0 auto; border: 3px solid #e9ecef; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                        <img src="{{ asset('storage/'.$item->foto) }}" 
                                             class="img-fluid"
                                             alt="Foto {{ $item->nama }}"
                                             style="width: 100%; height: 100%; object-fit: cover;"> 
                                    </div>
                                @else
                                    <div class="text-muted py-5 border">Tidak Ada Foto</div>
                                @endif
                            </div>
                            
                            {{-- Nama dan Bidang Kecil di Bawah Foto --}}
                            <h4 class="mt-3 fw-bold">{{ $item->nama }}</h4>
                            <p class="text-primary mb-0">{{ $item->bidang }}</p>
                        </div>
                        
                        {{-- Bagian Kanan: Detail Data (Sesuai Struktur Asli) --}}
                        <div class="col-md-8 align-self-center">
                            <h4 class="mb-3 text-success">Informasi Dasar</h4>
                            <table class="table table-striped table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%;">NIP</th>
                                        <td>{{ $item->nip }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bidang</th>
                                        <td>{{ $item->bidang }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <div class="mt-4">
                                <a href="{{ route('administrasi.index') }}" class="btn btn-outline-success">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Staf
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection