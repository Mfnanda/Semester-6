<?php
session_start();
require_once __DIR__ . '/Config/koneksi.php';
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
    <title>Membaca: <?php echo htmlspecialchars($data['judul']); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container" style="max-width: 900px; padding-top: 30px;">
        <a href="index.php?menu=koleksi" class="btn btn-secondary" style="margin-bottom: 20px;">← Kembali ke Koleksi</a>

        <div class="card">
            <h2 style="margin-bottom: 8px;"><?php echo htmlspecialchars($data['judul']); ?></h2>
            <p class="text-muted" style="margin-top: 0;">Penulis: <?php echo htmlspecialchars($data['pengarang']); ?></p>
            <hr>
            <div style="text-align: justify; line-height: 1.8; margin-top: 20px;">
                <?php echo nl2br(htmlspecialchars($data['isi_buku'])); ?>
            </div>
        </div>
    </div>
</body>
</html>