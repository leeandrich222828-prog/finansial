<?php
    $connection = new mysqli(
        'mysql.railway.internal',
        'root', 
        'OHcifYURxsVCGmGDcAYttfzBRrqCcyEw',
        'railway',
        3306
    );

    if($connection->connect_error){
        die("Koneksi gagal: " . $connection->connect_error);
    }
?>
