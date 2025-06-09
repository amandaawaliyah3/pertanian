<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            @php
                $logo = App\Models\SiteLogo::getInstance();
            @endphp

            <img src="{{ $logo->logo_url }}"
                 alt="Logo {{ $logo->institution_name }}"
                 height="70"
                 class="me-2">
            <div>
                <span class="fw-bold">{{ $logo->institution_name }}</span>
                <small class="d-block" style="font-size: 0.9 rem; line-height: 1;">
                    {{ $logo->institution_subname }}
                </small>
            </div>
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-3">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}"><i class="fas fa-home me-1"></i> BERANDA</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-info-circle me-1"></i> PERTANIAN
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profil"><i class="fas fa-bullseye me-2"></i>Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="/dosen"><i class="fas fa-chalkboard-teacher me-2"></i>Data Dosen</a></li>
                        <li><a class="dropdown-item" href="/plp"><i class="fas fa-chalkboard-teacher me-2"></i>Data PLP</a></li>
                        <li><a class="dropdown-item" href="/galeri"><i class="fas fa-images me-2"></i>Galeri</a></li>
                        <li><a class="dropdown-item" href="/fasilitas"><i class="fas fa-building me-2"></i>Fasilitas</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-graduation-cap me-1"></i> PROGRAM STUDI
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/d3"><i class="fas fa-certificate me-2"></i> Diploma 3</a></li>
                        <li><a class="dropdown-item" href="/d4"><i class="fas fa-certificate me-2"></i> Diploma 4</a></li>
                        <li><a class="dropdown-item" href="/jalurmasuk"><i class="fas fa-chalkboard-teacher me-2"></i> Jalur Masuk</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/kerjasama">
                        <i class="fas fa-hands-helping me-1"></i> MITRA KERJA
                    </a>
                </li>

            <!-- Tombol admin dipindah ke paling kanan - DIUBAH UKURANNYA SAJA -->
            <div class="d-flex">
                @if(auth()->check())
                    <a href="{{ url('/admin') }}" class="btn btn-outline-light btn-sm me-1">
                        <i class="fas fa-tachometer-alt me-1"></i> ADMIN
                    </a>
                @else
                    <a href="{{ url('/admin/login') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-sign-in-alt me-1"></i> Login ADMIN
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
<style>
    /* Social Media Bar */
    .social-icons a {
        transition: all 0.3s ease;
        display: inline-block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.1);
    }

    .social-icons a:hover {
        background-color: var(--bs-success);
        transform: translateY(-3px);
    }

    /* Navbar */
    .navbar {
        padding: 0.5rem 0;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #198754, #13653f);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .navbar-brand-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .navbar-brand-main {
        font-size: 1.1rem;
        line-height: 1.2;
    }

    .navbar-brand-sub {
        font-size: 0.75rem;
        line-height: 1.1;
        margin-top: -2px;
    }

    .navbar-brand {
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.02);
    }

    .nav-link {
        font-weight: 500;
        padding: 0.5rem 1rem;
        position: relative;
        border-radius: 4px;
        margin: 0 2px;
        transition: all 0.3s ease;
    }

    .nav-link:hover, .nav-link.active {
        background-color: rgba(255,255,255,0.1);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-radius: 8px;
        padding: 0.5rem 0;
    }

    .dropdown-item {
        font-weight: 500;
        padding: 0.5rem 1.5rem;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }

    .dropdown-item:hover {
        background-color: rgba(25, 135, 84, 0.1);
        border-left: 3px solid var(--bs-success);
        padding-left: 1.2rem;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .navbar-collapse {
            padding: 1rem 0;
        }

        .nav-link {
            margin: 2px 0;
        }

        .d-flex {
            margin-top: 1rem;
        }
    }
</style>
