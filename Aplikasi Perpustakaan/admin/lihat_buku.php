<?php
session_start();

// PROTEKSI HALAMAN: Hanya Admin yang boleh masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak! Anda bukan Admin.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require '../config/koneksi.php';
/** @var mysqli $koneksi */

// FITUR HAPUS CATATAN PEMINJAMAN
if (isset($_GET['hapus_pinjam'])) {
    $id_pinjam = $_GET['hapus_pinjam'];
    $query_hapus_pinjam = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id = '$id_pinjam'");
    if ($query_hapus_pinjam) {
        echo "<script>alert('Catatan peminjaman berhasil dihapus!'); window.location.href='lihat_buku.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="padding: 20px; max-width: 1000px; margin: 0 auto;">
    
    <h2>📊 Panel Laporan Peminjaman</h2>
    <a href="admin_dashboard.php" style="display: inline-block; margin-bottom: 30px; text-decoration: none; color: #d9534f; font-weight: bold;">&larr; Kembali ke Dashboard</a>

    <!-- TABEL: DAFTAR PEMINJAMAN BUKU -->
    <h3 style="border-bottom: 2px solid #111; padding-bottom: 5px;">📖 Daftar Peminjaman Buku Aktif</h3>
    <table style="margin-bottom: 40px;">
        <tr>
            <th>No</th>
            <th>NPM / No. Anggota</th>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query_pinjam = mysqli_query($koneksi, "SELECT * FROM peminjaman ORDER BY id DESC");
        $no_p = 1;
        
        while ($data_p = mysqli_fetch_array($query_pinjam)) {
            echo "<tr>";
            echo "<td>" . $no_p++ . "</td>";
            echo "<td>" . $data_p['nomor_anggota'] . "</td>";
            echo "<td>" . $data_p['nama_peminjam'] . "</td>";
            echo "<td>" . $data_p['judul_buku'] . "</td>";
            echo "<td>" . $data_p['tanggal_pinjam'] . "</td>";
            echo "<td>" . $data_p['tanggal_kembali'] . "</td>";
            echo "<td>
                    <a href='lihat_buku.php?hapus_pinjam=" . $data_p['id'] . "' style='color: red;' onclick='return confirm(\"Hapus catatan peminjaman ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
        
        if (mysqli_num_rows($query_pinjam) == 0) {
            echo "<tr><td colspan='7' style='text-align: center;'>Belum ada data peminjaman buku.</td></tr>";
        }
        ?>
    </table>

</body>
</html>