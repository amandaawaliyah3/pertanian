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
        color: white;
        padding: 8rem 0;
        position: relative;
        margin-bottom: 2rem;
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

    .btn-hero-primary {
        background-color: var(--accent-color);
        color: var(--dark-color);
        border: 2px solid var(--accent-color);
    }

    .btn-hero-primary:hover {
        background-color: transparent;
        color: var(--accent-color);
    }

    .btn-hero-secondary {
        background-color: transparent;
        color: white;
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
        background-color: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border-top: 3px solid var(--primary-color);
        margin-bottom: 20px;
    }

    .info-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .info-box-icon {
        font-size: 2rem;
        color: var(--primary-color);
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
        color: #6c757d;
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
                <a href="/berita" class="btn btn-hero btn-hero-primary">Seputar Kampus</a>
                <a href="/fasilitas" class="btn btn-hero btn-hero-secondary">Fasilitas</a>
            </div>
        </div>
    </div>
</section>

<!-- Info Boxes -->
<div class="container info-boxes">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="info-box">
                <div class="info-box-icon text-center">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h4 class="info-box-title text-center">Akreditasi</h4>
                <p class="info-box-text text-center">Jurusan Pertanian kami telah terakreditasi oleh BAN-PT dengan standar pendidikan tinggi yang berkualitas.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <div class="info-box-icon text-center">
                    <i class="fas fa-flask"></i>
                </div>
                <h4 class="info-box-title text-center">Laboratorium Modern</h4>
                <p class="info-box-text text-center">Didukung dengan fasilitas laboratorium modern untuk mendukung proses belajar mengajar dan penelitian.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <div class="info-box-icon text-center">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4 class="info-box-title text-center">Kerjasama Industri</h4>
                <p class="info-box-text text-center">Bekerjasama dengan berbagai industri dan instansi untuk pengembangan kompetensi mahasiswa.</p>
            </div>
        </div>
    </div>
</div>

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
                        <small class="berita-date">{{ $item->created_at->format('d M Y') }}</small>
                        <p class="berita-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) }}</p>
                        <a href="{{ route('berita.show', $item->id) }}" class="btn-baca">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if ($prestasis->count())
<!-- PRESTASI -->
<section class="prestasi-section">
    <div class="container">
        <h2 class="fw-bold text-center section-title">Prestasi Mahasiswa</h2>
        <p class="text-muted text-center mb-4">Prestasi-prestasi membanggakan yang telah diraih oleh mahasiswa Jurusan Pertanian.</p>

        <div class="row g-4">
            @foreach ($prestasis as $prestasi)
            <div class="col-md-4">
                <div class="prestasi-card">
                    <img src="{{ asset('storage/' . $prestasi->gambar) }}" class="prestasi-image" alt="{{ $prestasi->nama }}">
                    <div class="prestasi-content">
                        <h5 class="berita-title">{{ $prestasi->nama }}</h5>
                        <small class="berita-date">{{ \Carbon\Carbon::parse($prestasi->created_at)->format('d M Y') }}</small>
                        <p class="berita-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($prestasi->deskripsi), 100) }}</p>
                        <a href="{{ route('prestasi.show', $prestasi->id) }}" class="btn-baca">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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
