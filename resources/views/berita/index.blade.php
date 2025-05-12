@extends('layouts.app')

@section('title', 'Daftar Berita')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold text-success mb-4">Semua Berita</h2>

  <div class="row">
    @foreach ($berita as $item)
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $item->judul }}</h5>
            <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) }}</p>
            <a href="{{ route('berita.show', $item->id) }}" class="btn btn-sm btn-outline-success mt-auto">Baca Selengkapnya</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-4">
    {{ $berita->links() }}
  </div>
</div>
@endsection
