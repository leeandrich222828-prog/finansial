<?php
    $connection = new mysqli(
        'kodama.proxy.rlwy.net',
        'root',
        'OHcifYURxsVCGmGDcAYttfzBRrqCcyEw',
        'railway',
        30201
    );

    if($connection->connect_error){
        die("Koneksi gagal: " . $connection->connect_error);
    }
?>