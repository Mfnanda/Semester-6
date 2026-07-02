<?php
session_start();

// PROTEKSI HALAMAN
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
<body style="padding: 20px; font-family: sans-serif; background-color: #f4f4f4;">

<div style="max-width: 800px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
        <h2 style="color: #333; margin: 0;">Halo, <?php echo $_SESSION['nama_lengkap']; ?>! 👋</h2>
        <a href="../auth/logout.php" style="padding: 10px 20px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Logout</a>
    </div>

    <p style="color: #666; margin-bottom: 30px;">Selamat datang di area khusus pengunjung. Silakan pilih menu di bawah ini untuk memulai aktivitas literasi Anda.</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <a href="../index.php?menu=koleksi" style="text-decoration: none; color: inherit;">
            <div style="padding: 20px; border-radius: 10px; background: #fafafa; border: 1px solid #ddd; transition: 0.3s;">
                <h3 style="margin-top:0;">📖 Koleksi Buku</h3>
                <p style="font-size: 14px; color: #555;">Jelajahi ribuan judul buku dan baca sinopsis lengkapnya di sini.</p>
            </div>
        </a>

        <a href="../index.php?menu=pinjam" style="text-decoration: none; color: inherit;">
            <div style="padding: 20px; border-radius: 10px; background: #fafafa; border: 1px solid #ddd; transition: 0.3s;">
                <h3 style="margin-top:0;">✍️ Pinjam Buku</h3>
                <p style="font-size: 14px; color: #555;">Isi formulir peminjaman untuk melakukan reservasi buku fisik.</p>
            </div>
        </a>
    </div>
</div>

</body>
</html>