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
    <p>Selamat datang di area khusus pengunjung perpustakaan. Apa yang ingin Anda lakukan hari ini?</p>
    
    <div style="margin: 20px 0; padding: 20px; background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 5px; max-width: 500px;">
        <h3 style="margin-top: 0; border-bottom: 1px solid #ccc; padding-bottom: 10px;">Menu Pengunjung</h3>
        
        <ul style="list-style-type: none; padding: 0; line-height: 2;">
            <li>
                📖 <a href="../index.php?menu=koleksi" style="text-decoration: none; color: blue; font-weight: bold;">Cari & Lihat Koleksi Buku</a>
                <br><small style="color: #666; margin-left: 25px;">(Tombol Edit/Hapus tidak akan muncul di sini)</small>
            </li>
            <li>
                ✍️ <a href="../index.php?menu=pinjam" style="text-decoration: none; color: blue; font-weight: bold;">Isi Form Peminjaman Buku</a>
            </li>
            <li>
                🏠 <a href="../index.php" style="text-decoration: none; color: blue; font-weight: bold;">Kembali ke Halaman Utama</a>
            </li>
        </ul>
    </div>
    
    <div style="margin-top: 30px;">
        <a href="../auth/logout.php" style="padding: 8px 12px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 4px;">Logout</a>
    </div>
</body>
</html>