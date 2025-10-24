# File: Dockerfile

# Menggunakan base image PHP-FPM versi 8.4 di Alpine
FROM php:8.4-fpm-alpine

# Mengatur environment variable untuk mematikan int>
ENV DEBIAN_FRONTEND noninteractive

## 1. Instalasi Dependensi Sistem
# libxml2: WAJIB untuk ekstensi DOM/XML di Alpine
RUN apk update && apk add --no-cache \
    build-base \
    autoconf \
    libxml2-dev \
    libxml2 \
    mysql-client \
    git \
    zip \
    unzip \
    icu-dev \
    libpng-dev \
    libzip-dev \
    && rm -rf /var/cache/apk/*

## 2. Instalasi Ekstensi PHP
# Kita akan menghapus 'dom' dan 'xmlreader' dan fok>
# Di PHP 8.4 Alpine, 'dom' sering bermasalah saat b>
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    opcache \
    intl \
    gd \
    zip \
    # KOREKSI: Instal ekstensi 'xml' sebagai pengga>
    # yang sering konflik atau sudah built-in.
    xml

## 3. Instalasi Composer
COPY --from=composer:latest /usr/bin/composer /usr/>

## 3.5. Konfigurasi PHP untuk Upload (Fix Upload Lo>
RUN mkdir -p /usr/local/etc/php/conf.d/
COPY docker/php/uploads.ini /usr/local/etc/php/conf>

## 4. Konfigurasi Aplikasi
# Mengatur direktori kerja
WORKDIR /var/www/html

# Mengatur hak akses ke folder storage
RUN chown -R www-data:www-data /var/www/html

## 5. Konfigurasi Port
EXPOSE 9000

# Perintah default (tetap jalankan PHP-FPM)
CMD ["php-fpm"]
