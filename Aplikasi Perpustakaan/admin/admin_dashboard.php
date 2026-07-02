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
<body style="padding: 20px; font-family: sans-serif; background-color: #f4f4f4;">

<div style="max-width: 1000px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
        <h2 style="color: #333; margin: 0;">Selamat Datang, Admin <?php echo $_SESSION['nama_lengkap']; ?>! 👑</h2>
        <a href="../auth/logout.php" style="padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Logout</a>
    </div>

    <p style="color: #666; margin-bottom: 30px;">Gunakan panel kendali di bawah ini untuk mengelola operasional perpustakaan.</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
        <?php
        $menus = [
            ['Kelola Buku', '../index.php?menu=koleksi', '📚'],
            ['Laporan Peminjaman', 'lihat_buku.php', '📊'],
            ['Kelola Pengguna', 'kelola_user.php', '👥'],
            ['Lihat Halaman Publik', '../index.php', '🏠']
        ];

        foreach ($menus as $m) {
            echo '<a href="'.$m[1].'" style="text-decoration: none; color: inherit;">
                    <div style="padding: 20px; border-radius: 10px; background: #fafafa; border: 1px solid #ccc; text-align: center; transition: 0.3s;">
                        <div style="font-size: 30px; margin-bottom: 10px;">'.$m[2].'</div>
                        <h4 style="margin: 0;">'.$m[0].'</h4>
                    </div>
                  </a>';
        }
        ?>
    </div>
</div>

</body>
</html>