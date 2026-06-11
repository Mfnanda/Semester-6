<?php
require 'koneksi.php';
/** @var mysqli $koneksi */

if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $pesan = $_POST['pesan'];

    $query = "INSERT INTO pesan_pengunjung (nama, instansi, pesan) VALUES ('$nama', '$instansi', '$pesan')";
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        echo "<script>alert('Terima kasih! Pesan/Pertanyaan Anda berhasil dikirim.');</script>";
    } else {
        echo "<script>alert('Maaf, pesan gagal dikirim!');</script>";
    }
}
?>

<h3>Tinggalkan Pesan / Ajukan Pertanyaan</h3>
<p>Apakah Anda mencari buku tertentu atau ingin mengajukan kerja sama dengan perpustakaan kami? Silakan tinggalkan pesan di bawah ini.</p>

<form action="" method="POST">
    Nama Lengkap: <br>
    <input type="text" name="nama" required><br><br>
    
    Asal Instansi/Kampus: <br>
    <input type="text" name="instansi" required><br><br>
    
    Pesan atau Pertanyaan: <br>
    <textarea name="pesan" rows="4" required></textarea><br><br>
    
    <input type="submit" name="kirim" value="Kirim Pesan">
</form>