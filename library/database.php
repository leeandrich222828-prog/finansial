<?php
$host = getenv('MYSQLHOST') ?: '127.0.0.1';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: '';
$db   = getenv('MYSQLDATABASE') ?: 'railway';
$port = getenv('MYSQLPORT') ?: '3306';

$connection = new mysqli($host, $user, $pass, $db, $port);

if ($connection->connect_error) {
    die("Koneksi gagal: " . $connection->connect_error);
}
?>