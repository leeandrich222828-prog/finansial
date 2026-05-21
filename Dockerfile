FROM dunglas/frankenphp:latest

# Install ekstensi mysqli yang dibutuhkan
RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Salin file konfigurasi Caddyfile ke dalam container bawaan
COPY Caddyfile /etc/caddy/Caddyfile

# Salin semua file proyek kamu ke dalam container
COPY . /app/

WORKDIR /app
EXPOSE 80