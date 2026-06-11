<?php
require 'koneksi.php';
/** @var mysqli $koneksi */

if (isset($_POST['pinjam'])) {
    $nama = $_POST['nama_peminjam'];
    $buku = $_POST['judul_buku'];
    $tanggal = $_POST['tanggal_pinjam'];

    // Memasukkan data ke tabel peminjaman
    $simpan = mysqli_query($koneksi, "INSERT INTO peminjaman (nama_peminjam, judul_buku, tanggal_pinjam) VALUES ('$nama', '$buku', '$tanggal')");

    if ($simpan) {
        echo "<script>alert('Berhasil! Data peminjaman telah dicatat.');</script>";
    } else {
        echo "<script>alert('Gagal mencatat peminjaman.');</script>";
    }
}
?>

<h3>Form Peminjaman Buku</h3>
<form action="" method="POST">
    Nama Lengkap: 
    <input type="text" name="nama_peminjam" required>
    
    Judul Buku yang Dipinjam: 
    <input type="text" name="judul_buku" required>
    
    Tanggal Pinjam: 
    <input type="date" name="tanggal_pinjam" required>
    
    <input type="submit" name="pinjam" value="Catat Peminjaman">
</form>