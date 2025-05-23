<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            @php
                $logo = App\Models\SiteLogo::getInstance();
            @endphp
            
            <img src="{{ $logo->logo_url }}" 
                 alt="Logo {{ $logo->institution_name }}" 
                 height="40" 
                 class="me-2">
            <div>
                <span class="fw-bold">{{ $logo->institution_name }}</span>
                <small class="d-block" style="font-size: 0.7rem; line-height: 1;">
                    {{ $logo->institution_subname }}
                </small>
            </div>
        </a>

        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Profil
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profil">Visi Misi</a></li>
                        <li><a class="dropdown-item" href="/dosen">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="/dosen">Dosen & Staff</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kurikulum">Akademik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kerjasama">Penelitian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kerjasama">Pengabdian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/galeri">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/fasilitas">Fasilitas</a>
                </li>
            </ul>
            
            <div class="d-flex">
                @if(auth()->check())
                    <a href="{{ url('/admin') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                @else
                    <a href="{{ url('/admin/login') }}" class="btn btn-warning">
                        <i class="fas fa-sign-in-alt me-1"></i> Admin Login
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>

<style>
    .navbar {
        padding: 0.8rem 0;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #198754, #13653f);
    }
    
    .navbar-brand {
        font-weight: 700;
    }
    
    .nav-link {
        font-weight: 500;
        padding: 0.5rem 1rem;
        position: relative;
    }
    
    .nav-link:after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: var(--accent-color);
        transition: width 0.3s ease;
    }
    
    .nav-link:hover:after,
    .nav-link.active:after {
        width: 100%;
    }
    
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .dropdown-item {
        font-weight: 500;
    }
    
    .dropdown-item:hover {
        background-color: rgba(25, 135, 84, 0.1);
        color: var(--primary-color);
    }
</style>