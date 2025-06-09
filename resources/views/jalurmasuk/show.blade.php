@extends('layouts.app')

@section('content')
    <h1>{{ $jalur->nama_jalur }}</h1>
    <p><strong>Deskripsi:</strong> {{ $jalur->deskripsi }}</p>
    <p><strong>Periode:</strong> {{ $jalur->tanggal_buka->format('d M Y') }} - {{ $jalur->tanggal_tutup->format('d M Y') }}</p>
    <p><strong>Kuota:</strong> {{ $jalur->kuota }}</p>
    <p><strong>Status:</strong> {{ $jalur->aktif ? 'Aktif' : 'Nonaktif' }}</p>

    <a href="{{ route('jalurmasuk.index') }}">← Kembali ke Daftar</a>
@endsection
