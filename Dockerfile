# Menggunakan image PHP-FPM resmi yang ringan
FROM php:8.2-fpm-alpine

# Install ekstensi mysqli untuk koneksi ke MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Install Nginx
RUN apk add --no-cache nginx

# Salin semua file proyek kamu ke folder web root
COPY . /var/www/html/

# Buat konfigurasi Nginx minimalis yang mendukung PHP dan Port Dinamis Railway
RUN echo 'server { \
    listen printf_port; \
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
}' > /etc/nginx/http.d/default.conf

# Buat script otomatis untuk membaca port dari Railway saat container menyala
RUN echo '#!/bin/sh\n\
sed -i "s/printf_port/${PORT:-80}/g" /etc/nginx/http.d/default.conf\n\
php-fpm -D\n\
nginx -g "daemon off;"' > /entrypoint.sh && chmod +x /entrypoint.sh

# Jalankan server
CMD ["/entrypoint.sh"]