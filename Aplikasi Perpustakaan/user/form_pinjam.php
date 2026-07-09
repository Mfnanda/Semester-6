<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi halaman agar hanya user logged-in yang bisa akses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require_once __DIR__ . '/../Config/koneksi.php';
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
<body class="container">

<div class="card" style="max-width: 680px; margin: 30px auto;">
    <h2 style="margin-top: 0; margin-bottom: 8px;">Form Peminjaman Buku</h2>
    <p class="text-muted" style="margin-top: 0;">Silakan lengkapi data berikut dengan benar untuk mengajukan peminjaman buku.</p>

    <form action="" method="POST">
        <div class="form-group">
            <label>Nama Anggota (Username)</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" class="form-control" disabled>
        </div>

        <div class="form-group">
            <label>Pilih Judul Buku</label>
            <select name="judul_buku" class="form-control" required>
                <option value="" disabled selected>-- Klik untuk memilih buku --</option>
                <?php
                $query_buku = mysqli_query($koneksi, "SELECT judul FROM buku ORDER BY judul ASC");
                while ($buku = mysqli_fetch_assoc($query_buku)) {
                    echo "<option value='" . htmlspecialchars($buku['judul']) . "'>" . htmlspecialchars($buku['judul']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Rencana Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" required>
        </div>

        <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 8px;">
            <input type="submit" name="proses_pinjam" value="Catat Peminjaman" class="btn btn-primary" style="flex: 1; min-width: 220px;">
            <a href="user_home.php" class="btn btn-secondary" style="flex: 1; min-width: 220px;">Batal / Kembali</a>
        </div>
    </form>
</div>

</body>
</html>