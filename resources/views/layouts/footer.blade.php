<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        @php
            $footer = \App\Models\FooterSetting::first();
        @endphp

        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold text-success mb-3">TPTP</h5>
                <p>Program Studi Teknologi Produksi Tanaman Pangan, Fakultas Pertanian.</p>
                <div class="social-icons mt-3">
                    <a href="{{ $footer?->facebook_url ?? '#' }}" class="text-white me-3" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $footer?->twitter_url ?? '#' }}" class="text-white me-3" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $footer?->instagram_url ?? '#' }}" class="text-white me-3" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $footer?->youtube_url ?? '#' }}" class="text-white me-3" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="col-md-2 mb-4">
                <h5 class="fw-bold text-success mb-3">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="/" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="mb-2"><a href="/profil" class="text-white text-decoration-none">Profil</a></li>
                    <li class="mb-2"><a href="/kurikulum" class="text-white text-decoration-none">Akademik</a></li>
                    <li class="mb-2"><a href="/kerjasama" class="text-white text-decoration-none">Penelitian</a></li>
                </ul>
            </div>

            <div class="col-md-3 mb-4">
                <h5 class="fw-bold text-success mb-3">Kontak Kami</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-success"></i> {{ $footer?->address ?? 'Alamat belum tersedia' }}</li>
                    <li class="mb-2"><i class="fas fa-phone me-2 text-success"></i> {{ $footer?->phone ?? '-' }}</li>
                    <li class="mb-2"><i class="fas fa-envelope me-2 text-success"></i> {{ $footer?->email ?? '-' }}</li>
                </ul>
            </div>

            <div class="col-md-3 mb-4">
                <h5 class="fw-bold text-success mb-3">Peta Lokasi</h5>
                <div class="ratio ratio-16x9">
                    @if (!empty($footer?->map_embed_url))
                        <iframe 
                            src="{{ $footer->map_embed_url }}" 
                            frameborder="0" 
                            style="border:0;" 
                            allowfullscreen 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @else
                        <p class="text-white">Peta belum tersedia</p>
                    @endif
                </div>
            </div>
        </div>

        <hr class="my-4 bg-secondary">

        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; {{ date('Y') }} Program Studi TPTP. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0">Developed with <i class="fas fa-heart text-danger"></i> by Tim TPTP</p>
            </div>
        </div>
    </div>
</footer>

<style>
    footer {
        background: linear-gradient(135deg, #13653f, #0d4b2d);
    }

    footer a {
        transition: color 0.3s ease;
    }

    footer a:hover {
        color: var(--accent-color) !important;
    }

    .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        background-color: var(--accent-color);
        color: var(--dark-color) !important;
        transform: translateY(-3px);
    }
</style>
