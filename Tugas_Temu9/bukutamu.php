<?php
// Panggil file koneksi yang baru saja dibuat
require 'koneksi.php';
/** @var mysqli $koneksi */

// Cek apakah tombol "Kirim Pesan" sudah ditekan
if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $pesan = $_POST['pesan'];

    // Buat query untuk memasukkan data ke database
    $query = "INSERT INTO pesan_pengunjung (nama, instansi, pesan) VALUES ('$nama', '$instansi', '$pesan')";
    $simpan = mysqli_query($koneksi, $query);

    // Beri notifikasi apakah berhasil atau gagal
    if ($simpan) {
        echo "<script>alert('Terima kasih! Pesan/Pertanyaan Anda berhasil dikirim.');</script>";
    } else {
        echo "<script>alert('Maaf, pesan gagal dikirim!');</script>";
    }
}
?>

<!-- Tampilan Form HTML -->
<h3>Tinggalkan Pesan / Ajukan Pertanyaan</h3>
<p>Apakah Anda mencari buku tertentu atau ingin mengajukan kerja sama dengan perpustakaan kami? Silakan tinggalkan pesan di bawah ini.</p>

<form action="" method="POST">
    Nama Lengkap: <br>
    <input type="text" name="nama" required><br><br>
    
    Asal Instansi/Kampus: <br>
    <input type="text" name="instansi" required><br><br>
    
    Pesan atau Pertanyaan: <br>
    <textarea name="pesan" rows="4" required></textarea><br><br>
    
    <!-- Perhatikan name="kirim" ini yang ditangkap oleh PHP di atas -->
    <input type="submit" name="kirim" value="Kirim Pesan">
</form>