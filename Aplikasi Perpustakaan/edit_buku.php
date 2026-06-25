<h3>Edit Data Buku</h3>
<p>Silakan ubah informasi buku di bawah ini.</p>

<?php
require 'config/koneksi.php';
/** @var mysqli $koneksi */

// 1. TAHAP AMBIL DATA LAMA
// Cek apakah ada parameter ID di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data buku berdasarkan ID
    $query_ambil = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = '$id'");
    $data = mysqli_fetch_array($query_ambil);
    
    // Jika data tidak ditemukan di database
    if (mysqli_num_rows($query_ambil) < 1) {
        die("Data tidak ditemukan...");
    }
} else {
    // Jika tidak ada ID di URL, kembalikan ke halaman koleksi
    header("Location: index.php?menu=koleksi");
    exit();
}

// 2. TAHAP SIMPAN PERUBAHAN DATA
// Jika tombol Update diklik
if (isset($_POST['update_buku'])) {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahun = $_POST['tahun'];

    // Query untuk mengupdate data berdasarkan ID
    $query_update = "UPDATE buku SET judul='$judul', pengarang='$pengarang', tahun='$tahun' WHERE id='$id'";
    $update = mysqli_query($koneksi, $query_update);

    // Cek apakah berhasil
    if ($update) {
        echo "<script>
                alert('Berhasil! Data buku telah diperbarui.');
                window.location.href = 'index.php?menu=koleksi';
              </script>";
    } else {
        echo "<script>alert('Maaf, data gagal diperbarui!');</script>";
    }
}
?>

<form action="" method="POST" style="max-width: 400px;">
    Judul Buku: <br>
    <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required><br>
    
    Pengarang: <br>
    <input type="text" name="pengarang" value="<?php echo $data['pengarang']; ?>" required><br>
    
    Tahun Terbit: <br>
    <input type="text" name="tahun" value="<?php echo $data['tahun']; ?>" required><br>
    
    <input type="submit" name="update_buku" value="Update Buku">
    <a href="index.php?menu=koleksi" style="display: inline-block; margin-left: 10px; color: #d9534f; text-decoration: none;">Batal</a>
</form>