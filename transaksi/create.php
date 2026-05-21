<?php 
    session_start();
    if(!isset($_SESSION['nama'])){
    header('location: ../login.php');
    }
    require_once('../library/database.php');
    if(isset($_POST['submit'])){
        $jumlah = $_POST['jumlah'];
        $tipe = $_POST['tipe'];
        $tanggal = $_POST['tanggal'];
        $catatan = $_POST['catatan'];
        $id_kategori = $_POST['id_kategori'];
        $id_user = $_SESSION['id'];
    $sql = "INSERT INTO transaksi (jumlah, tipe, tanggal, catatan, id_kategori, id_user)
    VALUES (".$jumlah.",'".$tipe."','".$tanggal."','".$catatan."',".$id_kategori.",".$id_user.")";
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
            <h1 class="page-title">Tambah Transaksi</h1>
            <a href="./index.php" class="btn btn-secondary">← Kembali</a>
        </div>

        <div class="form-wrapper">
            <form method="POST">
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah">
                </div>
                <div class="form-group">
                    <label>Tipe</label>
                    <select name="tipe">
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal">
                </div>
                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="catatan"></textarea>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="id_kategori">
                        <?php
                            $sqlKategori = "SELECT * FROM kategori";
                            $resultKategori = $connection->query($sqlKategori);
                            while($row = $resultKategori->fetch_assoc()){
                                echo '<option value="'.$row['id'].'">'.$row['nama_kategori'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    <a href="./index.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>