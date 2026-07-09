<?php
require_once __DIR__ . '/Config/koneksi.php';
/** @var mysqli $koneksi */
?>
<div class="card">
    <div class="flex-between">
        <div>
            <h2 style="margin-bottom: 6px;">Koleksi Buku</h2>
            <p class="text-muted" style="margin: 0;">Jelajahi katalog buku digital dan fisik yang tersedia di perpustakaan.</p>
        </div>
    </div>

    <div class="text-right form-group">
        <form method="GET" action="index.php">
            <input type="hidden" name="menu" value="koleksi">
            <input type="text" name="cari" class="form-control" placeholder="Cari judul atau pengarang..." style="width: 280px; display: inline-block;">
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
            <div class="card" style="margin-bottom: 0; min-height: 100%;">
                <h3 style="margin-bottom: 8px;"><?php echo htmlspecialchars($data['judul']); ?></h3>
                <p class="text-muted" style="margin-bottom: 10px;">✍️ <?php echo htmlspecialchars($data['pengarang']); ?> | 📅 <?php echo htmlspecialchars($data['tahun']); ?></p>
                <hr>
                <p><?php echo htmlspecialchars(substr($sinopsis, 0, 160)); ?>...</p>
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
</div>