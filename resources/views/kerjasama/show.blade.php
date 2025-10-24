@extends('layouts.app')

{{-- ✅ TAMBAHKAN INI: Menggunakan nama mitra sebagai judul spesifik halaman --}}
@section('title', $kerjasama->nama_mitra)

@section('content')
<div class="container py-5">
    <div class="container mt-5 pt-5">
        <a href="{{ route('kerjasama.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

        <div class="card shadow-sm">
            <div class="card-body">
                
                {{-- LOGO DITAMBAHKAN --}}
                @if ($kerjasama->logo)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $kerjasama->logo) }}" 
                             alt="Logo {{ $kerjasama->nama_mitra }}" 
                             style="max-height: 120px; width: auto; object-fit: contain;">
                    </div>
                @endif
                {{----------------------}}
                
                <h3 class="card-title">{{ $kerjasama->nama_mitra }}</h3>
                <p><strong>Jenis Kerjasama:</strong> <span class="badge bg-success">{{ $kerjasama->jenis_kerjasama }}</span></p>
                <p><strong>Periode:</strong> {{ \Carbon\Carbon::parse($kerjasama->tanggal_mulai)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($kerjasama->tanggal_selesai)->translatedFormat('d M Y') }}</p>
                <p><strong>Keterangan:</strong><br>{{ $kerjasama->keterangan }}</p>
            </div>
        </div>
    </div>
</div>
@endsection