<?php
// Logika PHP untuk menyimpan pesan ke database
if (isset($_POST['kirim_pesan'])) {
    require 'config/koneksi.php';
    /** @var mysqli $koneksi */
    
    $nama = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $pesan = $_POST['pesan'];
    
    $query = mysqli_query($koneksi, "INSERT INTO pesan_pengunjung (nama, instansi, pesan) VALUES ('$nama', '$instansi', '$pesan')");
    
    if ($query) {
        echo "<script>alert('Terima kasih! Pesan Anda berhasil dikirim.'); window.location.href='index.php?menu=kontak';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pesan.');</script>";
    }
}
?>

<h2>Kontak Kami</h2>
<p>Jika Anda memiliki pertanyaan atau ingin mengajukan kerja sama, silakan hubungi kami melalui informasi di bawah ini atau isi formulir yang tersedia.</p>

<div style="background-color: #f4f4f4; padding: 15px; border: 1px solid #ccc; margin-bottom: 20px;">
    <h4 style="margin-top: 0;">Informasi Perpustakaan</h4>
    <p style="margin: 5px 0;"><strong>Alamat:</strong> Jl. Pendidikan No. 1, Jakarta Raya</p>
    <p style="margin: 5px 0;"><strong>Email:</strong> perpus@kampus.com</p>
    <p style="margin: 5px 0;"><strong>Telepon:</strong> 0812-3456-7890</p>
    <p style="margin: 5px 0;"><strong>Jam Operasional:</strong> Senin - Jumat (08:00 - 16:00 WIB)</p>
</div>

<div style="border: 1px solid #ccc; padding: 20px;">
    <h3 style="margin-top: 0;">Tinggalkan Pesan</h3>
    <form action="" method="POST">
        <p>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama" required style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;">
        </p>
        <p>
            <label>Asal Instansi/Kampus:</label><br>
            <input type="text" name="instansi" required style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;">
        </p>
        <p>
            <label>Pesan atau Pertanyaan:</label><br>
            <textarea name="pesan" rows="5" required style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;"></textarea>
        </p>
        <p style="margin-bottom: 0;">
            <input type="submit" name="kirim_pesan" value="Kirim Pesan" style="padding: 10px 20px; background-color: #111; color: white; border: none; cursor: pointer;">
        </p>
    </form>
</div>