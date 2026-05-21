<?php
    $host = getenv('MYSQLHOST') ?: 'localhost';
    $user = getenv('MYSQLUSER') ?: 'root';
    $pass = getenv('MYSQLPASSWORD') ?: '';
    $db   = getenv('MYSQLDATABASE') ?: 'finansial';
    $port = getenv('MYSQLPORT') ?: 3306;

    $connection = new mysqli($host, $user, $pass, $db, $port);

    if($connection->connect_error){
        die("Koneksi gagal: " . $connection->connect_error);
    }
?>