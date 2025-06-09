@extends('layouts.app')

@section('title', $prestasi->judul ?? 'Detail Prestasi')

@section('content')
<style>
    .prestasi-hero {
        background: linear-gradient(135deg, rgba(25,135,84,0.1) 0%, rgba(25,135,84,0.05) 100%);
        padding: 80px 0 40px;
        margin-bottom: 60px;
    }

    .prestasi-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .prestasi-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .prestasi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }

    .prestasi-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        object-position: center;
    }

    .prestasi-body {
        padding: 40px;
    }

    .prestasi-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #198754;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .prestasi-meta {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        color: #6c757d;
    }

    .prestasi-meta i {
        margin-right: 8px;
        color: #198754;
    }

    .prestasi-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #495057;
    }

    .prestasi-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 25px 0;
    }

    .btn-kembali {
        background-color: #198754;
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 500;
        margin-top: 40px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-kembali:hover {
        background-color: #157347;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(25,135,84,0.3);
    }

    .btn-kembali i {
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .prestasi-hero {
            padding: 60px 0 30px;
        }

        .prestasi-image {
            height: 250px;
        }

        .prestasi-body {
            padding: 30px;
        }

        .prestasi-title {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="prestasi-hero">
    <div class="container text-center">
        <h1 class="display-5 fw-bold text-success mb-3">Detail Prestasi</h1>
        <p class="lead text-muted">Prestasi membanggakan dari mahasiswa Jurusan Pertanian</p>
    </div>
</section>

<!-- Main Content -->
<div class="container prestasi-container">
    <div class="prestasi-card">
        @if($prestasi->gambar)
        <img src="{{ asset('storage/' . $prestasi->gambar) }}"
             class="prestasi-image"
             alt="{{ $prestasi->judul }}">
        @endif

        <div class="prestasi-body">
            <h2 class="prestasi-title">{{ $prestasi->judul }}</h2>

            <div class="prestasi-meta">
                <i class="fas fa-calendar-alt"></i>
                <span>
                    @if($prestasi->created_at)
                        {{ $prestasi->created_at->format('d F Y') }}
                    @else
                        Tanggal tidak tersedia
                    @endif
                </span>
            </div>

            <div class="prestasi-content">
                {!! $prestasi->deskripsi !!}
            </div>

            <a href="{{ route('beranda') }}" class="btn btn-kembali">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<!-- Related Prestasi Section -->
@if(isset($relatedPrestasi) && $relatedPrestasi->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-success">Prestasi Lainnya</h2>

        <div class="row g-4">
            @foreach($relatedPrestasi as $item)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}"
                         class="card-img-top"
                         alt="{{ $item->judul }}"
                         style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text text-muted small">
                            <i class="fas fa-calendar-alt me-1"></i>
                            @if($item->created_at)
                                {{ $item->created_at->format('d M Y') }}
                            @endif
                        </p>
                        <p class="card-text mt-2">
                            {{ Str::limit(strip_tags($item->deskripsi), 100) }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('prestasi.show', $item->id) }}"
                           class="btn btn-sm btn-outline-success">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
    // Animation for content
    document.addEventListener('DOMContentLoaded', function() {
        const content = document.querySelector('.prestasi-content');
        if(content) {
            content.style.opacity = '0';
            content.style.transform = 'translateY(20px)';
            content.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

            setTimeout(() => {
                content.style.opacity = '1';
                content.style.transform = 'translateY(0)';
            }, 200);
        }
    });
</script>
@endsection
