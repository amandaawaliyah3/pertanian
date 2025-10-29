@extends('layouts.app')

@section('title', $dosen->nama_dosen)

@section('content')
<div class="py-5 bg-light">
    <div class="container mt-5 pt-5">
        {{-- Judul Halaman --}}
        <div class="text-center mb-5">
            <h2 class="fw-bold text-success section-title">Detail Dosen</h2>
        </div>

        {{-- Card Detail Dosen --}}
        <div class="card shadow-lg border-0 mx-auto rounded-4" style="max-width: 800px;">
            <div class="card-body p-5">

                <div class="row">
                    {{-- Kolom Kiri: Foto, Nama, Jabatan --}}
                    <div class="col-md-4 text-center border-end">
                        <div style="width: 150px; height: 200px; overflow: hidden; margin: 0 auto; border: 3px solid #e9ecef; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                            <img 
                                src="{{ $dosen->foto ? asset('storage/' . $dosen->foto) : asset('images/default-avatar.png') }}"
                                class="img-fluid" 
                                alt="{{ $dosen->nama_dosen }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <h4 class="mt-3 fw-bold mb-0 text-success">{{ $dosen->nama_dosen }}</h4>
                        <p class="text-muted mb-4">{{ $dosen->jabatan ?? 'Tenaga Pengajar' }}</p>
                    </div>

                    {{-- Kolom Kanan: Detail Dasar --}}
                    <div class="col-md-8 text-start"> 
                        <h5 class="fw-bold text-success mb-3">Informasi Kontak & Jabatan</h5>
                        {{-- ✅ PERBAIKAN: Mengganti table-borderless menjadi table-bordered --}}
                        <table class="table table-striped table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th width="35%">NIP</th>
                                    <td>{{ $dosen->nip ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td>{{ $dosen->jabatan ?? '-' }}</td>
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
                    </div>
                </div>
                
                <hr class="my-4">
                
                {{-- Bagian Pendidikan, Pengalaman, Keahlian (Full Width) --}}
                <div class="text-start p-2">
                    
                    {{-- Bidang Keahlian --}}
                    @if(!empty($dosen->bidang_keahlian))
                    <div class="mb-4">
                        <h6 class="fw-bold text-success mb-2"><i class="fas fa-tools me-2"></i>Bidang Keahlian</h6>
                        @foreach(explode(',', $dosen->bidang_keahlian) as $bidang)
                            <span class="badge rounded-pill bg-success me-1">{{ trim($bidang) }}</span>
                        @endforeach
                    </div>
                    @endif

                    {{-- Riwayat Pendidikan --}}
                    @if($dosen->riwayat_pendidikan)
                    <div class="mb-4">
                        <h6 class="fw-bold text-success mb-2"><i class="fas fa-graduation-cap me-2"></i>Riwayat Pendidikan</h6>
                        <div class="bg-light p-3 rounded">{!! nl2br(e($dosen->riwayat_pendidikan)) !!}</div>
                    </div>
                    @endif

                    {{-- Pengalaman Kerja --}}
                    @if($dosen->pengalaman_kerja)
                    <div class="mb-4">
                        <h6 class="fw-bold text-success mb-2"><i class="fas fa-briefcase me-2"></i>Pengalaman Kerja</h6>
                        <div class="bg-light p-3 rounded">{!! nl2br(e($dosen->pengalaman_kerja)) !!}</div>
                    </div>
                    @endif
                </div>


                {{-- Tombol Kembali --}}
                <div class="mt-4 text-center">
                    <a href="{{ route('dosen.index') }}" class="btn btn-outline-success">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Dosen
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection