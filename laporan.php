<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
}

$id = $_SESSION['id'];

$data = mysqli_query($conn,
"SELECT * FROM laporan WHERE user_id='$id'");
?>

<link rel="stylesheet" href="assets/style.css">

<?php include 'navbar.php'; ?>

<div class="container">

<h2>Data Laporan</h2>

<table>
<tr>
    <th>No</th>
    <th>Lokasi</th>
    <th>Waktu</th>
    <th>Jumlah</th>
    <th>Status</th>
    <th>Deskripsi</th>
    <th>Foto</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;

while($d = mysqli_fetch_assoc($data)){
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $d['lokasi']; ?></td>
    <td><?php echo $d['waktu_laporan']; ?></td>
    <td><?php echo $d['jumlah_kendaraan']; ?></td>
    <td><?php echo $d['status_pelanggaran']; ?></td>
    <td><?php echo $d['deskripsi']; ?></td>

    <td>
        <img src="uploads/<?php echo $d['foto_bukti']; ?>" width="100">
    </td>

    <td>
        <a href="edit_laporan.php?id=<?php echo $d['id']; ?>">Edit</a>

        <a href="hapus_laporan.php?id=<?php echo $d['id']; ?>">
        Hapus
        </a>
    </td>
</tr>

<?php } ?>

</table>

</div>

<?php include 'footer.php'; ?>