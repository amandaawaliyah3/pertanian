@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="py-5 bg-light">
    <div class="container mt-5 pt-5">

        {{-- Judul Halaman --}}
        <div class="mb-5 text-center">
            <h2 class="fw-bold text-success section-title">Data Dosen</h2>
        </div>

        {{-- Dropdown Pilihan Program Studi --}}
        <div class="text-center mb-4">
            <form action="{{ route('dosen.index') }}" method="GET" class="d-inline-block">
                <select name="prodi_id" class="form-select d-inline-block w-auto border-success" onchange="this.form.submit()">
                    <option value="">-- Pilih Program Studi --</option>
                    @foreach($prodis as $prodi)
                        <option value="{{ $prodi->id }}" {{ request('prodi_id') == $prodi->id ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- Kondisi: jika belum memilih prodi --}}
        @if(!$selectedProdi)
            <div class="text-center py-5">
                <i class="fas fa-hand-pointer text-success fa-2x mb-3"></i>
                <h5 class="text-muted">Silakan pilih Program Studi terlebih dahulu</h5>
            </div>
        @else
            {{-- Jika sudah memilih prodi --}}
            @php
                $kaprodi = $dosens->where('is_kaprodi', true)->first();
                $dosenLain = $dosens->where('is_kaprodi', false);
            @endphp

            @if($dosens->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-info-circle text-warning fa-2x mb-3"></i>
                    <h5 class="text-muted">Belum ada data dosen untuk {{ $selectedProdi->nama_prodi }}</h5>
                </div>
            @else
                {{-- Kartu Kaprodi --}}
                @if($kaprodi)
                    <div class="card shadow-sm border-0 mb-5">
                        <div class="card-header bg-success text-white text-center">
                            <h5><i class="fas fa-crown me-2"></i>Kaprodi {{ $selectedProdi->nama_prodi }}</h5>
                        </div>
                        <div class="card-body text-center">
                            <img 
                                src="{{ $kaprodi->foto ? asset('storage/'.$kaprodi->foto) : asset('images/default-avatar.png') }}" 
                                class="rounded-circle border border-3 border-success mb-3" 
                                width="120" height="120" style="object-fit: cover;">
                            <h4 class="fw-bold mb-1">{{ $kaprodi->nama_dosen }}</h4>
                            
                            {{-- ✅ PERBAIKAN: Menampilkan NIP --}}
                            <p class="mb-1 text-muted">{{ $kaprodi->nip ?? '-' }}</p> 
                            
                            <a href="{{ route('dosen.show', $kaprodi) }}" class="btn btn-outline-success btn-sm mt-2">
                                <i class="fas fa-eye me-1"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                @endif

                {{-- Daftar Dosen Lain --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light border-bottom border-success">
                        <h5 class="mb-0 text-success">
                            <i class="fas fa-users me-2"></i>
                            Dosen {{ $selectedProdi->nama_prodi }}
                        </h5>
                    </div>

                    <div class="card-body">
                        @if($dosenLain->isEmpty())
                            <div class="text-center py-5 text-muted">
                                Belum ada dosen selain Kaprodi untuk {{ $selectedProdi->nama_prodi }}.
                            </div>
                        @else
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                @foreach($dosenLain as $dosen)
                                    <div class="col">
                                        <div class="card h-100 border border-success border-opacity-25 shadow-sm">
                                            <div class="card-body text-center">
                                                <img 
                                                    src="{{ $dosen->foto ? asset('storage/'.$dosen->foto) : asset('images/default-avatar.png') }}" 
                                                    class="rounded-circle border border-2 border-success mb-3" 
                                                    width="80" height="80" style="object-fit: cover;">
                                                <h5 class="fw-bold mb-1">{{ $dosen->nama_dosen }}</h5>
                                                
                                                {{-- ✅ PERBAIKAN: Menampilkan NIP --}}
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
                    </div>
                </div>
            @endif
        @endif

    </div>
</div>
@endsection