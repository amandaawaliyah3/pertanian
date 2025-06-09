@extends('layouts.app')

@section('title', 'Data PLP')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Data Pendamping Lapangan Pertanian (PLP)</h1>

    <div class="row">
        @foreach($plps as $plp)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-img-top text-center py-3">
                    <img src="{{ $plp->foto ? asset('storage/' . $plp->foto) : asset('images/default-avatar.png') }}"
                         class="rounded-circle"
                         width="120"
                         height="120"
                         alt="{{ $plp->nama }}">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $plp->nama }}</h5>
                    <p class="text-muted">{{ $plp->jabatan }}</p>
                    <p><strong>Bidang Keahlian:</strong> {{ $plp->bidang_keahlian }}</p>
                    <a href="{{ route('plp.show', $plp->id) }}" class="btn btn-primary">Lihat Profil</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
