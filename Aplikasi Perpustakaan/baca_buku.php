<?php
session_start();
require 'config/koneksi.php';
/** @var mysqli $koneksi */

// Cek apakah user sudah login
if (!isset($_SESSION['role'])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location.href='index.php?menu=login';</script>";
    exit();
}

// Ambil ID buku dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = '$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Membaca: <?php echo $data['judul']; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="padding: 40px; line-height: 1.8; font-family: sans-serif;">
    <a href="index.php?menu=koleksi" style="color: #666;">&larr; Kembali ke Koleksi</a>
    
    <div style="margin-top: 20px; max-width: 800px; margin-left: auto; margin-right: auto; background: #fff; padding: 40px; border: 1px solid #ddd;">
        <h1 style="color: #204d74;"><?php echo $data['judul']; ?></h1>
        <p style="color: #888;">Penulis: <?php echo $data['pengarang']; ?></p>
        <hr>
        <div style="text-align: justify; margin-top: 30px;">
            <?php echo nl2br($data['isi_buku']); ?> </div>
    </div>
</body>
</html>