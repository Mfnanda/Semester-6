<h3>Tambah Koleksi Buku Baru</h3>
<p>Silakan masukkan detail buku yang ingin ditambahkan ke perpustakaan.</p>

<?php
require 'config/koneksi.php';
/** @var mysqli $koneksi */

if (isset($_POST['simpan_buku'])) {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahun = $_POST['tahun'];

    $query = "INSERT INTO buku (judul, pengarang, tahun) VALUES ('$judul', '$pengarang', '$tahun')";
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        echo "<script>
                alert('Berhasil! Buku baru telah ditambahkan.');
                window.location.href = 'index.php?menu=koleksi'; // Redirect kembali ke halaman koleksi
              </script>";
    } else {
        echo "<script>alert('Maaf, data buku gagal ditambahkan!');</script>";
    }
}
?>

<!-- Form Input Data -->
<form action="" method="POST" style="max-width: 400px;">
    Judul Buku: <br>
    <input type="text" name="judul" required><br>
    
    Pengarang: <br>
    <input type="text" name="pengarang" required><br>
    
    Tahun Terbit: <br>
    <input type="text" name="tahun" required placeholder="Contoh: 2024"><br>
    
    <input type="submit" name="simpan_buku" value="Simpan Buku">
    
    <!-- Tombol Batal untuk kembali ke halaman koleksi -->
    <a href="index.php?menu=koleksi" style="display: inline-block; margin-left: 10px; color: #d9534f; text-decoration: none;">Batal</a>
</form>