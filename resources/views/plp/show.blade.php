@extends('layouts.app')

@section('title', $plp->nama)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ $plp->foto ? asset('storage/' . $plp->foto) : asset('images/default-avatar.png') }}"
                         class="rounded-circle mb-3"
                         width="200"
                         height="200"
                         alt="{{ $plp->nama }}">
                    <h3>{{ $plp->nama }}</h3>
                    <p class="text-muted">{{ $plp->jabatan }}</p>

                    <div class="text-start mt-4">
                        <p><strong>NIP:</strong> {{ $plp->nip ?? '-' }}</p>
                        <p><strong>Bidang Keahlian:</strong> {{ $plp->bidang_keahlian }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ $plp->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $plp->status ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Deskripsi</h4>
                    <div class="mt-3">
                        {!! $plp->deskripsi ?? '<p class="text-muted">Tidak ada deskripsi</p>' !!}
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('plp.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar PLP
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
