@extends('layouts.app')

@section('title', 'Data Dosen Pertanian')

@section('content')
<div class="py-5 bg-light">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-success border-2">
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Kolom Foto Profil -->
                            <div class="col-md-4">
                                <div class="text-center mb-4">
                                    <img src="{{ $dosen->foto_url ?? asset('images/default-profile.png') }}"
                                         class="img-fluid rounded-circle border border-success border-3"
                                         alt="{{ $dosen->nama }}"
                                         style="width: 250px; height: 250px; object-fit: cover;">
                                    @if($dosen->is_kaprodi)
                                        <span class="badge bg-success mt-3 fs-6">
                                            <i class="fas fa-crown me-1"></i> Koordinator Prodi
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center mt-4">
                                    <a href="{{ route('dosen.index') }}" class="btn btn-outline-success">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                                    </a>
                                </div>
                            </div>

                            <!-- Kolom Informasi -->
                            <div class="col-md-8">
                                <h2 class="fw-bold text-success mb-3">{{ $dosen->nama }}</h2>

                                <!-- Informasi Dasar -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-id-card me-2 text-success"></i>
                                            <strong>NIP:</strong> {{ $dosen->nip ?? '-' }}
                                        </p>
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-envelope me-2 text-success"></i>
                                            <strong>Email:</strong> {{ $dosen->email ?? '-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-phone me-2 text-success"></i>
                                            <strong>No. HP:</strong> {{ $dosen->no_hp ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Bidang Keahlian -->
                                @if(!empty($dosen->bidang_keahlian))
                                <div class="mb-4">
                                    <h4 class="text-success border-bottom pb-2">
                                        <i class="fas fa-graduation-cap me-2"></i> Bidang Keahlian
                                    </h4>
                                    <div class="mt-3">
                                        @foreach(explode(', ', $dosen->bidang_keahlian) as $bidang)
                                            <span class="badge bg-success bg-opacity-10 text-success me-1 mb-2 p-2">
                                                {{ trim($bidang) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <!-- Riwayat Pendidikan -->
                                <div class="mb-4">
                                    <h4 class="text-success border-bottom pb-2">
                                        <i class="fas fa-user-graduate me-2"></i> Riwayat Pendidikan
                                    </h4>
                                    @if(!empty($dosen->riwayat_pendidikan))
                                        <ul class="mt-3 list-group list-group-flush">
                                            @foreach(explode("\n", $dosen->riwayat_pendidikan) as $pendidikan)
                                                @if(trim($pendidikan))
                                                <li class="list-group-item bg-light">
                                                    <i class="fas fa-check-circle text-success me-2"></i> {{ trim($pendidikan) }}
                                                </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="alert alert-info mt-3">
                                            <i class="fas fa-info-circle me-2"></i> Belum ada data riwayat pendidikan
                                        </div>
                                    @endif
                                </div>

                                <!-- Pengalaman Kerja -->
                                <div class="mb-4">
                                    <h4 class="text-success border-bottom pb-2">
                                        <i class="fas fa-briefcase me-2"></i> Pengalaman Kerja
                                    </h4>
                                    @if(!empty($dosen->pengalaman_kerja))
                                        <ul class="mt-3 list-group list-group-flush">
                                            @foreach(explode("\n", $dosen->pengalaman_kerja) as $pengalaman)
                                                @if(trim($pengalaman))
                                                <li class="list-group-item bg-light">
                                                    <i class="fas fa-check-circle text-success me-2"></i> {{ trim($pengalaman) }}
                                                </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="alert alert-info mt-3">
                                            <i class="fas fa-info-circle me-2"></i> Belum ada data pengalaman kerja
                                        </div>
                                    @endif
                                </div>

                                <!-- Penelitian -->
                                <div class="mb-4">
                                    <h4 class="text-success border-bottom pb-2">
                                        <i class="fas fa-flask me-2"></i> Penelitian
                                    </h4>
                                    @if(!empty($dosen->penelitian) && is_array($dosen->penelitian) && count($dosen->penelitian) > 0)
                                        <div class="table-responsive mt-3">
                                            <table class="table table-hover">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th>Judul</th>
                                                        <th width="100">Tahun</th>
                                                        <th width="150">Sumber Dana</th>
                                                        <th width="150">Jumlah Dana</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dosen->penelitian as $penelitian)
                                                        <tr>
                                                            <td>{{ $penelitian['judul'] ?? '-' }}</td>
                                                            <td>{{ $penelitian['tahun'] ?? '-' }}</td>
                                                            <td>{{ $penelitian['sumber_dana'] ?? '-' }}</td>
                                                            <td>{{ isset($penelitian['jumlah_dana']) ? 'Rp '.number_format($penelitian['jumlah_dana']) : '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info mt-3">
                                            <i class="fas fa-info-circle me-2"></i> Belum ada data penelitian
                                        </div>
                                    @endif
                                </div>

                                <!-- Publikasi -->
                                <div class="mb-4">
                                    <h4 class="text-success border-bottom pb-2">
                                        <i class="fas fa-book me-2"></i> Publikasi
                                    </h4>
                                    @if(!empty($dosen->publikasi) && is_array($dosen->publikasi) && count($dosen->publikasi) > 0)
                                        <div class="table-responsive mt-3">
                                            <table class="table table-hover">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th>Judul</th>
                                                        <th width="100">Tahun</th>
                                                        <th width="120">Jenis</th>
                                                        <th>Penerbit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dosen->publikasi as $publikasi)
                                                        <tr>
                                                            <td>{{ $publikasi['judul'] ?? '-' }}</td>
                                                            <td>{{ $publikasi['tahun'] ?? '-' }}</td>
                                                            <td><span class="badge bg-success bg-opacity-10 text-success">{{ $publikasi['jenis'] ?? '-' }}</span></td>
                                                            <td>{{ $publikasi['penerbit'] ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info mt-3">
                                            <i class="fas fa-info-circle me-2"></i> Belum ada data publikasi
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
