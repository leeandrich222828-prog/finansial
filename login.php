<?php 
    session_start();
    require_once('library/database.php');
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);
        $sql = "SELECT * FROM user where email='".$email."' and password= '".$password."'";
        $result = $connection->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['id'] = $row['id'];
            header('location: index.php');
            }else{
                echo "<script>alert('Email atau password salah.');</script>";
                }
        if(empty($nama) || empty($email) || empty($password)){
            $error = "Semua field harus diisi!";
        } else {
            $password = hash('sha256', $password);
            $sql = "INSERT INTO user (nama, email, password) VALUES ('".$nama."','".$email."','".$password."')";
            $connection->query($sql);
            header("location: login.php");
        }

    }
?>
<html>
    <?php include 'library/header.php'; ?>
    <body>
        <div class="auth-wrapper">
            <div class="auth-card">
                <span class="auth-brand">Finansial</span>
                <h2 class="auth-title">Masuk</h2>
                <p class="auth-subtitle">Selamat datang kembali!</p>
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Masukkan email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Masukkan password" name="password" required>
                    </div>
                    <button type="submit" class="auth-submit" name="submit">Masuk</button>
                </form>
                <p class="auth-link">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </div>
        </div>
    </body>
</html>