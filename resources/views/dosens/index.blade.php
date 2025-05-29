@extends('layouts.app')

@section('title', 'Struktur Dosen dan Staf')

@section('content')
<div class="py-5 bg-light">
    <div class="container mt-5 pt-5">

        <div class="mb-5 text-center">
            <h2 class="fw-bold text-success section-title">Struktur Organisasi Dosen & Staf</h2>
            <p class="text-muted fs-5">Struktur Program Studi Teknologi Produksi Tanaman Pangan</p>
        </div>

        {{-- Kaprodi --}}
        @php
            $kaprodi = $dosens->where('is_kaprodi', true)->first();
            $dosenLain = $dosens->where('is_kaprodi', false);
        @endphp

        @if($kaprodi)
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-success text-white text-center">
                <h5><i class="fas fa-crown me-2"></i>Kaprodi</h5>
            </div>
            <div class="card-body text-center">
                <img src="{{ $kaprodi->foto_url }}" class="rounded-circle border border-3 border-success mb-3" width="120" height="120" style="object-fit: cover;">
                <h4 class="fw-bold mb-1">{{ $kaprodi->nama }}</h4>
                <p class="mb-1 text-muted">{{ $kaprodi->nidn }}</p>
                <p>
                    @foreach($kaprodi->bidang_keahlian_array ?? [] as $bidang)
                        <span class="badge bg-success bg-opacity-10 text-success me-1">{{ $bidang }}</span>
                    @endforeach
                </p>
                <a href="{{ route('dosen.show', $kaprodi) }}" class="btn btn-outline-success btn-sm mt-2">
                    <i class="fas fa-eye me-1"></i>Lihat Detail
                </a>
            </div>
        </div>
        @endif

        {{-- Dosen dan Staf --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light border-bottom border-success">
                <h5 class="mb-0 text-success"><i class="fas fa-users me-2"></i>Dosen & Staf Lainnya</h5>
            </div>
            <div class="card-body">
                @if($dosenLain->count())
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($dosenLain as $dosen)
                    <div class="col">
                        <div class="card h-100 border border-success border-opacity-25 shadow-sm">
                            <div class="card-body text-center">
                                <img src="{{ $dosen->foto_url }}" class="rounded-circle border border-2 border-success mb-3" width="80" height="80" style="object-fit: cover;">
                                <h5 class="fw-bold mb-1">{{ $dosen->nama }}</h5>
                                <p class="text-muted mb-1">{{ $dosen->nidn }}</p>
                                <p class="small">
                                    @foreach(array_slice($dosen->bidang_keahlian_array ?? [], 0, 2) as $bidang)
                                        <span class="badge bg-success bg-opacity-10 text-success me-1">{{ $bidang }}</span>
                                    @endforeach
                                    @if(is_array($dosen->bidang_keahlian_array) && count($dosen->bidang_keahlian_array) > 2)
                                        <span class="badge bg-secondary">+{{ count($dosen->bidang_keahlian_array) - 2 }} lagi</span>
                                    @endif
                                </p>
                                <a href="{{ route('dosen.show', $dosen) }}" class="btn btn-outline-success btn-sm mt-2">
                                    <i class="fas fa-eye me-1"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center p-4">
                    <p class="text-muted"><i class="fas fa-info-circle me-2"></i>Belum ada data dosen/staf</p>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
