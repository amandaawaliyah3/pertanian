@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="container mt-5 pt-5">
        <a href="{{ route('kerjasama.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title">{{ $kerjasama->nama_mitra }}</h3>
                <p><strong>Jenis Kerjasama:</strong> <span class="badge bg-success">{{ $kerjasama->jenis_kerjasama }}</span></p>
                <p><strong>Periode:</strong> {{ \Carbon\Carbon::parse($kerjasama->tanggal_mulai)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($kerjasama->tanggal_selesai)->translatedFormat('d M Y') }}</p>
                <p><strong>Keterangan:</strong><br>{{ $kerjasama->keterangan }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
