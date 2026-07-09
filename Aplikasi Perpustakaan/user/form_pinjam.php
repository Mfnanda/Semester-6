<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi halaman agar hanya user logged-in yang bisa akses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require '../config/koneksi.php';
/** @var mysqli $koneksi */

// Jika tombol Catat Peminjaman ditekan
if (isset($_POST['proses_pinjam'])) {
    $username = $_SESSION['username']; 
    $judul_buku = mysqli_real_escape_string($koneksi, $_POST['judul_buku']);
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $query = mysqli_query($koneksi, "INSERT INTO peminjaman (username, judul_buku, tanggal_pinjam, tanggal_kembali, status) 
              VALUES ('$username', '$judul_buku', '$tanggal_pinjam', '$tanggal_kembali', 'Menunggu Persetujuan')");

    if ($query) {
        echo "<script>alert('Pengajuan peminjaman berhasil dikirim! Silakan tunggu konfirmasi admin.'); window.location.href='user_home.php';</script>";
    } else {
        echo "<script>alert('Gagal mengajukan peminjaman.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Peminjaman Buku</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="padding: 20px; font-family: sans-serif; background-color: #f4f4f4;">

<div style="max-width: 600px; margin: 20px auto; padding: 30px; background: #fff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
    <h2 style="margin-top: 0; color: #2c3e50;">Form Peminjaman Buku</h2>
    <p style="color: #666; font-size: 14px;">Silakan lengkapi data berikut dengan benar untuk melakukan pencatatan peminjaman buku.</p>
    <hr style="border: 1px solid #eee; margin-bottom: 25px;">

    <form action="" method="POST">
        <label style="font-weight: bold; color: #444;">Nama Anggota (Username):</label><br>
        <input type="text" value="<?php echo $_SESSION['username']; ?>" disabled style="width: 100%; padding: 10px; margin: 8px 0 20px 0; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; color: #777;"><br>

        <label style="font-weight: bold; color: #444;">Pilih Judul Buku:</label><br>
        <select name="judul_buku" required style="width: 100%; padding: 10px; margin: 8px 0 20px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; background-color: #fff;">
            <option value="" disabled selected>-- Klik untuk memilih buku --</option>
            <?php
            // Mengambil data judul buku dari database
            $query_buku = mysqli_query($koneksi, "SELECT judul FROM buku ORDER BY judul ASC");
            while ($buku = mysqli_fetch_assoc($query_buku)) {
                echo "<option value='" . htmlspecialchars($buku['judul']) . "'>" . htmlspecialchars($buku['judul']) . "</option>";
            }
            ?>
        </select><br>

        <label style="font-weight: bold; color: #444;">Tanggal Pinjam:</label><br>
        <input type="date" name="tanggal_pinjam" required style="width: 100%; padding: 10px; margin: 8px 0 20px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;"><br>

        <label style="font-weight: bold; color: #444;">Rencana Tanggal Kembali:</label><br>
        <input type="date" name="tanggal_kembali" required style="width: 100%; padding: 10px; margin: 8px 0 25px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;"><br>

        <div style="display: flex; gap: 15px;">
            <input type="submit" name="proses_pinjam" value="Catat Peminjaman" style="flex: 1; padding: 12px; background-color: #2c3e50; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: 0.2s;">
            <a href="user_home.php" style="flex: 1; padding: 12px; background-color: #95a5a6; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px; text-align: center; transition: 0.2s;">Batal / Kembali</a>
        </div>
    </form>
</div>

</body>
</html>