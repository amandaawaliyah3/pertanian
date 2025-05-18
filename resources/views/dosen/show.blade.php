@extends('layouts.app')

@section('title', 'Profil Dosen TPTP')

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
                                    <img src="{{ $dosen->foto_url }}"
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
                                            <strong>NIDN:</strong> {{ $dosen->nidn }}
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
                                @if(count($dosen->bidang_keahlian_array))
                                <div class="mb-4">
                                    <h4 class="text-success border-bottom pb-2">
                                        <i class="fas fa-graduation-cap me-2"></i> Bidang Keahlian
                                    </h4>
                                    <div class="mt-3">
                                        @foreach($dosen->bidang_keahlian_array as $bidang)
                                            <span class="badge bg-success bg-opacity-10 text-success me-1 mb-2 p-2">
                                                {{ $bidang }}
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
                                    @if(count($dosen->riwayat_pendidikan_array))
                                        <ul class="mt-3 list-group list-group-flush">
                                            @foreach($dosen->riwayat_pendidikan_array as $pendidikan)
                                                <li class="list-group-item bg-light">
                                                    <i class="fas fa-check-circle text-success me-2"></i> {{ $pendidikan }}
                                                </li>
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
                                    @if(count($dosen->pengalaman_kerja_array))
                                        <ul class="mt-3 list-group list-group-flush">
                                            @foreach($dosen->pengalaman_kerja_array as $pengalaman)
                                                <li class="list-group-item bg-light">
                                                    <i class="fas fa-check-circle text-success me-2"></i> {{ $pengalaman }}
                                                </li>
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
                                    @if(count($dosen->penelitian_array))
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
                                                    @foreach($dosen->penelitian_array as $penelitian)
                                                        @php $parts = explode('|', $penelitian); @endphp
                                                        <tr>
                                                            <td>{{ $parts[0] ?? '-' }}</td>
                                                            <td>{{ $parts[1] ?? '-' }}</td>
                                                            <td>{{ $parts[2] ?? '-' }}</td>
                                                            <td>{{ isset($parts[3]) ? 'Rp '.number_format($parts[3]) : '-' }}</td>
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
                                    @if(count($dosen->publikasi_array))
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
                                                    @foreach($dosen->publikasi_array as $publikasi)
                                                        @php $parts = explode('|', $publikasi); @endphp
                                                        <tr>
                                                            <td>{{ $parts[0] ?? '-' }}</td>
                                                            <td>{{ $parts[1] ?? '-' }}</td>
                                                            <td><span class="badge bg-success bg-opacity-10 text-success">{{ $parts[2] ?? '-' }}</span></td>
                                                            <td>{{ $parts[3] ?? '-' }}</td>
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

                            </div> <!-- end col-md-8 -->
                        </div> <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
