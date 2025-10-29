@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="py-5 bg-light">
    <div class="container mt-5 pt-5">

        <div class="mb-5 text-center">
            <h2 class="fw-bold text-success section-title">Data Dosen</h2>
        </div>

        
        {{-- ================================================= --}}
        {{-- VERTICAL TABS LAYOUT (MAIN ROW) --}}
        {{-- ================================================= --}}
        <div class="row">
            
            {{-- 1. KOLOM KIRI: NAVIGASI PROGRAM STUDI (25%) --}}
            <div class="col-md-3 mb-4">
                <div class="card shadow-lg border-0 rounded-4 p-3 bg-white">
                    {{-- Judul Navigasi --}}
                    <h5 class="fw-bold text-success mb-3 border-bottom pb-2">
                        <i class="fas fa-sitemap me-2"></i>Pilih Program Studi
                    </h5>
                    
                    {{-- Navigasi Vertikal (Pills) --}}
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach($prodis as $prodi)
                            @php
                                $isActive = $prodi->id == $activeProdiId;
                            @endphp
                            <a class="nav-link text-start rounded-pill mb-1 {{ $isActive ? 'active bg-success text-white' : 'text-success' }}"
                                href="{{ route('dosen.index', ['prodi_id' => $prodi->id]) }}"
                                role="tab"
                                style="font-size: 0.9rem;"
                            >
                                {{ $prodi->nama_prodi }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- 2. KOLOM KANAN: KONTEN DOSEN (75%) --}}
            <div class="col-md-9">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    
                    @php
                        $activeProdi = $prodis->firstWhere('id', $activeProdiId);
                        $dosens = $activeProdi->dosens ?? collect();
                        $kaprodi = $dosens->where('is_kaprodi', true)->first();
                        $dosenLain = $dosens->where('is_kaprodi', false);
                    @endphp

                    @if(!$activeProdi || $prodis->isEmpty())
                        {{-- State Jika Tidak Ada Data atau Prodi --}}
                        <div class="text-center py-5">
                            <i class="fas fa-hand-pointer text-success fa-2x mb-3"></i>
                            <h5 class="text-muted">Silakan pilih Program Studi dari panel di samping.</h5>
                        </div>
                    @else
                        {{-- Header Prodi Aktif --}}
                        <h4 class="fw-bold text-success border-bottom pb-2 mb-4">
                            <i class="fas fa-user-friends me-2"></i>Dosen {{ $activeProdi->nama_prodi }}
                        </h4>

                        @if($dosens->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-info-circle text-warning fa-2x mb-3"></i>
                                <h5 class="text-muted">Belum ada data dosen untuk {{ $activeProdi->nama_prodi }}</h5>
                            </div>
                        @else
                            
                            {{-- KARTU KAPRODI --}}
                            @if($kaprodi)
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="fas fa-crown me-2"></i>Ketua Program Studi
                                </h5>
                                <div class="card mb-5 mx-auto border-success border-3 rounded-4" style="max-width: 400px;">
                                    <div class="card-body text-center">
                                        <img 
                                            src="{{ $kaprodi->foto ? asset('storage/'.$kaprodi->foto) : asset('images/default-avatar.png') }}" 
                                            class="rounded-circle border border-3 border-success mb-3" 
                                            width="120" height="120" style="object-fit: cover;">
                                        <h4 class="fw-bold mb-1">{{ $kaprodi->nama_dosen }}</h4>
                                        <p class="mb-1 text-muted">{{ $kaprodi->jabatan ?? 'Kaprodi' }}</p> 
                                        <p class="mb-1 text-muted">{{ $kaprodi->nip ?? '-' }}</p> 
                                        <a href="{{ route('dosen.show', $kaprodi) }}" class="btn btn-success btn-sm mt-2">
                                            <i class="fas fa-eye me-1"></i>Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if($dosenLain->isNotEmpty())                                
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-start">
                                    @foreach($dosenLain as $dosen)
                                        <div class="col">
                                            <div class="card h-100 border border-success border-opacity-25 shadow-sm rounded-3">
                                                <div class="card-body text-center">
                                                    <img 
                                                        src="{{ $dosen->foto ? asset('storage/'.$dosen->foto) : asset('images/default-avatar.png') }}" 
                                                        class="rounded-circle border border-2 border-success mb-3" 
                                                        width="80" height="80" style="object-fit: cover;">
                                                    <h5 class="fw-bold mb-1">{{ $dosen->nama_dosen }}</h5>
                                                    
                                                    <p class="text-muted mb-1">{{ $dosen->jabatan ?? '-' }}</p> 
                                                    <p class="text-muted mb-1">{{ $dosen->nip ?? '-' }}</p> 
                                                    <a href="{{ route('dosen.show', $dosen) }}" class="btn btn-outline-success btn-sm mt-2">
                                                        <i class="fas fa-eye me-1"></i>Lihat Detail
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            
                            @if($kaprodi === null && $dosenLain->isEmpty())
                                <div class="text-center py-5 text-muted">Belum ada data dosen yang terdaftar.</div>
                            @endif
                        @endif
                    @endif
                </div>
            </div>

        </div>

    </div>
</div>
@endsection