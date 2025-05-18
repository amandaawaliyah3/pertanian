@extends('layouts.app')

@section('title', $galeri->judul . ' - Galeri Kegiatan')

@section('content')
<style>
    .galeri-detail {
        max-width: 800px;
        margin: 120px auto 60px auto; /* kasih jarak dari navbar */
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        background-color: #fff;
    }
    .galeri-detail img {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        box-shadow: 0 6px 12px rgba(0,0,0,0.08);
    }
    .kategori-badge {
        display: inline-block;
        background-color: #198754;
        color: white;
        font-size: 0.85rem;
        padding: 0.4rem 0.9rem;
        border-radius: 25px;
        text-transform: capitalize;
        margin-bottom: 1rem;
        user-select: none;
    }
    h1 {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    .tanggal {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1.8rem;
        font-style: italic;
    }
    .deskripsi {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #444;
        white-space: pre-line; /* supaya enter tetap tampil */
        margin-bottom: 2rem;
    }
    a.btn-back {
        display: inline-block;
        text-decoration: none;
        background-color: #198754;
        color: white;
        padding: 0.5rem 1.3rem;
        border-radius: 30px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
        transition: background-color 0.3s ease;
    }
    a.btn-back:hover {
        background-color: #157347;
        color: #e9f7ef;
    }
</style>

<div class="container galeri-detail">
    <h1>{{ $galeri->judul }}</h1>
    <div class="kategori-badge">{{ $galeri->kategori }}</div>
    <p class="tanggal"><i class="far fa-calendar-alt me-1"></i> {{ $galeri->tanggal_formatted }}</p>

    <img src="{{ $galeri->foto_url }}" alt="{{ $galeri->judul }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('storage/galeri/default-gallery.jpg') }}'">

    <div class="deskripsi">{{ $galeri->deskripsi }}</div>

    <a href="{{ route('galeri.index') }}" class="btn-back">← Kembali ke Galeri</a>
</div>
@endsection
