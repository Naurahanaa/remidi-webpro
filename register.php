<?php
session_start();
include 'koneksi.php';

if(isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($nama) || empty($email) || empty($password)) {
        echo "Semua field wajib diisi";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid";
    } elseif(strlen($password) < 6) {
        echo "Password minimal 6 karakter";
    } else {
        $password = md5($password);
        mysqli_query($conn, "INSERT INTO users VALUES('', '$nama', '$email', '$password')");

        echo "Registrasi berhasil";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container auth-box">
    <h2>Register</h2>

    <form method="POST">
        <input type="text" name="nama" class="form-control mb-3" placeholder="Nama">

        <input type="email" name="email" class="form-control mb-3" placeholder="Email">

        <input type="password" name="password" class="form-control mb-3" placeholder="Password">

        <button type="submit" name="register" class="btn btn-primary">Register</button>
    </form>

    <a href="login.php">Sudah punya akun?</a>
</div>
</body>
</html> 