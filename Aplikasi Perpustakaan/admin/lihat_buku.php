<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi halaman admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak!'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require_once __DIR__ . '/../Config/koneksi.php';

// Proses Update Status ketika tombol aksi diklik Admin
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $status_baru = '';

    if ($action == 'setujui') {
        $status_baru = 'Dipinjam';
    } elseif ($action == 'kembalikan') {
        $status_baru = 'Dikembalikan';
    }

    $update = mysqli_query($koneksi, "UPDATE peminjaman SET status='$status_baru' WHERE id='$id'");
    if ($update) {
        echo "<script>alert('Status peminjaman berhasil diperbarui!'); window.location.href='lihat_buku.php';</script>";
    }
}

// Ambil data peminjaman
$query = mysqli_query($koneksi, "SELECT * FROM peminjaman ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Buku</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="container">

<div class="card" style="margin-top: 40px;">
    <div class="flex-between">
        <h2 style="margin: 0;">Daftar Pengajuan Peminjaman Buku</h2>
        <a href="admin_dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam (User)</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Aksi Kendali</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) { 
                $cls = 'badge-warning'; // kuning
                if ($row['status'] == 'Dipinjam') $cls = 'badge-info'; // biru
                if ($row['status'] == 'Dikembalikan') $cls = 'badge-success'; // hijau
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><strong><?php echo $row['username']; ?></strong></td>
                <td><?php echo $row['judul_buku']; ?></td>
                <td><?php echo $row['tanggal_pinjam']; ?></td>
                <td><?php echo $row['tanggal_kembali']; ?></td>
                <td><span class="badge <?php echo $cls; ?>"><?php echo $row['status']; ?></span></td>
                <td>
                    <?php if ($row['status'] == 'Menunggu Persetujuan') { ?>
                        <a href="lihat_buku.php?action=setujui&id=<?php echo $row['id']; ?>" class="btn btn-primary" onclick="return confirm('Setujui dan serahkan buku fisik ke siswa?')" style="padding: 5px 10px; font-size: 12px;">✔️ Setujui</a>
                    <?php } elseif ($row['status'] == 'Dipinjam') { ?>
                        <a href="lihat_buku.php?action=kembalikan&id=<?php echo $row['id']; ?>" class="btn btn-success" onclick="return confirm('Konfirmasi bahwa buku telah dikembalikan dengan aman?')" style="padding: 5px 10px; font-size: 12px;">🔄 Kembalikan</a>
                    <?php } else { ?>
                        <span class="text-muted">Selesai</span>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>