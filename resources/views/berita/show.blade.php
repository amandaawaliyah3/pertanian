@extends('layouts.app')

@section('title', $title ?? 'Detail Berita')

@section('content')
<style>
    body {
        padding-top: 70px;
        background-color: #f7f9fa;
        background-image: url('/images/ornamen-kiri.png'), url('/images/ornamen-kanan.png');
        background-position: top left, bottom right;
        background-repeat: no-repeat, no-repeat;
        background-size: 120px, 120px;
    }
    
    .berita-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .berita-judul {
        font-size: 2.2rem;
        color: #2c3e50;
        margin-bottom: 1rem;
    }
    
    .berita-meta {
        color: #7f8c8d;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }
    
    .berita-gambar {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 2rem;
    }
    
    .berita-isi {
        line-height: 1.8;
        font-size: 1.1rem;
    }
    
    .berita-lainnya {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #eee;
    }
    
    .card-berita {
        transition: transform 0.3s ease;
        height: 100%;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .card-berita:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .btn-kembali {
        background-color: var(--primary-color);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-kembali:hover {
        background-color: var(--accent-color);
        transform: translateY(-2px);
        color: white;
    }
</style>

<div class="berita-container">
    <!-- Main News Content -->
    <h1 class="berita-judul">{{ $berita->judul ?? 'Judul Tidak Tersedia' }}</h1>
    
    <div class="berita-meta">
        @if($berita->created_at)
            Dipublikasikan: {{ $berita->created_at->format('d F Y') }}
        @else
            Tanggal publikasi tidak tersedia
        @endif
    </div>
    
    @if($berita->gambar && file_exists(storage_path('app/public/' . $berita->gambar)))
        <img src="{{ asset('storage/'.$berita->gambar) }}" 
             class="berita-gambar" 
             alt="{{ $berita->judul ?? '' }}">
    @endif
    
    <div class="berita-isi">
        @if(!empty($berita->konten))
            {!! $berita->konten !!}
        @else
            <div class="alert alert-warning">Konten berita sedang tidak tersedia</div>
        @endif
    </div>
    
    <a href="{{ route('beranda') }}" class="btn btn-kembali mt-4">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
    </a>
    
    <!-- Related News Section -->
    @if($relatedBeritas->count() > 0)
    <div class="berita-lainnya">
        <h3 class="mb-4">Berita Lainnya</h3>
        <div class="row">
            @foreach($relatedBeritas as $beritaLain)
            <div class="col-md-4 mb-4">
                <div class="card card-berita h-100">
                    @if($beritaLain->gambar && file_exists(storage_path('app/public/' . $beritaLain->gambar)))
                    <img src="{{ asset('storage/'.$beritaLain->gambar) }}" 
                         class="card-img-top" 
                         alt="{{ $beritaLain->judul }}"
                         style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $beritaLain->judul }}</h5>
                        <p class="card-text">
                            <small class="text-muted">
                                @if($beritaLain->created_at)
                                    {{ $beritaLain->created_at->format('d M Y') }}
                                @else
                                    Tanggal tidak tersedia
                                @endif
                            </small>
                        </p>
                        <p class="card-text mt-2 mb-3">
                            {{ Str::limit(strip_tags($beritaLain->isi), 100) }}
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('berita.show', $beritaLain->id) }}" 
                               class="btn btn-sm btn-primary">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
    // Simple animation
    document.addEventListener('DOMContentLoaded', function() {
        const content = document.querySelector('.berita-isi');
        if(content) {
            content.style.opacity = 0;
            content.style.transition = 'opacity 0.5s ease';
            setTimeout(() => content.style.opacity = 1, 200);
        }
    });
</script>
@endsection