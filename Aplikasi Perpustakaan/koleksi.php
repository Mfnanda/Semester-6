<?php
require 'config/koneksi.php';
/** @var mysqli $koneksi */
?>
<h2>📚 Daftar Koleksi Buku</h2>
<p class="text-muted">Jelajahi koleksi buku terbaik kami.</p>

<div class="text-right form-group">
    <form method="GET" action="index.php">
        <input type="hidden" name="menu" value="koleksi">
        <input type="text" name="cari" class="form-control" placeholder="Cari judul..." style="width: auto; display: inline-block;">
        <input type="submit" value="Cari" class="btn btn-primary">
    </form>
</div>

<div class="grid-3">
    <?php
    $keyword = isset($_GET['cari']) ? $_GET['cari'] : '';
    if ($keyword != '') {
        $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul LIKE '%$keyword%' OR pengarang LIKE '%$keyword%' ORDER BY id DESC");
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");
    }

    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $sinopsis = (isset($data['sinopsis']) && $data['sinopsis'] != '') ? $data['sinopsis'] : "Sinopsis belum tersedia.";
            ?>
            <div class="card">
                <h3><?php echo $data['judul']; ?></h3>
                <p class="text-muted">✍️ <?php echo $data['pengarang']; ?> | 📅 <?php echo $data['tahun']; ?></p>
                <hr>
                <p><?php echo substr($sinopsis, 0, 160); ?>...</p>
                <div class="text-center" style="margin-top: 15px;">
                    <?php if (isset($_SESSION['role'])): ?>
                        <a href="baca_buku.php?id=<?php echo $data['id']; ?>" class="btn btn-success btn-full">📖 Baca Isi</a>
                    <?php else: ?>
                        <a href="index.php?menu=login" class="btn btn-danger btn-full">🔒 Login Membaca</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }
    } else {
       echo '<div class="card text-center text-muted" style="grid-column: 1 / -1;">Buku tidak ditemukan.</div>';
    }
    ?>
</div>