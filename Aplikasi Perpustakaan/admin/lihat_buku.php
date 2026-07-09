<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi halaman admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak!'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require '../config/koneksi.php';
/** @var mysqli $koneksi */

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
<body style="padding: 20px; font-family: sans-serif; background-color: #f4f4f4;">

<div style="max-width: 1000px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Daftar Pengajuan Peminjaman Buku</h2>
        <a href="admin_dashboard.php" style="padding: 8px 15px; background-color: #333; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px;">Kembali ke Dashboard</a>
    </div>
    <hr style="border: 1px solid #eee; margin-bottom: 20px;">

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background-color: #f2f2f2;">
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
                // Tentukan warna label status agar menarik
                $color = '#f0ad4e'; // kuning untuk Menunggu Persetujuan
                if ($row['status'] == 'Dipinjam') $color = '#5bc0de'; // biru
                if ($row['status'] == 'Dikembalikan') $color = '#5cb85c'; // hijau
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><strong><?php echo $row['username']; ?></strong></td>
                <td><?php echo $row['judul_buku']; ?></td>
                <td><?php echo $row['tanggal_pinjam']; ?></td>
                <td><?php echo $row['tanggal_kembali']; ?></td>
                <td><span style="padding: 3px 8px; background-color: <?php echo $color; ?>; color: white; border-radius: 3px; font-size: 12px; font-weight: bold;"><?php echo $row['status']; ?></span></td>
                <td>
                    <?php if ($row['status'] == 'Menunggu Persetujuan') { ?>
                        <a href="lihat_buku.php?action=setujui&id=<?php echo $row['id']; ?>" onclick="return confirm('Setujui dan serahkan buku fisik ke siswa?')" style="color: blue; font-weight: bold; text-decoration: none; font-size: 14px;">✔️ Setujui & Pinjamkan</a>
                    <?php } elseif ($row['status'] == 'Dipinjam') { ?>
                        <a href="lihat_buku.php?action=kembalikan&id=<?php echo $row['id']; ?>" onclick="return confirm('Konfirmasi bahwa buku telah dikembalikan dengan aman?')" style="color: green; font-weight: bold; text-decoration: none; font-size: 14px;">🔄 Tandai Dikembalikan</a>
                    <?php } else { ?>
                        <span style="color: #999; font-size: 14px;">Selesai</span>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>