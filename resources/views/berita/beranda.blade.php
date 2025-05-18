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
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 6rem 0;
        position: relative;
        margin-bottom: 3rem;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero-title {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 2rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }
    
    .btn-hero {
        padding: 0.8rem 2rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
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
        margin-bottom: 2.5rem;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 4px;
        bottom: -10px;
        left: 0;
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        border-radius: 2px;
    }

    /* BERITA dengan scroll otomatis */
    .scroll-container {
        display: flex;
        overflow-x: hidden;
        padding-bottom: 1rem;
        position: relative;
    }
    
    .berita-wrapper {
        display: flex;
        gap: 2rem;
        transition: transform 1s ease-in-out;
        will-change: transform;
    }
    
    .berita-item {
        flex: 0 0 auto;
        width: 950px;
        background-color: #fff;
        border-left: 8px solid var(--primary-color);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        display: flex;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .berita-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }
    
    .berita-image {
        width: 45%;
        object-fit: cover;
        height: 320px;
        transition: transform 0.5s ease;
    }
    
    .berita-item:hover .berita-image {
        transform: scale(1.03);
    }
    
    .berita-content {
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .btn-baca {
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        font-weight: 600;
        padding: 0.6rem 1.2rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
        width: fit-content;
        font-size: 1rem;
    }
    
    .btn-baca:hover {
        background-color: var(--primary-color);
        color: white;
    }

    /* PRESTASI */
    .prestasi-wrapper {
        height: 480px;
        border-left: 8px solid var(--primary-color);
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
        overflow: hidden;
        display: flex;
        position: relative;
    }
    
    .prestasi-deskripsi {
        width: 50%;
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #fff;
        z-index: 2;
    }
    
    .prestasi-gambar {
        width: 50%;
        position: relative;
        overflow: hidden;
    }
    
    .prestasi-slide {
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .prestasi-slide.active {
        opacity: 1;
        z-index: 1;
    }

    .btn-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.8);
        border: none;
        width: 40px;
        height: 40px;
        padding: 0;
        border-radius: 50%;
        font-size: 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 3;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    
    .btn-nav:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
    }
    
    .btn-nav.left {
        left: 15px;
    }
    
    .btn-nav.right {
        right: 15px;
    }

    /* Info Boxes */
    .info-box {
        background-color: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border-top: 4px solid var(--primary-color);
    }
    
    .info-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .info-box-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }
    
    .info-box-title {
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--dark-color);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }
        
        .berita-wrapper {
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .berita-item {
            width: 100%;
            flex-direction: column;
        }
        
        .berita-image {
            width: 100%;
            height: 200px;
        }
        
        .prestasi-wrapper {
            flex-direction: column;
            height: auto;
        }
        
        .prestasi-deskripsi, .prestasi-gambar {
            width: 100%;
        }
        
        .prestasi-deskripsi {
            padding: 2rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Teknologi Produksi Tanaman Pangan</h1>
            <p class="hero-subtitle">Menyiapkan ahli di bidang teknologi produksi tanaman pangan yang kompeten, inovatif, dan berdaya saing global untuk mendukung ketahanan pangan nasional.</p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="/profil" class="btn btn-hero btn-hero-primary">Program Studi</a>
                <a href="/galeri" class="btn btn-hero btn-hero-secondary">Galeri</a>
            </div>
        </div>
    </div>
</section>

<!-- Info Boxes -->
<div class="container mb-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="info-box">
                <div class="info-box-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h4 class="info-box-title">Akreditasi Terakreditasi B</h4>
                <p class="text-muted">Program studi kami telah terakreditasi B oleh BAN-PT dengan standar pendidikan tinggi yang berkualitas.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <div class="info-box-icon">
                    <i class="fas fa-flask"></i>
                </div>
                <h4 class="info-box-title">Laboratorium Modern</h4>
                <p class="text-muted">Didukung dengan fasilitas laboratorium modern untuk mendukung proses belajar mengajar dan penelitian.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <div class="info-box-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4 class="info-box-title">Kerjasama Industri</h4>
                <p class="text-muted">Bekerjasama dengan berbagai industri dan instansi untuk pengembangan kompetensi mahasiswa.</p>
            </div>
        </div>
    </div>
</div>

<!-- BERITA dengan Scroll Otomatis -->
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold text-success text-center section-title">Berita Terbaru</h2>
        <p class="text-muted fs-5 text-center mb-5">Ikuti informasi dan kegiatan terkini Program Studi Teknologi Produksi Tanaman Pangan.</p>
        
        <div class="scroll-container">
            <div class="berita-wrapper" id="beritaWrapper">
                @foreach ($beritas as $item)
                <div class="berita-item">
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="berita-image" alt="{{ $item->judul }}">
                    <div class="berita-content">
                        <div>
                            <h5 class="text-dark">{{ $item->judul }}</h5>
                            <small class="text-muted d-block mb-3">{{ $item->created_at->format('d M Y') }}</small>
                            <p class="text-muted fs-6">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 180) }}</p>
                        </div>
                        <a href="{{ route('berita.show', $item->id) }}" class="btn btn-baca mt-4">Baca Selengkapnya</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@if ($prestasis->count())
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-success text-center section-title">Prestasi Mahasiswa</h2>
        <p class="text-muted fs-5 text-center mb-5">Prestasi-prestasi membanggakan yang telah diraih oleh mahasiswa Program Studi TPTP.</p>
        
        <div class="prestasi-wrapper">
            <div class="prestasi-deskripsi">
                <h4 id="judulPrestasi" class="text-primary fw-bold">{{ $prestasis[0]->nama }}</h4>
                <small id="tglPrestasi" class="text-muted mb-3">{{ \Carbon\Carbon::parse($prestasis[0]->created_at)->format('d M Y') }}</small>
                <p id="descPrestasi" class="text-secondary fs-6">{{ \Illuminate\Support\Str::limit(strip_tags($prestasis[0]->deskripsi), 200) }}</p>
                <a href="{{ route('prestasi.show', $prestasis[0]->id) }}" class="btn btn-baca mt-3">Lihat Selengkapnya</a>
            </div>
            <div class="prestasi-gambar">
                @foreach ($prestasis as $key => $prestasi)
                    <img src="{{ asset('storage/' . $prestasi->gambar) }}"
                         class="prestasi-slide {{ $key === 0 ? 'active' : '' }}"
                         data-judul="{{ $prestasi->nama }}"
                         data-tanggal="{{ \Carbon\Carbon::parse($prestasi->created_at)->format('d M Y') }}"
                         data-deskripsi="{{ strip_tags($prestasi->deskripsi) }}"
                         data-id="{{ $prestasi->id }}">
                @endforeach
                <button class="btn-nav left" onclick="prevPrestasi()"><i class="fas fa-chevron-left text-success"></i></button>
                <button class="btn-nav right" onclick="nextPrestasi()"><i class="fas fa-chevron-right text-success"></i></button>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Video Profil -->
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold text-success text-center section-title">Profil Program Studi</h2>
        <p class="text-muted fs-5 text-center mb-5">Kenali lebih dekat Program Studi Teknologi Produksi Tanaman Pangan melalui video profil kami.</p>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow">
                    <iframe src="https://www.youtube.com/embed/VIDEO_ID" title="Profil TPTP" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Auto-scroll berita yang halus
    const beritaWrapper = document.getElementById('beritaWrapper');
    const beritaItems = document.querySelectorAll('.berita-item');
    let currentPosition = 0;
    let scrollInterval;
    const scrollSpeed = 3;
    const pauseDuration = 1000;
    let isScrolling = true;

    function startAutoScroll() {
        const itemWidth = beritaItems[0].offsetWidth + 32; // Lebar item + gap
        const maxScroll = itemWidth * beritaItems.length - beritaWrapper.parentElement.offsetWidth;
        
        function scrollStep() {
            if (!isScrolling) return;
            
            currentPosition += scrollSpeed;
            
            if (currentPosition >= maxScroll) {
                clearInterval(scrollInterval);
                setTimeout(() => {
                    currentPosition = 0;
                    beritaWrapper.style.transition = 'none';
                    beritaWrapper.style.transform = `translateX(0)`;
                    void beritaWrapper.offsetWidth; // Trigger reflow
                    beritaWrapper.style.transition = 'transform 1s ease-in-out';
                    startAutoScroll();
                }, pauseDuration);
                return;
            }
            
            beritaWrapper.style.transform = `translateX(-${currentPosition}px)`;
        }
        
        scrollInterval = setInterval(scrollStep, 16);
    }

    // Mulai scroll otomatis
    startAutoScroll();

    // Jeda saat hover
    beritaWrapper.addEventListener('mouseenter', () => {
        isScrolling = false;
    });

    // Lanjutkan saat mouse leave
    beritaWrapper.addEventListener('mouseleave', () => {
        isScrolling = true;
    });

    // Slider Prestasi
    const slides = document.querySelectorAll('.prestasi-slide');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            if (i === index) {
                slide.classList.add('active');
                document.getElementById('judulPrestasi').textContent = slide.dataset.judul;
                document.getElementById('tglPrestasi').textContent = slide.dataset.tanggal;
                document.getElementById('descPrestasi').textContent = slide.dataset.deskripsi.substring(0, 200) + (slide.dataset.deskripsi.length > 200 ? '...' : '');
                document.querySelector('.prestasi-deskripsi a').href = `/prestasi/${slide.dataset.id}`;
            }
        });
    }

    function nextPrestasi() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevPrestasi() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // Auto slide setiap 5 detik
    setInterval(nextPrestasi, 5000);
    
    // Animasi scroll
    document.addEventListener('DOMContentLoaded', function() {
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.info-box, .berita-item, .prestasi-wrapper, .ratio');
            
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
        const animatedElements = document.querySelectorAll('.info-box, .berita-item, .prestasi-wrapper, .ratio');
        animatedElements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });
        
        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Trigger once on load
    });
</script>
@endsection