<?php
$host     = 'mysql.railway.internal';
$user     = 'root';
$password = 'OHcifYURxsVCGmGDcAYttfzBRrqCcyEw';
$database = 'railway'; 
$port     = 3306; 

$koneksi = mysqli_connect($host, $user, $password, $database, $port);
$connection = $koneksi;
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>