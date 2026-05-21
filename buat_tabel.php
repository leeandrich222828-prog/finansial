<?php
require_once 'library/database.php';

// 1. Buat Tabel Kategori
$query1 = "CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// 2. Buat Tabel User sesuai struktur asli kamu
$query2 = "CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// 3. Buat Tabel Transaksi
$query3 = "CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `tipe` enum('masuk','keluar') NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Eksekusi Pembuatan Tabel
if (mysqli_query($koneksi, $query1) && mysqli_query($koneksi, $query2) && mysqli_query($koneksi, $query3)) {
    echo "<h3>Selamat! Semua tabel (`kategori`, `user`, `transaksi`) sukses dibuat di Railway!</h3>";
    
    // Masukkan data user bawaan leeandrich jika belum ada
    $cekUser = mysqli_query($koneksi, "SELECT * FROM `user` WHERE `email`='leeandrich222828@gmail.com'");
    if (mysqli_num_rows($cekUser) == 0) {
        $insertUser = "INSERT INTO `user` (`id`, `nama`, `email`, `password`) VALUES
        (1, 'Leeandrich', 'leeandrich222828@gmail.com', '88d4266fd4e6338d13b845fcf289579d209c897823b9217da3e161936f031589')";
        mysqli_query($koneksi, $insertUser);
        echo "<p>Data user 'Leeandrich' berhasil dimasukkan.</p>";
    }
    
    // Masukkan data kategori bawaan jika masih kosong
    $cekKategori = mysqli_query($koneksi, "SELECT * FROM `kategori`");
    if (mysqli_num_rows($cekKategori) == 0) {
        $insertKategori = "INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
        (1, 'Makan'), (2, 'Transportasi'), (3, 'Belanja'), (4, 'Listrik'), 
        (5, 'IPL'), (6, 'Parkir'), (7, 'Sinking Fund'), (8, 'Uang Bulanan'), 
        (9, 'Gaji'), (10, 'Lainnya')";
        mysqli_query($koneksi, $insertKategori);
        echo "<p>Data default kategori berhasil dimasukkan.</p>";
    }
    
    echo "<br><br><a href='login.php'>Struktur database matang! Klik di sini untuk mencoba Login kembali</a>";
} else {
    echo "Gagal memproses database: " . mysqli_error($koneksi);
}
?>