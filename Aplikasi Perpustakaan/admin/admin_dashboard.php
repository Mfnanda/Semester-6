<?php
session_start();

// PROTEKSI HALAMAN
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
    <p>Ini adalah halaman khusus Administrator Perpustakaan. Silakan pilih menu di bawah ini untuk mengelola sistem.</p>
    
    <div style="margin: 20px 0; padding: 20px; background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 5px; max-width: 500px;">
        <h3 style="margin-top: 0; border-bottom: 1px solid #ccc; padding-bottom: 10px;">Panel Kendali</h3>
        
        <ul style="list-style-type: none; padding: 0; line-height: 2;">
            <li>
                📚 <a href="../index.php?menu=koleksi" style="text-decoration: none; color: blue; font-weight: bold;">Kelola Koleksi Buku</a>
                <br><small style="color: #666; margin-left: 25px;">(Tambah, Edit, dan Hapus Buku)</small>
            </li>
            <li>
                ✉️ <a href="lihat_buku.php" style="text-decoration: none; color: blue; font-weight: bold;">Lihat Buku Tamu</a>
                <br><small style="color: #666; margin-left: 25px;">(Baca dan hapus pesan dari pengunjung)</small>
            </li>
            <li>
                👥 <a href="kelola_user.php" style="text-decoration: none; color: blue; font-weight: bold;">Kelola Pengguna</a>
                <br><small style="color: #666; margin-left: 25px;">(Tambah dan hapus akun Admin/User)</small>
            </li>
            <li>
                🏠 <a href="../index.php" style="text-decoration: none; color: blue; font-weight: bold;">Lihat Halaman Publik</a>
                <br><small style="color: #666; margin-left: 25px;">(Kembali ke tampilan pengunjung utama)</small>
            </li>
        </ul>
    </div>
    
    <div style="margin-top: 30px;">
        <a href="../auth/logout.php" style="padding: 8px 12px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 4px;">Logout</a>
    </div>
</body>
</html>