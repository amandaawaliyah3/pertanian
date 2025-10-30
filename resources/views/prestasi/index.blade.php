@extends('layouts.app')

@section('title', 'Daftar Prestasi')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4 text-success fw-bold">Daftar Prestasi</h1>

    <div class="row g-4">
        @forelse($prestasi as $item)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title fw-semibold">{{ $item->judul }}</h5>
                    <p class="text-muted small">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ $item->created_at->format('d M Y') }}
                    </p>
                    <p>{{ Str::limit(strip_tags($item->deskripsi), 100) }}</p>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('prestasi.show', $item->id) }}" class="btn btn-sm btn-outline-success">Lihat Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="text-muted">Belum ada data prestasi.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $prestasi->links() }} {{-- pagination --}}
    </div>
</div>
@endsection
