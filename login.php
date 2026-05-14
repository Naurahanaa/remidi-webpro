<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    if(empty($email) || empty($password)) {
        echo "Field tidak boleh kosong";
    } else {
        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");

        $data = mysqli_num_rows($query);

        if($data > 0) {
            $user = mysqli_fetch_assoc($query);

            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];

            header("Location: dashboard.php");
        } else {
             echo "Login gagal";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container auth-box">
    <h2>Login</h2>

    <form method="POST">
        <input type="email" name="email" class="form-control mb-3" placeholder="Email">

        <input type="password" name="password" class="form-control mb-3" placeholder="Password">

        <button type="submit" name="login" class="btn btn-success">Login</button><a href="dashboard.php"></a>
    </form>

    <a href="register.php">Belum punya akun?</a>
</div>
</body>
</html> 