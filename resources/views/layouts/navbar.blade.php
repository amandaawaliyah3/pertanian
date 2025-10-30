<nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow-sm fixed-top">
    <div class="container">
        @php
            $logo = \App\Models\SiteLogo::getInstance();
        @endphp

        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            @if ($logo && $logo->logo_url)
                <img src="{{ $logo->logo_url }}" 
                    alt="Logo {{ $logo->institution_name ?? 'Jurusan Pertanian' }}"
                    height="65"
                    class="me-2">
            @endif
            <div>
                <span class="fw-bold text-white">{{ $logo->institution_name ?? 'Jurusan Pertanian' }}</span>
                @if (!empty($logo->institution_subname))
                    <small class="d-block text-white-50" style="font-size: 0.85rem;">
                        {{ $logo->institution_subname }}
                    </small>
                @endif
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-3">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('/') ? 'fw-semibold text-warning' : '' }}" href="{{ url('/') }}">
                        <i class="fas fa-home me-1"></i> BERANDA
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-info-circle me-1"></i> PERTANIAN
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profil"><i class="fas fa-bullseye me-2"></i>Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="/dosen"><i class="fas fa-chalkboard-teacher me-2"></i>Data Dosen</a></li>
                        <li><a class="dropdown-item" href="/plp"><i class="fas fa-chalkboard-teacher me-2"></i>Data PLP</a></li>
                        <li><a class="dropdown-item" href="/administrasi"><i class="fas fa-user-tie me-2"></i>Data Administrasi</a></li>
                        <li><a class="dropdown-item" href="/galeri"><i class="fas fa-images me-2"></i>Galeri</a></li>
                        <li><a class="dropdown-item" href="/fasilitas"><i class="fas fa-building me-2"></i>Fasilitas</a></li>
                        <li><a class="dropdown-item" href="/prestasi"><i class="fas fa-trophy me-2"></i> Prestasi</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-graduation-cap me-1"></i> JURUSAN PERTANIAN
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item dropstart">
                            <a class="dropdown-item dropdown-toggle" href="/d3">
                                <i class="fas fa-certificate me-2"></i> D3
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/d3/1">Budidaya Tanaman Perkebunan (D3)</a></li>
                                <li><a class="dropdown-item" href="/d3/2">Teknologi Hasil Perkebunan (D3)</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropstart">
                            <a class="dropdown-item dropdown-toggle" href="/d4">
                                <i class="fas fa-certificate me-2"></i> D4 / S1 Terapan
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/d4/1">Pengelolaan Perkebunan (S1 Terapan)</a></li>
                                <li><a class="dropdown-item" href="/d4/2">Teknologi Produksi Tanaman Pangan (S1 Terapan)</a></li>
                                <li><a class="dropdown-item" href="/d4/3">Teknologi Rekayasa Pangan (S1 Terapan)</a></li>
                            </ul>
                        </li>

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/jalurmasuk"><i class="fas fa-door-open me-2"></i> Jalur Masuk</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="/kerjasama">
                        <i class="fas fa-handshake me-1"></i> MITRA KERJA
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
@media (min-width: 992px) {
    .dropdown-menu .dropstart .dropdown-menu {
        position: absolute;
        top: 0;
        right: 101%;
        margin-top: -6px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        display: none;
    }

    .dropdown-menu .dropstart:hover > .dropdown-menu {
        display: block;
    }

    .dropdown-menu .dropstart > .dropdown-toggle::after {
        border-right: .3em solid;
        transform: rotate(180deg);
        float: right;
        margin-top: .5em;
    }
}

body {
    padding-top: 95px;
}
</style>
