<?php 
    session_start();
    if(!isset($_SESSION['nama'])){
    header('location: ../login.php');
    }
    require_once('../library/database.php');
    $query = "SELECT * FROM transaksi where ID=".$_GET['id'];
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
?>

<html>
    <?php include('../library/header.php'); ?>
    <body>
        <?php include('../library/navbar.php'); ?>

        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Detail Transaksi</h1>
                <a href="./index.php" class="btn btn-secondary">← Kembali</a>
            </div>

            <div class="form-wrapper">
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" value="<?php echo $row['jumlah'];?>" disabled>
                </div>
                <div class="form-group">
                    <label>Tipe</label>
                    <select name="tipe" disabled>
                        <option value="masuk" <?php if($row['tipe']=='masuk') echo 'selected'; ?>>Masuk</option>
                        <option value="keluar" <?php if($row['tipe']=='keluar') echo 'selected'; ?>>Keluar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="<?php echo $row['tanggal'];?>" disabled>
                </div>
                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="catatan" disabled><?php echo $row['catatan'];?></textarea>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="id_kategori" disabled>
                        <?php
                            $sqlKategori = "SELECT * FROM kategori";
                            $resultKategori = $connection->query($sqlKategori);
                            while($rowKategori = $resultKategori->fetch_assoc()){
                                $selected = ($rowKategori['id'] == $row['id_kategori']) ? 'selected' : '';
                                echo '<option value="'.$rowKategori['id'].'" '.$selected.'>'.$rowKategori['nama_kategori'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-actions">
                    <a href="./update.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="./index.php" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </body>
</html>