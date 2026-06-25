<?php
session_start();

// PROTEKSI HALAMAN: Cek apakah yang akses benar-benar 'user'
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    echo "<script>alert('Akses Ditolak! Silakan login terlebih dahulu.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Portal Pengunjung</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="padding: 20px;">
    <h2>Halo, <?php echo $_SESSION['nama_lengkap']; ?>! 👋</h2>
    <p>Selamat datang di area khusus pengunjung perpustakaan.</p>
    
    <div style="margin-top: 20px;">
        <a href="../auth/logout.php" style="padding: 8px 12px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 4px;">Logout</a>
    </div>
</body>
</html>