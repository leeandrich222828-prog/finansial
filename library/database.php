<?php
// Mengambil data koneksi otomatis dari Environment Variables Railway
$host     = getenv('MYSQLHOST') ?: 'localhost';
$user     = getenv('MYSQLUSER') ?: 'root';
$password = getenv('MYSQLPASSWORD') ?: '';
$database = getenv('MYSQLDATABASE') ?: 'railway'; // <--- PASTIKAN INI 'railway'
$port     = getenv('MYSQLPORT') ?: 3306;

$connection = mysqli_connect($host, $user, $password, $database, $port);

if (!$connection) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>