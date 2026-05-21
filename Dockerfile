# Menggunakan base image FrankenPHP resmi
FROM dunglas/frankenphp:latest

# Set variabel lingkungan untuk mematikan HTTPS otomatis FrankenPHP
ENV SERVER_NAME=":80"

RUN echo "auto_https off" >> /etc/caddy/Caddyfile
# Install ekstensi mysqli yang dibutuhkan oleh aplikasi kamu
RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Salin semua file proyek kamu ke dalam container
COPY . /app/

# Set kerja direktori ke folder aplikasi
WORKDIR /app

# Expose port yang digunakan
EXPOSE 80

