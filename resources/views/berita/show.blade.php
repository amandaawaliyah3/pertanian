@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
  <h2>{{ $berita->judul }}</h2>
  <p><small>Diterbitkan pada {{ $berita->created_at->format('d M Y') }}</small></p>
  <div>
    {!! nl2br(e($berita->isi)) !!}
  </div>
  <p><a href="{{ url('/berita') }}">← Kembali ke Berita</a></p>
@endsection
