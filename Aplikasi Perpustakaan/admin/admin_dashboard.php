<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PROTEKSI HALAMAN
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak! Anda harus login sebagai Admin.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require_once __DIR__ . '/../Config/koneksi.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="flex-between">
            <div>
                <h2 class="main-title">Dashboard Admin</h2>
                <p class="subtle-title">Selamat datang kembali, <strong><?php echo $_SESSION['username']; ?></strong>.</p>
            </div>
            <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="grid-4">
            <div class="stat-card bg-blue">
                <h3><?php echo $jml_buku; ?></h3>
                <p>📚 Total Buku</p>
            </div>
            <div class="stat-card bg-green">
                <h3><?php echo $jml_user; ?></h3>
                <p>👥 Total Anggota</p>
            </div>
            <div class="stat-card bg-orange">
                <h3><?php echo $pinjam_aktif; ?></h3>
                <p>📖 Sedang Dipinjam</p>
            </div>
            <div class="stat-card bg-red">
                <h3><?php echo $menunggu; ?></h3>
                <p>⏳ Menunggu</p>
            </div>
        </div>

        <h3 style="margin-top: 24px;">Aksi Cepat</h3>
        <div class="grid-4">
            <a href="../index.php?menu=koleksi" class="card text-center" style="margin-bottom: 0;">📚 Kelola Buku</a>
            <a href="lihat_buku.php" class="card text-center" style="margin-bottom: 0;">📋 Laporan Pinjam</a>
            <a href="kelola_user.php" class="card text-center" style="margin-bottom: 0;">👥 Kelola Pengguna</a>
            <a href="../index.php" class="card text-center" style="margin-bottom: 0;">🏠 Halaman Publik</a>
        </div>

        <div class="card" style="margin-top: 20px;">
            <h3>Pengajuan Terbaru</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query_pending = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='Menunggu Persetujuan' ORDER BY id DESC LIMIT 3");
                    if (mysqli_num_rows($query_pending) > 0) {
                        while ($row = mysqli_fetch_assoc($query_pending)) { 
                    ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($row['username']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['judul_buku']); ?></td>
                        <td><?php echo htmlspecialchars($row['tanggal_pinjam']); ?></td>
                        <td><a href="lihat_buku.php">Proses →</a></td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='4' class='text-center text-muted'>Tidak ada pengajuan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>