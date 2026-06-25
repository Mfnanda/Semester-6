<?php
session_start();

// PROTEKSI HALAMAN: Cek apakah yang akses benar-benar sudah login sebagai 'admin'
// Jika belum login atau rolenya bukan admin, tendang kembali ke halaman login!
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak! Anda harus login sebagai Admin.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="padding: 20px;">
    <h2>Selamat Datang, Admin <?php echo $_SESSION['nama_lengkap']; ?>! 👑</h2>
    <p>Ini adalah halaman khusus Administrator Perpustakaan.</p>
    
    <div style="margin-top: 20px;">
        <a href="../auth/logout.php" style="padding: 8px 12px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 4px;">Logout</a>
    </div>
</body>
</html>