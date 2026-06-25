<?php
session_start();

// PROTEKSI HALAMAN: Hanya Admin yang boleh masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak! Anda bukan Admin.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require '../config/koneksi.php';
/** @var mysqli $koneksi */

// FITUR HAPUS PESAN
if (isset($_GET['hapus'])) {
    $id_pesan = $_GET['hapus'];
    $query_hapus = "DELETE FROM pesan_pengunjung WHERE id = '$id_pesan'";
    $hapus = mysqli_query($koneksi, $query_hapus);
    
    if ($hapus) {
        echo "<script>alert('Pesan berhasil dihapus!'); window.location.href='lihat_buku.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Buku Tamu</title>
    <!-- Memanggil CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="padding: 20px; max-width: 900px; margin: 0 auto;">
    
    <h2>✉️ Daftar Pesan Pengunjung</h2>
    <a href="admin_dashboard.php" style="display: inline-block; margin-bottom: 20px; text-decoration: none; color: #d9534f; font-weight: bold;">&larr; Kembali ke Dashboard</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pengirim</th>
            <th>Instansi/Kampus</th>
            <th>Isi Pesan</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Mengambil data dari tabel pesan_pengunjung
        $query = mysqli_query($koneksi, "SELECT * FROM pesan_pengunjung ORDER BY id DESC");
        $no = 1;
        
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $data['nama'] . "</td>";
            echo "<td>" . $data['instansi'] . "</td>";
            echo "<td>" . $data['pesan'] . "</td>";
            echo "<td>
                    <a href='lihat_buku.php?hapus=" . $data['id'] . "' style='color: red;' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pesan ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
        
        // Jika belum ada pesan yang masuk
        if (mysqli_num_rows($query) == 0) {
            echo "<tr><td colspan='5' style='text-align: center;'>Belum ada pesan dari pengunjung.</td></tr>";
        }
        ?>
    </table>

</body>
</html>