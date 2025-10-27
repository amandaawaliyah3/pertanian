@extends('layouts.app')

@section('title', 'Detail Dosen')

@section('content')
<div class="py-5 bg-light">
    <div class="container mt-5 pt-5">

        {{-- Judul --}}
        <div class="text-center mb-5">
            <h2 class="fw-bold text-success section-title">Detail Dosen</h2>
        </div>

        {{-- Card Detail Dosen --}}
        <div class="card shadow-sm border-0 mx-auto" style="max-width: 700px;">
            <div class="card-body text-center">

                {{-- Foto Dosen --}}
                <img 
                    src="{{ $dosen->foto ? asset('storage/' . $dosen->foto) : asset('images/default-avatar.png') }}"
                    class="rounded-circle border border-3 border-success mb-3"
                    width="140" height="140"
                    style="object-fit: cover;">

                <h4 class="fw-bold mb-1 text-success">{{ $dosen->nama_dosen }}</h4>
                <p class="text-muted mb-2">{{ $dosen->nidn ?? '-' }}</p>

                {{-- Info Dasar --}}
                <table class="table table-borderless mt-3 text-start">
                    <tbody>
                        <tr>
                            <th width="35%">NIP</th>
                            <td>{{ $dosen->nip ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $dosen->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td>{{ $dosen->prodi->nama_prodi ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Bidang Keahlian --}}
                @if(!empty($dosen->bidang_keahlian))
                <div class="mt-3">
                    <h6 class="fw-bold text-success">Bidang Keahlian:</h6>
                    @foreach(explode(',', $dosen->bidang_keahlian) as $bidang)
                        <span class="badge bg-success bg-opacity-10 text-success me-1">{{ trim($bidang) }}</span>
                    @endforeach
                </div>
                @endif

                {{-- Pendidikan & Pengalaman --}}
                <div class="mt-4 text-start">
                    @if($dosen->riwayat_pendidikan)
                        <h6 class="fw-bold text-success">Riwayat Pendidikan</h6>
                        <p>{!! nl2br(e($dosen->riwayat_pendidikan)) !!}</p>
                    @endif

                    @if($dosen->pengalaman_kerja)
                        <h6 class="fw-bold text-success">Pengalaman Kerja</h6>
                        <p>{!! nl2br(e($dosen->pengalaman_kerja)) !!}</p>
                    @endif
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-4">
                    <a href="{{ route('dosen.index') }}" class="btn btn-outline-success">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Dosen
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
