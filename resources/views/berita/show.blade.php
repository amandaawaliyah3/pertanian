@extends('layouts.app')

@section('title', $title ?? 'Detail Berita')

@section('content')
<style>
    body {
        padding-top: 70px;
        background-color: #f7f9fa;
    }

    .berita-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .komentar-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .btn-kembali {
        background-color: var(--primary-color);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
</style>

<div class="berita-container">
    <h1 class="berita-judul">{{ $berita->judul }}</h1>
    <p class="text-muted">{{ $berita->created_at->format('d F Y') }}</p>

    @if($berita->gambar && file_exists(storage_path('app/public/' . $berita->gambar)))
        <img src="{{ asset('storage/'.$berita->gambar) }}" class="img-fluid rounded mb-3" alt="{{ $berita->judul }}">
    @endif

    <div class="berita-isi mb-4">
        {!! $berita->konten !!}
    </div>

    <a href="{{ route('beranda') }}" class="btn btn-kembali mb-4">← Kembali ke Beranda</a>

    <!-- Form Komentar -->
    <h4 class="mt-5 mb-3">Tinggalkan Komentar</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('comment.store') }}" method="POST">
        @csrf
        <input type="hidden" name="berita_id" value="{{ $berita->id }}">

        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Nama" required>
        </div>

        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="mb-3">
            <textarea name="message" class="form-control" rows="3" placeholder="Tulis komentar..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
    </form>

    <!-- Daftar Komentar -->
    <div class="mt-5">
        <h4>Komentar</h4>
        @if($comments->count() > 0)
            @foreach($comments as $comment)
                <div class="komentar-item">
                    <strong>{{ $comment->name }}</strong>
                    <p class="mb-1">{{ $comment->message }}</p>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        @else
            <p>Belum ada komentar.</p>
        @endif
    </div>

    <!-- Berita Lainnya -->
    @if($relatedBeritas->count() > 0)
        <div class="berita-lainnya mt-5">
            <h4>Berita Lainnya</h4>
            <div class="row">
                @foreach($relatedBeritas as $beritaLain)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($beritaLain->gambar)
                                <img src="{{ asset('storage/'.$beritaLain->gambar) }}" class="card-img-top" alt="{{ $beritaLain->judul }}" style="height:200px;object-fit:cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $beritaLain->judul }}</h5>
                                <p class="card-text text-muted">{{ $beritaLain->created_at->format('d M Y') }}</p>
                                <a href="{{ route('berita.show', $beritaLain->id) }}" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
