<footer class="text-white pt-5 pb-4">
    <div class="container">
        @php
            $footer = \App\Models\FooterSetting::first();
        @endphp

        <div class="row">
            <!-- Kolom Sosial Media -->
            <div class="col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Sosial Media</h5>
                <p>Jurusan Pertanian Politeknik Pertanian Negeri Samarinda</p>
                <div class="social-icons mt-3">
                    <a href="{{ $footer?->facebook_url ?? '#' }}" class="text-white me-2" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $footer?->instagram_url ?? '#' }}" class="text-white me-2" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $footer?->youtube_url ?? '#' }}" class="text-white me-2" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Kolom Tentang Pertanian -->
            <div class="col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Tentang Pertanian</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="/" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="mb-2"><a href="/profil" class="text-white text-decoration-none">Visi & Misi</a></li>
                    <li class="mb-2"><a href="/fasilitas" class="text-white text-decoration-none">Fasilitas Kampus</a></li>
                </ul>
            </div>
        </div>

        <hr class="my-4 bg-light opacity-50">

        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; {{ date('Y') }} Jurusan Pertanian. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0">Developed with <i class="fas fa-heart text-danger"></i> by Tim Jurusan Pertanian</p>
            </div>
        </div>
    </div>
</footer>

<style>
footer {
    background: linear-gradient(135deg, #2e7d32, #1b5e20);
    color: #f1f1f1;
}
footer a {
    transition: color 0.3s ease;
}
footer a:hover {
    color: #ffc107 !important;
}
.social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transition: all 0.3s ease;
}
.social-icons a:hover {
    background-color: #ffc107;
    color: #2e7d32 !important;
    transform: translateY(-3px);
}
</style>
