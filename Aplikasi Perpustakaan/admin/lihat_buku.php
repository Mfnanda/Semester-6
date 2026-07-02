<?php
session_start();

// PROTEKSI HALAMAN: Hanya Admin yang boleh masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak! Anda bukan Admin.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require '../config/koneksi.php';
/** @var mysqli $koneksi */

// FITUR HAPUS PESAN BUKU TAMU
if (isset($_GET['hapus_pesan'])) {
    $id_pesan = $_GET['hapus_pesan'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM pesan_pengunjung WHERE id = '$id_pesan'");
    if ($query_hapus) {
        echo "<script>alert('Pesan berhasil dihapus!'); window.location.href='lihat_buku.php';</script>";
    }
}

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
    <title>Laporan & Buku Tamu</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="padding: 20px; max-width: 1000px; margin: 0 auto;">
    
    <h2>📊 Panel Laporan Perpustakaan</h2>
    <a href="admin_dashboard.php" style="display: inline-block; margin-bottom: 30px; text-decoration: none; color: #d9534f; font-weight: bold;">&larr; Kembali ke Dashboard</a>

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


    <h3 style="border-bottom: 2px solid #111; padding-bottom: 5px;">✉️ Daftar Pesan Pengunjung (Buku Tamu)</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Pengirim</th>
            <th>Instansi/Kampus</th>
            <th>Isi Pesan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query_pesan = mysqli_query($koneksi, "SELECT * FROM pesan_pengunjung ORDER BY id DESC");
        $no_b = 1;
        
        while ($data_b = mysqli_fetch_array($query_pesan)) {
            echo "<tr>";
            echo "<td>" . $no_b++ . "</td>";
            echo "<td>" . $data_b['nama'] . "</td>";
            echo "<td>" . $data_b['instansi'] . "</td>";
            echo "<td>" . $data_b['pesan'] . "</td>";
            echo "<td>
                    <a href='lihat_buku.php?hapus_pesan=" . $data_b['id'] . "' style='color: red;' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pesan ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
        
        if (mysqli_num_rows($query_pesan) == 0) {
            echo "<tr><td colspan='5' style='text-align: center;'>Belum ada pesan dari pengunjung.</td></tr>";
        }
        ?>
    </table>

</body>
</html>