@extends('layouts.app')

@section('title', 'Data PLP')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold">Data Pendamping Lapangan Pertanian (PLP)</h1>

    {{-- ✅ FIX 1: Pemusatan Kartu (justify-content-center) --}}
    <div class="row justify-content-center"> 
        @foreach($plps as $plp)
        <div class="col-md-4 mb-4">
            {{-- ✅ FIX 2: Menambahkan Border yang Jelas --}}
            <div class="card h-100 shadow-sm border border-success border-opacity-50">
                <div class="card-img-top text-center py-3">
                    <img src="{{ $plp->foto ? asset('storage/' . $plp->foto) : asset('images/default-avatar.png') }}"
                         class="rounded-circle border border-success border-opacity-75"
                         width="120"
                         height="120"
                         alt="{{ $plp->nama }}"
                         style="object-fit: cover;"> 
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $plp->nama }}</h5>
                    <p class="text-muted">{{ $plp->jabatan }}</p>
                    <p><strong>Bidang Keahlian:</strong> {{ $plp->bidang_keahlian }}</p>
                    <a href="{{ route('plp.show', $plp->id) }}" class="btn btn-success">Lihat Profil</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection