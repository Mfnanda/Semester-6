<div class="card" style="max-width: 620px; margin: 0 auto;">
    <h3 style="margin-bottom: 6px;">Tambah Koleksi Buku Baru</h3>
    <p class="text-muted" style="margin-top: 0;">Silakan masukkan detail buku yang ingin ditambahkan ke perpustakaan.</p>

    <?php
    require_once __DIR__ . '/Config/koneksi.php';
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
                    window.location.href = 'index.php?menu=koleksi';
                  </script>";
        } else {
            echo "<script>alert('Maaf, data buku gagal ditambahkan!');</script>";
        }
    }
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Pengarang</label>
            <input type="text" name="pengarang" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="text" name="tahun" class="form-control" required placeholder="Contoh: 2024">
        </div>

        <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 10px;">
            <input type="submit" name="simpan_buku" value="Simpan Buku" class="btn btn-primary">
            <a href="index.php?menu=koleksi" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>