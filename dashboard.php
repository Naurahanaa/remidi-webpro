<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id'])) {
    header("Location: login.php");
}

$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan"));

$ringan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan WHERE status_pelanggaran='Ringan'"));

$sedang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan WHERE status_pelanggaran='Sedang'"));

$berat = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan WHERE status_pelanggaran='Berat'"));

$terbaru = mysqli_query($conn, "SELECT * FROM laporan ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?> 👋</h2>

    <p class="subtitle">
    Berikut adalah ringkasan laporan parkir liar yang telah dicatat 🚗
    </p>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Laporan</h5>
                <h2><?php echo $total['total']; ?></h2>
            </div>
        </div>
        
            <div class="col-md-3">
    <div class="card dashboard-card p-3">
        <div class="icon-circle green">
           😊
        </div>
        <div class="card-content">
            <h5>Ringan</h5>
            <h2><?php echo $ringan['total']; ?></h2>
        </div>
    </div>    
        </div>

           <div class="col-md-3">
    <div class="card dashboard-card p-3">
        <div class="icon-circle yellow">
            😐
        </div>
        <div class="card-content">
            <h5>Sedang</h5>
            <h2><?php echo $sedang['total']; ?></h2>
        </div>
    </div>    
        </div>

       <div class="col-md-3">
    <div class="card dashboard-card p-3">
        <div class="icon-circle red">
            ☹️
        </div>
        <div class="card-content">
            <h5>Berat</h5>
            <h2><?php echo $berat['total']; ?></h2>
        </div>
    </div>    
        </div>

    </div>

    <h3 class="mt-5">📈 Laporan Terbaru</h3>

    <table class="table table-bordered">
        <tr>
            <th>Lokasi</th>
            <th>Waktu</th>
            <th>Status</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($terbaru)) { ?>
        <tr>
            <td><?php echo $row['lokasi']; ?></td>
            <td><?php echo $row['waktu_laporan']; ?></td>
            <td><?php echo $row['status_pelanggaran']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <div class="text-center mt-4">
    <a href="laporan.php" class="btn btn-primary btn-lg">
        📄 Lihat Semua Laporan
    </a>
</div>
</div>

<?php include 'footer.php'; ?>

</body>
</html> 