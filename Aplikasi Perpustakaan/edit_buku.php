<div class="card" style="max-width: 620px; margin: 0 auto;">
    <h3 style="margin-bottom: 6px;">Edit Data Buku</h3>
    <p class="text-muted" style="margin-top: 0;">Silakan ubah informasi buku di bawah ini.</p>

    <?php
    require_once __DIR__ . '/Config/koneksi.php';
    /** @var mysqli $koneksi */

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query_ambil = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = '$id'");
        $data = mysqli_fetch_array($query_ambil);

        if (mysqli_num_rows($query_ambil) < 1) {
            die("Data tidak ditemukan...");
        }
    } else {
        header("Location: index.php?menu=koleksi");
        exit();
    }

    if (isset($_POST['update_buku'])) {
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $tahun = $_POST['tahun'];

        $query_update = "UPDATE buku SET judul='$judul', pengarang='$pengarang', tahun='$tahun' WHERE id='$id'";
        $update = mysqli_query($koneksi, $query_update);

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

    <form action="" method="POST">
        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Pengarang</label>
            <input type="text" name="pengarang" value="<?php echo htmlspecialchars($data['pengarang']); ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="text" name="tahun" value="<?php echo htmlspecialchars($data['tahun']); ?>" class="form-control" required>
        </div>

        <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 10px;">
            <input type="submit" name="update_buku" value="Update Buku" class="btn btn-primary">
            <a href="index.php?menu=koleksi" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>