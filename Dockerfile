# Menggunakan base image PHP resmi yang sudah include Apache (Web Server)
FROM php:8.2-apache

# Install dan aktifkan ekstensi mysqli untuk koneksi ke MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Salin seluruh file proyek kamu ke dalam folder web root Apache
COPY . /var/www/html/

# Berikan hak akses folder yang benar agar Apache bisa membaca file kamu
RUN chown -R www-data:www-data /var/www/html

# Karena Railway memberikan port dinamis, ubah port Apache default (80) mengikuti env Railway jika ada
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g' /etc/apache2/sites-available/000-default.conf

# Buka port dinamis tersebut
EXPOSE 80