# Website Jurusan Pertanian 🌾

Website resmi Jurusan Pertanian yang dibangun menggunakan framework **Laravel 12** dan **Filament PHP v3**. Proyek ini dirancang untuk mengelola informasi akademik, berita, prestasi, profil dosen, dan fasilitas jurusan secara efisien.

## 🚀 Teknologi Utama

- **Framework:** [Laravel 12](https://laravel.com)
- **Admin Panel:** [Filament PHP v3](https://filamentphp.com)
- **Frontend:** [Tailwind CSS v4](https://tailwindcss.com), Bootstrap 5, Sass
- **Database:** MySQL / MariaDB
- **Asset Manager:** Vite
- **Fitur Tambahan:** 
  - `maatwebsite/excel` untuk ekspor/impor data.
  - `intervention/image` untuk pengolahan gambar.

## ✨ Fitur Utama

### 👤 User Interface (Public)
- **Beranda:** Ringkasan informasi terbaru dan box informasi interaktif.
- **Berita:** Manajemen artikel berita dengan sistem komentar.
- **Profil Jurusan:** Sejarah, Visi & Misi, serta struktur organisasi.
- **Program Studi:** Detail informasi untuk Diploma 3 (D3) dan Diploma 4 (D4).
- **Direktori Dosen:** Daftar pengajar beserta detail profilnya, termasuk fitur penetapan Ketua Program Studi (Kaprodi).
- **Prestasi:** Galeri pencapaian mahasiswa dan jurusan.
- **Fasilitas:** Informasi sarana dan prasarana pendukung.
- **Galeri:** Dokumentasi kegiatan dalam bentuk foto/video.
- **Kerjasama:** Daftar mitra dan program kolaborasi.
- **PLP & Administrasi:** Informasi teknisi laboratorium dan tata usaha.

### 🔐 Admin Panel (Filament)
- Dashboard statistik.
- Manajemen konten menyeluruh (CRUD untuk Berita, Dosen, Fasilitas, dll).
- Pengaturan situs (Logo, Footer, Info Box).
- Moderasi komentar.
- Manajemen User & Role.

## 🛠️ Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB

### Langkah-langkah
1. **Clone repositori:**
   ```bash
   git clone https://github.com/username/pertanian.git
   cd pertanian
   ```

2. **Instal dependensi PHP:**
   ```bash
   composer install
   ```

3. **Instal dependensi JavaScript:**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Sesuaikan pengaturan database di file `.env`.*

5. **Migrasi dan Seeder:**
   ```bash
   php artisan migrate --seed
   ```

6. **Build Asset:**
   ```bash
   npm run build
   ```

7. **Jalankan Server:**
   ```bash
   php artisan serve
   ```

## 🐳 Docker (Opsional)

Proyek ini sudah dilengkapi dengan konfigurasi Docker. Jalankan perintah berikut untuk memulai:
```bash
docker-compose up -d
```

## 📂 Struktur Folder Penting

- `app/Filament/Resources`: Konfigurasi admin panel.
- `app/Models`: Model database.
- `resources/views`: Template tampilan (Blade).
- `routes/web.php`: Definisi rute aplikasi.

## 📄 Lisensi

Proyek ini menggunakan lisensi [MIT](LICENSE).
