<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold text-success mb-3">TPTP</h5>
                <p>Program Studi Teknologi Produksi Tanaman Pangan, Fakultas Pertanian.</p>
                <div class="social-icons mt-3">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="col-md-2 mb-4">
                <h5 class="fw-bold text-success mb-3">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="mb-2"><a href="/profil" class="text-white text-decoration-none">Profil</a></li>
                    <li class="mb-2"><a href="/kurikulum" class="text-white text-decoration-none">Akademik</a></li>
                    <li class="mb-2"><a href="/kerjasama" class="text-white text-decoration-none">Penelitian</a></li>
                </ul>
            </div>

            <div class="col-md-3 mb-4">
                <h5 class="fw-bold text-success mb-3">Kontak Kami</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-success"></i> Jl. Pertanian No. 123, Kota</li>
                    <li class="mb-2"><i class="fas fa-phone me-2 text-success"></i> (021) 12345678</li>
                    <li class="mb-2"><i class="fas fa-envelope me-2 text-success"></i> tptp@universitas.ac.id</li>
                </ul>
            </div>

            <div class="col-md-3 mb-4">
                <h5 class="fw-bold text-success mb-3">Peta Lokasi</h5>
                <div class="ratio ratio-16x9">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6452.002451931772!2d117.12053023728268!3d-0.5368218039104918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df68080334dac99%3A0x5327a22a4028b267!2sPoliteknik%20Pertanian%20Negeri%20Samarinda!5e0!3m2!1sen!2sid!4v1747313095847!5m2!1sen!2sid" 
                        frameborder="0" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
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