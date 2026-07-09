<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PROTEKSI HALAMAN
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak! Anda harus login sebagai Admin.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require '../config/koneksi.php';
/** @var mysqli $koneksi */

// Mengambil Data Statistik untuk Dashboard
$jml_buku = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
$jml_user = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE role='user'"));
$pinjam_aktif = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='Dipinjam'"));
$menunggu = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='Menunggu Persetujuan'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .stat-card { padding: 20px; border-radius: 8px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .stat-card h3 { margin: 0; font-size: 28px; }
        .stat-card p { margin: 5px 0 0 0; font-size: 14px; opacity: 0.9; }
        .bg-blue { background: linear-gradient(135deg, #007bff, #0056b3); }
        .bg-green { background: linear-gradient(135deg, #28a745, #1e7e34); }
        .bg-orange { background: linear-gradient(135deg, #fd7e14, #e8590c); }
        .bg-red { background: linear-gradient(135deg, #dc3545, #c82333); }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 30px; }
        .menu-item { background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #ddd; text-align: center; color: #333; text-decoration: none; transition: 0.2s; font-weight: bold; }
        .menu-item:hover { background: #e9ecef; transform: translateY(-2px); }
    </style>
</head>
<body style="padding: 20px; font-family: sans-serif; background-color: #f4f7f6;">

<div style="max-width: 1000px; margin: 0 auto; background: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
        <div>
            <h2 style="color: #2c3e50; margin: 0;">Dashboard Admin </h2>
            <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 14px;">Selamat datang kembali, <strong><?php echo $_SESSION['username']; ?></strong>. Berikut adalah ringkasan sistem hari ini.</p>
        </div>
        <a href="../auth/logout.php" style="padding: 10px 20px; background-color: #34495e; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Logout</a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card bg-blue">
            <h3><?php echo $jml_buku; ?></h3>
            <p>📚 Total Judul Buku</p>
        </div>
        <div class="stat-card bg-green">
            <h3><?php echo $jml_user; ?></h3>
            <p>👥 Total Anggota</p>
        </div>
        <div class="stat-card bg-orange">
            <h3><?php echo $pinjam_aktif; ?></h3>
            <p>📖 Buku Sedang Dipinjam</p>
        </div>
        <div class="stat-card bg-red">
            <h3><?php echo $menunggu; ?></h3>
            <p>⏳ Menunggu Persetujuan</p>
        </div>
    </div>

    <h3 style="color: #2c3e50; margin-bottom: 10px;">Aksi Cepat</h3>
    <div class="menu-grid">
        <a href="../index.php?menu=koleksi" class="menu-item">📚 Kelola Buku</a>
        <a href="lihat_buku.php" class="menu-item">📋 Laporan Peminjaman</a>
        <a href="kelola_user.php" class="menu-item">👥 Kelola Pengguna</a>
        <a href="../index.php" class="menu-item">🏠 Halaman Publik</a>
    </div>

    <div style="margin-top: 40px;">
        <h3 style="color: #2c3e50; border-bottom: 2px solid #eee; padding-bottom: 10px;">Pengajuan Peminjaman Terbaru (Butuh Proses)</h3>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left; margin-top: 15px;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th>Username</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Hanya menampilkan 3 pengajuan terbaru yang berstatus Menunggu
                $query_pending = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='Menunggu Persetujuan' ORDER BY id DESC LIMIT 3");
                if (mysqli_num_rows($query_pending) > 0) {
                    while ($row = mysqli_fetch_assoc($query_pending)) { 
                ?>
                <tr>
                    <td><strong><?php echo $row['username']; ?></strong></td>
                    <td><?php echo $row['judul_buku']; ?></td>
                    <td><?php echo $row['tanggal_pinjam']; ?></td>
                    <td><a href="lihat_buku.php" style="color: #007bff; text-decoration: none; font-weight: bold;">Proses Sekarang →</a></td>
                </tr>
                <?php 
                    } 
                } else {
                    echo "<tr><td colspan='4' style='text-align: center; color: #888;'>Tidak ada pengajuan pinjaman baru saat ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>