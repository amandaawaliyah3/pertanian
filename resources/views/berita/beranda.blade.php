@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<style>
    /* CSS Utama */
    body {
        padding-top: 70px;
        background-color: #f7f9fa;
        background-image: url('/images/ornamen-kiri.png'), url('/images/ornamen-kanan.png');
        background-position: top left, bottom right;
        background-repeat: no-repeat, no-repeat;
        background-size: 120px, 120px;
    }

    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/gedung pertanian.jpeg');
        background-size: cover;
        background-position: center;
        color: rgb(255, 255, 255);
        padding: 10rem 0;
        position: relative;
        margin-bottom: 5rem;
        min-height: 70vh;
        display: flex;
        align-items: center;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        line-height: 1.6;
    }

    .btn-hero {
        padding: 0.8rem 2rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        margin: 0 10px 10px 0;
    }

    .navbar {
         padding: 1rem 1rem;
         background: linear-gradient(to right,  #2e7d32,  #2e7d32);
}
    .nav-item {
         margin: 0.5rem;
}


    .btn-hero-primary {
        background-color: transparent;
        color: rgb(241, 234, 234);
        border: 2px solid white;
    }

    .btn-hero-primary:hover {
        background-color: white;
        color: var(--dark-color);
    }

    .btn-hero-secondary {
        background-color: transparent;
        color: rgb(241, 234, 234);
        border: 2px solid white;
    }

    .btn-hero-secondary:hover {
        background-color: white;
        color: var(--dark-color);
    }

    .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
    }

    .section-title:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 4px;
        bottom: -8px;
        left: 0;
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        border-radius: 2px;
    }

    /* Info Boxes */
    .info-boxes {
        margin-top: -50px;
        position: relative;
        z-index: 3;
    }

    .info-box {
        background-color: rgb(213, 226, 226);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border-top: 5px solid var(--primary-color);
        margin-bottom: 20px;
    }

    .info-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .info-box-icon {
        font-size: 2rem;
        color: #2e7d32;
        margin-bottom: 1rem;
    }

    .info-box-title {
        font-weight: 600;
        margin-bottom: 0.8rem;
        color: var(--dark-color);
        font-size: 1.1rem;
    }

    .info-box-text {
        font-size: 0.9rem;
        color: #403839;
    }

    /* BERITA */
    .berita-section {
        padding: 3rem 0;
    }

    .berita-card {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
        height: 100%;
    }

    .berita-card:hover {
        transform: translateY(-5px);
    }

    .berita-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .berita-content {
        padding: 1.2rem;
    }

    .berita-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .berita-date {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.8rem;
    }

    .berita-excerpt {
        font-size: 0.9rem;
        color: #495057;
        margin-bottom: 1rem;
    }

    .btn-baca {
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        font-weight: 500;
        padding: 0.4rem 1rem;
        border-radius: 5px;
        transition: all 0.2s ease;
        font-size: 0.9rem;
        display: inline-block;
    }

    .btn-baca:hover {
        background-color: var(--primary-color);
        color: white;
        text-decoration: none;
    }

    /* PRESTASI */
    .prestasi-section {
        padding: 3rem 0;
        background-color: #f8f9fa;
    }

    .prestasi-card {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        height: 100%;
    }

    .prestasi-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .prestasi-content {
        padding: 1.2rem;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 6rem 0;
            min-height: 60vh;
        }

        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .info-boxes {
            margin-top: -30px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">Selamat Datang di Jurusan Pertanian</h1>
            <p class="hero-subtitle">Politeknik Pertanian Negeri Samarinda</p>
            <div class="d-flex flex-wrap justify-content-center">
                <a href="/galeri" class="btn btn-hero btn-hero-primary">Galeri</a>
                <a href="/fasilitas" class="btn btn-hero btn-hero-secondary">Fasilitas</a>
            </div>
        </div>
    </div>
</section>



<!-- BERITA -->
<section class="berita-section">
    <div class="container">
        <h2 class="fw-bold text-center section-title">Berita Terbaru</h2>
        <p class="text-muted text-center mb-4">Ikuti informasi dan kegiatan terkini Jurusan Pertanian.</p>

        <div class="row g-4">
            @foreach ($beritas as $item)
            <div class="col-md-4">
                <div class="berita-card">
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="berita-image" alt="{{ $item->judul }}">
                    <div class="berita-content">
                        <h5 class="berita-title">{{ $item->judul }}</h5>
                        <small class="berita-date">{{ $item->tanggal->format('d M Y') }}</small>
                        <p class="berita-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) }}</p>
                        <a href="{{ route('berita.show', $item->id) }}" class="btn-baca">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



<script>
    // Animasi scroll
    document.addEventListener('DOMContentLoaded', function() {
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.info-box, .berita-card, .prestasi-card');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (elementPosition < windowHeight - 100) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        // Set initial state
        const animatedElements = document.querySelectorAll('.info-box, .berita-card, .prestasi-card');
        animatedElements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Trigger once on load
    });
</script>
@endsection
