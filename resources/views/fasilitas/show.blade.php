@extends('layouts.app')

@section('title', $fasilitas->nama . ' | Fasilitas TPTP')

@section('content')
<div class="py-5 bg-light">
     <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $fasilitas->nama }}</li>
                            </ol>
                        </nav>
                        
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="fw-bold mb-0">{{ $fasilitas->nama }}</h1>
                            <span class="badge bg-success text-capitalize">{{ str_replace('_', ' ', $fasilitas->jenis) }}</span>
                        </div>
                        
                        <!-- Gambar Utama -->
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $fasilitas->foto) }}" alt="{{ $fasilitas->nama }}" class="img-fluid rounded shadow-sm w-100" style="max-height: 400px; object-fit: cover;">
                        </div>
                        
                        <!-- Informasi Fasilitas -->
                        <div class="row mb-4">
                            @if($fasilitas->lokasi)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="icon-box bg-light-success text-success me-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Lokasi</h5>
                                        <p class="mb-0">{{ $fasilitas->lokasi }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if($fasilitas->kapasitas)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="icon-box bg-light-success text-success me-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Kapasitas</h5>
                                        <p class="mb-0">{{ $fasilitas->kapasitas }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Deskripsi -->
                        <div class="mb-5">
                            <h4 class="fw-bold border-bottom pb-2 mb-3">Deskripsi Fasilitas</h4>
                            <div class="content">
                                {!! nl2br(e($fasilitas->deskripsi)) !!}
                            </div>
                        </div>
                        
                        <!-- Galeri Terkait -->
                        @if($fasilitasLain->count())
                        <div class="mt-5">
                            <h4 class="fw-bold border-bottom pb-2 mb-3">Fasilitas {{ ucfirst(str_replace('_', ' ', $fasilitas->jenis)) }} Lainnya</h4>
                            <div class="row g-3">
                                @foreach($fasilitasLain as $fasilitas)
                                <div class="col-md-4">
                                    <div class="card h-100 shadow-sm border-0">
                                        <div class="card-img-top" style="height: 150px; overflow: hidden;">
                                            <img src="{{ asset('storage/' . $fasilitas->foto) }}" class="img-fluid w-100 h-100" alt="{{ $fasilitas->nama }}" style="object-fit: cover;">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">{{ Str::limit($fasilitas->nama, 30) }}</h6>
                                            <a href="{{ route('fasilitas.show', $fasilitas) }}" class="stretched-link"></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Tombol Kembali -->
                <div class="text-center mt-4">
                    <a href="{{ route('fasilitas') }}" class="btn btn-outline-success px-4">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Fasilitas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .icon-box {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    
    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }
    
    .breadcrumb-item.active {
        color: #198754;
        font-weight: 500;
    }
    
    .content {
        white-space: pre-line;
    }
</style>
@endpush