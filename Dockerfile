# Menggunakan base image PHP + Apache yang stabil
FROM php:8.2-apache

# Install dan aktifkan ekstensi mysqli untuk database
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Salin semua file proyek kamu ke folder web root Apache
COPY . /var/www/html/

# Ubah konfigurasi port Apache agar mengikuti port dinamis dari Railway secara otomatis
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf