<?php
// Memanggil koneksi database
require 'koneksi.php';

// Mengecek apakah ada parameter 'id' yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    // Menangkap nilai ID dari URL
    $id = $_GET['id'];

    // Query untuk menghapus data dari tabel buku berdasarkan ID
    $query = "DELETE FROM buku WHERE id = '$id'";
    $hapus = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil dijalankan
    if ($hapus) {
        echo "<script>
                alert('Berhasil! Data buku telah dihapus.');
                window.location.href = 'index.php?menu=koleksi'; // Kembali ke halaman koleksi
              </script>";
    } else {
        echo "<script>
                alert('Maaf, data gagal dihapus.');
                window.location.href = 'index.php?menu=koleksi';
              </script>";
    }
} else {
    // Jika tidak ada parameter ID (mengakses langsung tanpa klik tombol), kembalikan ke halaman koleksi
    header("Location: index.php?menu=koleksi");
    exit();
}
?>