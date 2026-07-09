<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PROTEKSI HALAMAN
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    echo "<script>alert('Akses Ditolak! Silakan login terlebih dahulu.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require_once __DIR__ . '/../Config/koneksi.php';
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
</head>
<body class="container">

<div class="card">
    <div class="flex-between">
        <div>
            <h2 style="margin-bottom: 6px;">Halo, <?php echo htmlspecialchars($username_aktif); ?>! 👋</h2>
            <p style="margin: 0;">Selamat datang di ruang baca pribadi Anda.</p>
        </div>
        <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="grid-2">
        <div class="stat-card bg-purple">
            <h3><?php echo $total_riwayat; ?></h3>
            <p>📚 Riwayat Peminjaman</p>
        </div>
        <div class="stat-card bg-teal">
            <h3><?php echo $buku_dipegang; ?></h3>
            <p>📖 Buku Dipinjam</p>
        </div>
    </div>

    <h3 style="margin-top: 22px;">Mulai Aktivitas</h3>
    <div class="grid-2">
        <a href="../index.php?menu=koleksi" class="card text-center" style="margin-bottom: 0;">
            <h3>📖 Eksplorasi Koleksi</h3>
            <p class="text-muted">Cari dan baca buku favoritmu.</p>
        </a>
        <a href="form_pinjam.php" class="card text-center" style="margin-bottom: 0;">
            <h3>✍️ Pinjam Buku Baru</h3>
            <p class="text-muted">Isi form reservasi fisik.</p>
        </a>
    </div>

    <div class="card" style="margin-top: 20px;">
        <h3>Status Buku Saya</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query_riwayat = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE username='$username_aktif' ORDER BY id DESC LIMIT 5");
                if (mysqli_num_rows($query_riwayat) > 0) {
                    while ($row = mysqli_fetch_assoc($query_riwayat)) { 
                        $cls = 'badge-warning';
                        if ($row['status'] == 'Dipinjam') $cls = 'badge-info';
                        if ($row['status'] == 'Dikembalikan') $cls = 'badge-success';
                ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($row['judul_buku']); ?></strong></td>
                    <td><?php echo $row['tanggal_pinjam']; ?></td>
                    <td><?php echo $row['tanggal_kembali']; ?></td>
                    <td><span class="badge <?php echo $cls; ?>"><?php echo $row['status']; ?></span></td>
                </tr>
                <?php 
                    } 
                } else {
                    echo "<tr><td colspan='4' class='text-center text-muted'>Belum ada riwayat.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>