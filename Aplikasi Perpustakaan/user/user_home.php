<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PROTEKSI HALAMAN
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    echo "<script>alert('Akses Ditolak! Silakan login terlebih dahulu.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require '../config/koneksi.php';
/** @var mysqli $koneksi */

$username_aktif = $_SESSION['username'];

// Mengambil Data Statistik Pribadi User
$query_total = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE username='$username_aktif'");
$total_riwayat = mysqli_num_rows($query_total);

$query_aktif = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE username='$username_aktif' AND status='Dipinjam'");
$buku_dipegang = mysqli_num_rows($query_aktif);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Portal Pengunjung</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .stat-card { padding: 20px; border-radius: 8px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .stat-card h3 { margin: 0; font-size: 28px; }
        .stat-card p { margin: 5px 0 0 0; font-size: 14px; opacity: 0.9; }
        .bg-purple { background: linear-gradient(135deg, #6f42c1, #4c2889); }
        .bg-teal { background: linear-gradient(135deg, #20c997, #138462); }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 20px; }
        .menu-item { background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #ddd; text-align: center; color: #333; text-decoration: none; transition: 0.2s; }
        .menu-item:hover { background: #e9ecef; transform: translateY(-3px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .status-badge { padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; color: white; }
    </style>
</head>
<body style="padding: 20px; font-family: sans-serif; background-color: #f4f7f6;">

<div style="max-width: 900px; margin: 0 auto; background: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
        <div>
            <h2 style="color: #2c3e50; margin: 0;">Halo, <?php echo $username_aktif; ?>! 👋</h2>
            <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 14px;">Selamat datang di ruang baca pribadimu.</p>
        </div>
        <a href="../auth/logout.php" style="padding: 10px 20px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Logout</a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card bg-purple">
            <h3><?php echo $total_riwayat; ?></h3>
            <p>📚 Total Riwayat Peminjaman</p>
        </div>
        <div class="stat-card bg-teal">
            <h3><?php echo $buku_dipegang; ?></h3>
            <p>📖 Buku Sedang Dipinjam</p>
        </div>
    </div>

    <h3 style="color: #2c3e50; margin-bottom: 10px;">Mulai Aktivitas Literasi</h3>
    <div class="menu-grid">
        <a href="../index.php?menu=koleksi" class="menu-item">
            <h3 style="margin-top:0;">📖 Eksplorasi Koleksi</h3>
            <p style="font-size: 14px; color: #555; margin-bottom:0;">Cari dan baca sinopsis buku favoritmu.</p>
        </a>
        <a href="form_pinjam.php" class="menu-item">
            <h3 style="margin-top:0;">✍️ Pinjam Buku Baru</h3>
            <p style="font-size: 14px; color: #555; margin-bottom:0;">Isi form untuk reservasi buku fisik.</p>
        </a>
    </div>

    <div style="margin-top: 40px;">
        <h3 style="color: #2c3e50; border-bottom: 2px solid #eee; padding-bottom: 10px;">Status Buku Saya</h3>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left; margin-top: 15px;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Menampilkan 5 riwayat terbaru milik user ini saja
                $query_riwayat = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE username='$username_aktif' ORDER BY id DESC LIMIT 5");
                if (mysqli_num_rows($query_riwayat) > 0) {
                    while ($row = mysqli_fetch_assoc($query_riwayat)) { 
                        // Atur warna badge
                        $bg = '#f0ad4e'; // Kuning untuk pending
                        if ($row['status'] == 'Dipinjam') $bg = '#5bc0de'; // Biru
                        if ($row['status'] == 'Dikembalikan') $bg = '#5cb85c'; // Hijau
                ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($row['judul_buku']); ?></strong></td>
                    <td><?php echo $row['tanggal_pinjam']; ?></td>
                    <td><?php echo $row['tanggal_kembali']; ?></td>
                    <td><span class="status-badge" style="background-color: <?php echo $bg; ?>;"><?php echo $row['status']; ?></span></td>
                </tr>
                <?php 
                    } 
                } else {
                    echo "<tr><td colspan='4' style='text-align: center; color: #888;'>Belum ada riwayat peminjaman buku.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>