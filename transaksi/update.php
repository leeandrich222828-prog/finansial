<?php 
    session_start();
    if(!isset($_SESSION['nama'])){
    header('location: ../login.php');
    }
    require_once('../library/database.php');
    $query = "SELECT * FROM transaksi where ID=".$_GET['id'];
    $result = $connection->query($query);
    $row = $result->fetch_assoc();

    
    if(isset($_POST['submit'])){
        $jumlah = $_POST['jumlah'];
        $tipe = $_POST['tipe'];
        $tanggal = $_POST['tanggal'];
        $catatan = $_POST['catatan'];
        $id_kategori = $_POST['id_kategori'];
        $id_user = $_SESSION['id'];
        $sql = "UPDATE transaksi SET 
        jumlah=".$jumlah.",
        tipe='".$tipe."',
        tanggal='".$tanggal."',
        catatan='".$catatan."',
        id_kategori=".$id_kategori."
        WHERE id=".$_GET['id'];
        $connection->query($sql);
        header("location: index.php");
    }
?>

<html>
    <?php include('../library/header.php'); ?>
    <body>
        <?php include('../library/navbar.php'); ?>

        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Update Transaksi</h1>
                <a href="./index.php" class="btn btn-secondary">← Kembali</a>
            </div>

            <div class="form-wrapper">
                <form method="POST">
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" value="<?php echo $row['jumlah'];?>">
                    </div>
                    <div class="form-group">
                        <label>Tipe</label>
                        <select name="tipe">
                            <option value="masuk" <?php if($row['tipe']=='masuk') echo 'selected'; ?>>Masuk</option>
                            <option value="keluar" <?php if($row['tipe']=='keluar') echo 'selected'; ?>>Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="<?php echo $row['tanggal'];?>">
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan"><?php echo $row['catatan'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori">
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
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        <a href="./index.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>