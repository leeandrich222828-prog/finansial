# Menggunakan base image PHP-FPM resmi berbasis Debian
FROM php:8.2-fpm

# Install Nginx dan ekstensi mysqli untuk database
RUN apt-get update && apt-get install -y nginx \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Salin semua file proyek kamu ke folder web root
COPY . /var/www/html/

# Atur hak akses folder agar bisa dibaca oleh server
RUN chown -R www-data:www-data /var/www/html

# Buat konfigurasi Nginx standar untuk PHP
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

# Perintah START yang benar: Jalankan PHP-FPM di background (-D), lalu jalankan Nginx di foreground
CMD php-fpm -D && nginx -g "daemon off;"