# Menggunakan base image PHP-FPM berbasis Debian Slim yang stabil
FROM php:8.2-fpm-slim

# Install Nginx dan library pendukung
RUN apt-get update && apt-get install -y nginx \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Salin semua file proyek kamu ke folder web root
COPY . /var/www/html/

# Atur hak akses agar aman
RUN chown -R www-data:www-data /var/www/html

# Buat konfigurasi Nginx langsung di tempat tanpa skrip eksternal
RUN echo 'server { \
    listen 80 default_server; \
    listen [::]:80 default_server; \
    root /var/www/html; \
    index index.php index.html; \
    location / { \
        try_files $uri $uri/ /index.php?$args; \
    } \
    location ~ \.php$ { \
        include fastcgi_params; \
        fastcgi_pass 127.0.0.1:9000; \
        fastcgi_index index.php; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
    } \
}' > /etc/nginx/sites-available/default

# Perintah untuk menjalankan PHP-FPM dan Nginx bersamaan
CMD service php8.2-fpm start && nginx -g "daemon off;"