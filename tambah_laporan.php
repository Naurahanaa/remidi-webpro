<?php
session_start();
include 'koneksi.php';

if(isset($_POST['simpan'])){

    $user_id = $_SESSION['id'];
    $lokasi = $_POST['lokasi'];
    $waktu = $_POST['waktu'];
    $jumlah = $_POST['jumlah'];
    $deskripsi = $_POST['deskripsi'];

    if($jumlah >= 1 && $jumlah <= 5){
        $status = "Ringan";
    } elseif($jumlah >= 6 && $jumlah <= 15){
        $status = "Sedang";
    } else {
        $status = "Berat";
    }

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "uploads/".$foto);

    mysqli_query($conn,
    "INSERT INTO laporan
    VALUES(
    '',
    '$user_id',
    '$lokasi',
    '$waktu',
    '$jumlah',
    '$status',
    '$deskripsi',
    '$foto'
    )");

    header("Location: laporan.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Laporan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2>Tambah Laporan</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="lokasi" placeholder="Masukkan Lokasi" class="form-control mb-3">

        <input type="datetime-local" name="waktu_laporan" class="form-control mb-3">

        <input type="number" name="jumlah_kendaraan" placeholder="Jumlah Kendaraan" class="form-control mb-3">

        <textarea name="deskripsi" placeholder="Deskripsi Laporan" class="form-control mb-3"></textarea>

        <input type="file" name="foto_bukti" class="form-control mb-3">

        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html> 