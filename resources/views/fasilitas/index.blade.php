@extends('layouts.app')

@section('title', 'Fasilitas TPTP')

@section('content')
<div class="py-5 bg-light">
    <div class="container mt-5 pt-5">
        <h2 class="fw-bold text-success text-center section-title">Fasilitas Program Studi</h2>
        <p class="text-muted fs-5 text-center mb-5">Fasilitas penunjang pembelajaran di Program Studi Teknologi Produksi Tanaman Pangan</p>
        
        @php
            $fasilitasGroups = [
                'laboratorium' => [
                    'title' => 'Laboratorium',
                    'data' => $fasilitas->where('jenis', 'laboratorium'),
                    'icon' => 'flask'
                ],
                'greenhouse' => [
                    'title' => 'Greenhouse',
                    'data' => $fasilitas->where('jenis', 'greenhouse'),
                    'icon' => 'leaf'
                ],
                'lahan_praktikum' => [
                    'title' => 'Lahan Praktikum',
                    'data' => $fasilitas->where('jenis', 'lahan_praktikum'),
                    'icon' => 'tractor'
                ],
                'ruang_kelas' => [
                    'title' => 'Ruang Kelas',
                    'data' => $fasilitas->where('jenis', 'ruang_kelas'),
                    'icon' => 'chalkboard-teacher'
                ],
                'lainnya' => [
                    'title' => 'Fasilitas Lainnya',
                    'data' => $fasilitas->whereNotIn('jenis', ['laboratorium', 'greenhouse', 'lahan_praktikum', 'ruang_kelas']),
                    'icon' => 'tools'
                ]
            ];
        @endphp

        @foreach($fasilitasGroups as $key => $group)
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">
                    <i class="fas fa-{{ $group['icon'] }} me-2 text-success"></i>
                    {{ $group['title'] }}
                </h4>
                @if($group['data']->count() > 3)
                <a href="#" class="btn btn-sm btn-outline-success">
                    Lihat Semua
                </a>
                @endif
            </div>
            
            @if($group['data']->count())
            <div class="row g-4">
                @foreach($group['data']->take(6) as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-img-top position-relative" style="height: 200px; overflow: hidden;">
                            <img src="{{ $item->foto_url }}" 
                                 class="img-fluid w-100 h-100" 
                                 alt="{{ $item->nama }}" 
                                 style="object-fit: cover;"
                                 onerror="this.onerror=null;this.src='{{ asset('images/default-fasilitas.jpg') }}'">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-success bg-opacity-75">
                                    {{ $item->jenis_label }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($item->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($item->lokasi)
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt me-1"></i> 
                                    {{ $item->lokasi }}
                                </small>
                                @endif
                                @if($item->kapasitas)
                                <small class="text-muted">
                                    <i class="fas fa-users me-1"></i> 
                                    {{ $item->kapasitas }} orang
                                </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> 
                Belum ada data {{ strtolower($group['title']) }} yang tersedia
            </div>
            @endif
        </div>
        @endforeach
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
        left: 25%;
        background: linear-gradient(to right, #198754, #25b56b);
        border-radius: 2px;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(25, 135, 84, 0.15);
    }
    
    .card-img-top {
        transition: transform 0.5s ease;
    }
    
    .card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .badge {
        font-weight: 500;
        font-size: 0.75rem;
    }
</style>
@endpush