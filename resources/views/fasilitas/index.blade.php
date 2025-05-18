@extends('layouts.app')

@section('title', 'Fasilitas TPTP')

@section('content')
<div class="py-5 bg-light">
    <div class="container mt-5 pt-5">
        <h2 class="fw-bold text-success text-center section-title">Fasilitas Program Studi</h2>
        <p class="text-muted fs-5 text-center mb-5">Fasilitas penunjang pembelajaran di Program Studi Teknologi Produksi Tanaman Pangan</p>
        
        <!-- Laboratorium -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Laboratorium</h4>
                <a href="{{ route('fasilitas') }}?jenis=laboratorium" class="btn btn-sm btn-outline-success">Lihat Semua</a>
            </div>
            
            @if($laboratorium->count())
            <div class="row g-4">
                @foreach($laboratorium as $lab)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-img-top" style="height: 200px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $lab->foto) }}" class="img-fluid w-100 h-100" alt="{{ $lab->nama }}" style="object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $lab->nama }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($lab->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($lab->lokasi)
                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ $lab->lokasi }}</small>
                                @endif
                                @if($lab->kapasitas)
                                <small class="text-muted"><i class="fas fa-users me-1"></i> {{ $lab->kapasitas }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('fasilitas.show', $lab) }}" class="btn btn-outline-success btn-sm">Detail Fasilitas</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Belum ada data laboratorium yang tersedia
            </div>
            @endif
        </div>
        
        <!-- Greenhouse -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Greenhouse</h4>
                <a href="{{ route('fasilitas') }}?jenis=greenhouse" class="btn btn-sm btn-outline-success">Lihat Semua</a>
            </div>
            
            @if($greenhouse->count())
            <div class="row g-4">
                @foreach($greenhouse as $gh)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-img-top" style="height: 200px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $gh->foto) }}" class="img-fluid w-100 h-100" alt="{{ $gh->nama }}" style="object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $gh->nama }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($gh->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($gh->lokasi)
                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ $gh->lokasi }}</small>
                                @endif
                                @if($gh->kapasitas)
                                <small class="text-muted"><i class="fas fa-users me-1"></i> {{ $gh->kapasitas }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('fasilitas.show', $gh) }}" class="btn btn-outline-success btn-sm">Detail Fasilitas</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Belum ada data greenhouse yang tersedia
            </div>
            @endif
        </div>
        
        <!-- Lahan Praktikum -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Lahan Praktikum</h4>
                <a href="{{ route('fasilitas') }}?jenis=lahan_praktikum" class="btn btn-sm btn-outline-success">Lihat Semua</a>
            </div>
            
            @if($lahanPraktikum->count())
            <div class="row g-4">
                @foreach($lahanPraktikum as $lh)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-img-top" style="height: 200px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $lh->foto) }}" class="img-fluid w-100 h-100" alt="{{ $lh->nama }}" style="object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $lh->nama }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($lh->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($lh->lokasi)
                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ $lh->lokasi }}</small>
                                @endif
                                @if($lh->kapasitas)
                                <small class="text-muted"><i class="fas fa-users me-1"></i> {{ $lh->kapasitas }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('fasilitas.show', $lh) }}" class="btn btn-outline-success btn-sm">Detail Fasilitas</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Belum ada data lahan praktikum yang tersedia
            </div>
            @endif
        </div>
        
        <!-- Ruang Kelas -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Ruang Kelas</h4>
                <a href="{{ route('fasilitas') }}?jenis=ruang_kelas" class="btn btn-sm btn-outline-success">Lihat Semua</a>
            </div>
            
            @if($ruangKelas->count())
            <div class="row g-4">
                @foreach($ruangKelas as $rk)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-img-top" style="height: 200px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $rk->foto) }}" class="img-fluid w-100 h-100" alt="{{ $rk->nama }}" style="object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $rk->nama }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($rk->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($rk->lokasi)
                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ $rk->lokasi }}</small>
                                @endif
                                @if($rk->kapasitas)
                                <small class="text-muted"><i class="fas fa-users me-1"></i> {{ $rk->kapasitas }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('fasilitas.show', $rk) }}" class="btn btn-outline-success btn-sm">Detail Fasilitas</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Belum ada data ruang kelas yang tersedia
            </div>
            @endif
        </div>
        
        <!-- Fasilitas Lainnya -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Fasilitas Lainnya</h4>
                <a href="{{ route('fasilitas') }}?jenis=lainnya" class="btn btn-sm btn-outline-success">Lihat Semua</a>
            </div>
            
            @if($lainnya->count())
            <div class="row g-4">
                @foreach($lainnya as $lain)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-img-top" style="height: 200px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $lain->foto) }}" class="img-fluid w-100 h-100" alt="{{ $lain->nama }}" style="object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $lain->nama }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($lain->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($lain->lokasi)
                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ $lain->lokasi }}</small>
                                @endif
                                @if($lain->kapasitas)
                                <small class="text-muted"><i class="fas fa-users me-1"></i> {{ $lain->kapasitas }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('fasilitas.show', $lain) }}" class="btn btn-outline-success btn-sm">Detail Fasilitas</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Belum ada data fasilitas lainnya yang tersedia
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .section-title {
        position: relative;
        display: inline-block;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 4px;
        bottom: -10px;
        left: 0;
        background: linear-gradient(to right, #198754, #25b56b);
        border-radius: 2px;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush