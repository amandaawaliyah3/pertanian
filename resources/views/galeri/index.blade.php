@extends('layouts.app')

@section('title', 'Galeri Kegiatan pertanian')

@section('content')
<style>
    .galeri-container {
        margin-top: 100px; /* agar tidak ketutupan navbar */
    }
    .gallery-card {
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
    }
    .gallery-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .badge-kategori {
        background-color: #198754;
        color: white;
        font-size: 0.75rem;
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        text-transform: capitalize;
    }
    .card-body {
        min-height: 130px;
        display: flex;
        flex-direction: column;
    }
    .card-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.4rem;
        flex-grow: 1;
    }
    .card-text {
        font-size: 0.9rem;
        color: #555;
        line-height: 1.3;
    }
    .tanggal {
        font-size: 0.85rem;
        color: #888;
        margin-top: auto;
    }
    .search-filter-form input[type="text"],
    .search-filter-form select {
        border-radius: 30px;
        border: 1px solid #ced4da;
        padding: 0.5rem 1rem;
        height: 38px;
    }
    .search-filter-form button {
        border-radius: 30px;
        padding: 0.4rem 1.5rem;
    }
</style>

<div class="container galeri-container">
    <h1 class="mb-4 text-center">Galeri Kegiatan</h1>

    <!-- Search and Filter -->
    <form method="GET" class="row g-2 mb-4 search-filter-form justify-content-center">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari judul kegiatan..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">Semua Kategori</option>
                <option value="seminar" {{ request('kategori') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                <option value="lomba" {{ request('kategori') == 'lomba' ? 'selected' : '' }}>Lomba</option>
                <option value="praktikum" {{ request('kategori') == 'praktikum' ? 'selected' : '' }}>Praktikum</option>
                <option value="sosialisasi" {{ request('kategori') == 'sosialisasi' ? 'selected' : '' }}>Sosialisasi</option>
                <option value="workshop" {{ request('kategori') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-success">Filter</button>
        </div>
    </form>

    @if($galeris->count() > 0)
    <div class="row g-4">
        @foreach($galeris as $galeri)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card gallery-card h-100">
                <a href="{{ route('galeri.show', $galeri->id) }}" class="text-decoration-none text-dark">
                    <img
                        src="{{ $galeri->foto_url }}"
                        alt="{{ $galeri->judul }}"
                        class="gallery-image"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='{{ asset('storage/galeri/default-gallery.jpg') }}'">
                    <div class="card-body d-flex flex-column">
                        <span class="badge-kategori mb-2">{{ $galeri->kategori }}</span>
                        <h5 class="card-title">{{ $galeri->judul }}</h5>
                        <p class="card-text text-truncate" style="max-height: 3rem;">
                            {{ Str::limit($galeri->deskripsi, 80) }}
                        </p>
                        <p class="tanggal mt-auto">
                            <i class="far fa-calendar-alt me-1"></i> {{ $galeri->tanggal_formatted }}
                        </p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $galeris->withQueryString()->links() }}
    </div>
    @else
    <div class="alert alert-info text-center mt-5">
        <i class="fas fa-image fa-3x mb-3 text-muted"></i>
        <h4>Belum ada galeri tersedia</h4>
        <p>Silakan coba lagi nanti atau hubungi admin.</p>
        <a href="{{ route('galeri.index') }}" class="btn btn-success">Muat Ulang Halaman</a>
    </div>
    @endif
</div>
@endsection
