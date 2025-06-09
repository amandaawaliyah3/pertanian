@extends('layouts.app')

@section('title', 'Profil')

@section('content')

<style>
    .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 2.5rem;
        font-size: 2rem;
        font-weight: 700;
    }

    .section-title::after {
        content: '';
        position: absolute;
        width: 60px;
        height: 4px;
        bottom: -10px;
        left: 0;
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        border-radius: 2px;
    }

    .section-block {
        padding: 3rem 0;
        border-bottom: 1px solid #ddd;
    }

    .info-box {
        background-color: #fff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        transition: 0.3s ease;
        height: 100%;
        border-top: 4px solid var(--primary-color);
    }

    .info-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
    }

    .sidebar-berita {
        max-height: 500px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .sidebar-berita::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-berita::-webkit-scrollbar-thumb {
        background-color: var(--primary-color);
        border-radius: 3px;
    }

    .berita-card {
        background-color: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        margin-bottom: 1.5rem;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .berita-card img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }

    .berita-card-body {
        padding: 1rem;
    }

    .berita-card-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .berita-card small {
        font-size: 0.75rem;
        color: #888;
    }

    .berita-card p {
        font-size: 0.875rem;
        color: #666;
    }

    .btn-baca {
        background: var(--primary-color);
        color: #fff;
        padding: 0.35rem 0.75rem;
        font-size: 0.85rem;
        border-radius: 0.5rem;
        text-decoration: none;
        display: inline-block;
        margin-top: 0.5rem;
    }

    .btn-baca:hover {
        background: var(--accent-color);
    }
</style>

<section class="hero-section py-5 text-center bg-light">
    <div class="container">
         <div class="container mt-5 pt-5">
        <h1 class="display-5 fw-bold text-dark">Jurusan Pertanian</h1>
        <p class="lead text-muted">Pelajari sejarah, visi misi, dan akreditasi dari Jurusan Pertanian.</p>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            {{-- Sejarah --}}
            <section class="section-block">
                <h2 class="section-title text-success">Sejarah</h2>
                @if ($sejarah)
                    <p class="text-muted fs-5">{!! nl2br(e($sejarah->konten)) !!}</p>
                @else
                    <p class="text-muted">Belum ada data sejarah.</p>
                @endif
            </section>

            {{-- Visi Misi --}}
            <section class="section-block">
                <h2 class="section-title text-success">Visi</h2>
                @if ($visiMisi)
                    <p class="text-muted fs-5">{{ $visiMisi->visi }}</p>
                    <h3 class="mt-4 fw-bold">Misi</h3>
                    <ul class="text-muted fs-5">
                        @foreach (explode("\n", $visiMisi->misi) as $misi)
                            <li>{{ $misi }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada data visi dan misi.</p>
                @endif
            </section>

            {{-- Akreditasi --}}
            <section class="section-block">
                <h2 class="section-title text-success">Akreditasi</h2>
                <div class="row">
                    @forelse ($akreditasi as $item)
                        <div class="col-md-6 mb-4">
                            <div class="info-box">
                                <h5 class="mb-2">{{ $item->lembaga }}</h5>
                                <p><strong>Peringkat:</strong> {{ $item->peringkat }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada data akreditasi.</p>
                    @endforelse
                </div>
            </section>
        </div>

        {{-- Sidebar Berita --}}
        <div class="col-lg-4">
            @if ($beritas->count())
                <h4 class="section-title text-success">Berita Terbaru</h4>
                <div class="sidebar-berita">
                    @foreach ($beritas as $item)
                        <div class="berita-card">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                            <div class="berita-card-body">
                                <div class="berita-card-title">{{ $item->judul }}</div>
                                <small>{{ $item->created_at->format('d M Y') }}</small>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 80) }}</p>
                                <a href="{{ route('berita.show', $item->id) }}" class="btn-baca">Baca</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
