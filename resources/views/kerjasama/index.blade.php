@extends('layouts.app')

{{-- ✅ Mengisi section 'title' yang akan digunakan di layout --}}
@section('title', 'Daftar Kerjasama') 

@section('content')
<div class="container py-5">
    <div class="container mt-5 pt-5">
        <h1 class="mb-4">Daftar Kerjasama</h1>

        <form method="GET" class="row mb-4 g-2">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Cari mitra atau keterangan..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="jenis" class="form-select">
                    <option value="">-- Semua Jenis Kerjasama --</option>
                    @foreach($jenisOptions as $jenis)
                        <option value="{{ $jenis }}" {{ request('jenis') == $jenis ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>

        @if ($kerjasamas->isEmpty())
            <div class="alert alert-warning">Data kerjasama tidak ditemukan.</div>
        @else
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($kerjasamas as $kerjasama)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                
                                {{-- Menampilkan Logo --}}
                                @if ($kerjasama->logo)
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('storage/' . $kerjasama->logo) }}" 
                                             alt="Logo {{ $kerjasama->nama_mitra }}" 
                                             style="max-height: 80px; width: auto; object-fit: contain;">
                                    </div>
                                @endif

                                <h5 class="card-title">{{ $kerjasama->nama_mitra }}</h5>
                                <p class="mb-1"><strong>Jenis:</strong> <span class="badge bg-info text-dark">{{ $kerjasama->jenis_kerjasama }}</span></p>
                                <p class="mb-1"><strong>Periode:</strong> {{ \Carbon\Carbon::parse($kerjasama->tanggal_mulai)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($kerjasama->tanggal_selesai)->translatedFormat('d M Y') }}</p>
                                <p class="text-muted">{{ \Illuminate\Support\Str::limit($kerjasama->keterangan, 100) }}</p>
                                <a href="{{ route('kerjasama.show', $kerjasama->id) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $kerjasamas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection