<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once('library/database.php');
    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(empty($nama) || empty($email) || empty($password)){
            $error = "Semua field harus diisi!";
        } else {
            $cekEmail = "SELECT * FROM user WHERE email='".$email."'";
            $resultCek = $koneksi->query($cekEmail);
            
            if($resultCek->num_rows > 0){
                $error = "Email sudah terdaftar, gunakan email lain!";
            } else {
                $password = hash('sha256', $password);
                $sql = "INSERT INTO user (nama, email, password) VALUES ('".$nama."','".$email."','".$password."')";
                $koneksi->query($sql);
                header("location: login.php");
            }
        }
    }
?>
<html>
    <?php include 'library/header.php'; ?>
    <body>
        <div class="auth-wrapper">
            <div class="auth-card">
                <span class="auth-brand">Finansial</span>
                <h2 class="auth-title">Daftar</h2>
                <p class="auth-subtitle">Buat akun baru untuk mulai mencatat.</p>
                <form method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" placeholder="Masukkan nama lengkap" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Masukkan email" name="email" required>
                    </div>
                    <?php if(isset($error)): ?>
                        <p class="error-msg"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Masukkan password" name="password" required>
                    </div>
                    <button type="submit" class="auth-submit" name="submit">Daftar</button>
                </form>
                <p class="auth-link">Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
            </div>
        </div>
    </body>
</html>