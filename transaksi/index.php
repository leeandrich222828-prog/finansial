<?php
    session_start();
    if(!isset($_SESSION['nama'])){
        header('location: ../login.php');
    }
    require_once('../library/database.php');
    if(isset($_POST['delete'])){
        $sql = "DELETE FROM transaksi WHERE ID=".$_POST['id'];
        $connection->query($sql);
    }
    $id_user = $_SESSION['id'];
    $query = "SELECT transaksi.*, kategori.nama_kategori 
          FROM transaksi 
          JOIN kategori ON transaksi.id_kategori = kategori.id
          WHERE transaksi.id_user =" .$id_user;
    $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('n');
    $query = "SELECT transaksi.*, kategori.nama_kategori 
          FROM transaksi 
          JOIN kategori ON transaksi.id_kategori = kategori.id
          WHERE transaksi.id_user = ".$id_user."
          AND MONTH(tanggal) = ".$bulan;
?>

<html>
    <?php include('../library/header.php'); ?>
    <body>
    <?php include('../library/navbar.php'); ?>
    <div class="container">            
        <div class="page-header">
            <h1 class="page-title">Transaksi</h1>
            <div style="display:flex; gap:0.75rem; align-items:center;">
                <form method="GET" style="display:flex; gap:0.5rem; align-items:center; margin:0;">
                    <select name="bulan" class="btn btn-secondary">
                        <?php                    
                        $namaBulan = [
                        1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April',
                        5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus',
                        9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
                    ];
                        foreach($namaBulan as $angka => $nama){
                        $selected = ($angka == $bulan) ? 'selected' : '';
                        echo '<option value="'.$angka.'" '.$selected.'>'.$nama.'</option>';
                    }
                    ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
                <a href="./create.php" class="btn btn-primary">+ Tambah Transaksi</a>
            </div>
        </div>                     
                <div class="table-wrapper">    
            <table>
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Tipe</th>
                        <th>Tanggal</th>
                        <th>Catatan</th>            
                        <th class="no-print">Action</th>
                    </tr>
                </thead>
            <tbody>
    </div>
            <?php
                $result = $connection->query($query);
                while($row = $result->fetch_assoc()){
                    echo '<tr>
                        <td>'.$row['nama_kategori'].'</td>
                        <td>Rp '.number_format($row['jumlah'], 0, ',', '.').'</td>
                        <td><span class="badge badge-'.$row['tipe'].'">'.$row['tipe'].'</span></td>
                        <td>'.$row['tanggal'].'</td>
                        <td>'.$row['catatan'].'</td>
                        <td>
                            <div class="action-group">
                                <a href="./update.php?id='.$row['id'].'" class="btn btn-secondary">Update</a>
                                <form method="POST">
                                    <input type="number" name="id" value='.$row['id'].' hidden />
                                    <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm(\'Yakin mau hapus transaksi ini?\')">Delete</button>
                                </form>
                                <a href="./view.php?id='.$row['id'].'" class="btn btn-primary">View</a>
                            </div>
                        </td>
                    </tr>';
                }
            ?>
            </tbody>
            </table>    
        </div>
        </div>
    </body>
</html>