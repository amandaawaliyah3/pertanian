@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Data Administrasi</h2>

    <div class="row justify-content-center">
        @forelse ($data as $item)
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm border-0 rounded-4 p-3">
                    <div class="card-body">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                alt="{{ $item->nama }}"
                                class="rounded-circle mb-3 shadow-sm"
                                style="width:120px; height:120px; object-fit:cover;">
                        @else
                            <img src="{{ asset('images/default.png') }}"
                                alt="default"
                                class="rounded-circle mb-3 shadow-sm"
                                style="width:120px; height:120px; object-fit:cover;">
                        @endif

                        <h5 class="fw-bold mb-1">{{ $item->nama }}</h5>
                        <p class="text-muted mb-1">{{ $item->nip ?? '-' }}</p>
                        <p class="mb-2"><strong>Bidang:</strong> {{ $item->bidang ?? '-' }}</p>

                        <a href="{{ route('administrasi.show', $item->id) }}" class="btn btn-primary btn-sm mt-2">
                            Lihat Profil
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data administrasi.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
