<?php
// Logika PHP untuk menyimpan data peminjaman ke database
if (isset($_POST['catat_pinjam'])) {
    require 'config/koneksi.php';
    /** @var mysqli $koneksi */
    
    $nama = $_POST['nama_peminjam'];
    $nomor = $_POST['nomor_anggota'];
    $judul = $_POST['judul_buku'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    
    // Pastikan kamu memiliki tabel 'peminjaman' di database dengan kolom-kolom ini
    $query = mysqli_query($koneksi, "INSERT INTO peminjaman (nama_peminjam, nomor_anggota, judul_buku, tanggal_pinjam, tanggal_kembali) VALUES ('$nama', '$nomor', '$judul', '$tgl_pinjam', '$tgl_kembali')");
    
    if ($query) {
        echo "<script>alert('Peminjaman berhasil dicatat!'); window.location.href='index.php?menu=pinjam';</script>";
    } else {
        echo "<script>alert('Gagal mencatat peminjaman. Pastikan tabel database sudah sesuai.');</script>";
    }
}
?>

<h2>Form Peminjaman Buku</h2>
<p>Silakan lengkapi data berikut dengan benar untuk melakukan pencatatan peminjaman buku di perpustakaan kami.</p>

<div style="border: 1px solid #ccc; padding: 20px;">
    <h3 style="margin-top: 0;">Data Peminjaman</h3>
    <form action="" method="POST">
        <p>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama_peminjam" required style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;">
        </p>
        <p>
            <label>NPM / Nomor Anggota:</label><br>
            <input type="text" name="nomor_anggota" required style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;">
        </p>
        <p>
            <label>Judul Buku yang Dipinjam:</label><br>
            <input type="text" name="judul_buku" required style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;">
        </p>
        <p>
            <label>Tanggal Pinjam:</label><br>
            <input type="date" name="tanggal_pinjam" required style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;">
        </p>
        <p>
            <label>Rencana Tanggal Kembali:</label><br>
            <input type="date" name="tanggal_kembali" required style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;">
        </p>
        <p style="margin-bottom: 0;">
            <input type="submit" name="catat_pinjam" value="Catat Peminjaman" style="padding: 10px 20px; background-color: #111; color: white; border: none; cursor: pointer;">
        </p>
    </form>
</div>