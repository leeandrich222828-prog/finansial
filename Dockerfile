# Menggunakan base image FrankenPHP resmi yang sudah include PHP 8.2/8.3
FROM dunglas/frankenphp:latest

# Install ekstensi mysqli yang dibutuhkan oleh aplikasi kamu
RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Salin semua file proyek kamu ke dalam container
COPY . /app/

# Set kerja direktori ke folder aplikasi
WORKDIR /app

# Expose port yang digunakan FrankenPHP (default: 80 dan 443)
EXPOSE 80
EXPOSE 443