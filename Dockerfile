# File: Dockerfile

# Menggunakan base image PHP-FPM versi 8.2 di Alpine
FROM php:8.4-fpm-alpine

# Mengatur environment variable untuk mematikan interaksi TTY
ENV DEBIAN_FRONTEND noninteractive

## 1. Instalasi Dependensi Sistem
# build-base: Untuk mengkompilasi ekstensi.
# icu-dev: Untuk ekstensi intl.
# libpng-dev: Untuk ekstensi gd.
# libzip-dev: Untuk ekstensi zip.
RUN apk update && apk add --no-cache \
    build-base \
    autoconf \
    libxml2-dev \
    mysql-client \
    git \
    zip \
    unzip \
    icu-dev \
    libpng-dev \
    libzip-dev \
    && rm -rf /var/cache/apk/*

## 2. Instalasi Ekstensi PHP
# pdo_mysql: Untuk koneksi MariaDB/MySQL.
# intl, gd, zip: Diperlukan oleh Filament dan PHPSpreadsheet.
RUN docker-php-ext-install pdo pdo_mysql opcache intl gd zip

## 3. Instalasi Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

## 4. Konfigurasi Aplikasi
# Mengatur direktori kerja
WORKDIR /var/www/html

# Mengatur hak akses ke folder storage
RUN chown -R www-data:www-data /var/www/html

## 5. Konfigurasi Port
EXPOSE 9000

# Perintah default (tetap jalankan PHP-FPM)
CMD ["php-fpm"]