<h3>Daftar Koleksi Buku</h3>
<p>Berikut adalah buku yang tersedia di perpustakaan kami:</p>

<div style="margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
    <a href="index.php?menu=tambah_buku" style="display: inline-block; padding: 8px 12px; background-color: #111; color: #fff; text-decoration: none;">+ Tambah Buku</a>
    
    <form action="index.php" method="GET" style="margin: 0; display: flex; gap: 5px;">
        <input type="hidden" name="menu" value="koleksi">
        <input type="text" name="cari" placeholder="Cari judul/pengarang..." style="padding: 6px; width: 200px; margin: 0;" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <input type="submit" value="Cari" style="padding: 6px 12px; margin: 0; width: auto;">
        <?php if(isset($_GET['cari'])): ?>
            <a href="index.php?menu=koleksi" style="padding: 6px 12px; background-color: #d9534f; color: white; text-decoration: none; border: none; display: inline-block;">Reset</a>
        <?php endif; ?>
    </form>
</div>

<table>
    <tr>
        <th>No</th>
        <th>Judul Buku</th>
        <th>Pengarang</th>
        <th>Tahun Terbit</th>
        <th>Aksi</th>
    </tr>
    <?php
    require 'config/koneksi.php';
    /** @var mysqli $koneksi */
    
    // Logika Pencarian
    if (isset($_GET['cari']) && $_GET['cari'] != '') {
        $cari = $_GET['cari'];
        // Menggunakan LIKE '%kata%' untuk mencari data yang mengandung kata tersebut
        $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul LIKE '%$cari%' OR pengarang LIKE '%$cari%'");
    } else {
        // Jika tidak ada pencarian, tampilkan semua data
        $query = mysqli_query($koneksi, "SELECT * FROM buku");
    }
    
    $no = 1;
    while ($data = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $data['judul'] . "</td>";
        echo "<td>" . $data['pengarang'] . "</td>";
        echo "<td>" . $data['tahun'] . "</td>";
        echo "<td>
                <a href='index.php?menu=edit_buku&id=" . $data['id'] . "' style='color: blue;'>Edit</a> | 
                <a href='hapus_buku.php?id=" . $data['id'] . "' style='color: red;' onclick='return confirm(\"Apakah Anda yakin ingin menghapus buku ini?\")'>Hapus</a>
              </td>";
        echo "</tr>";
    }
    
    // Jika data tidak ditemukan
    if (mysqli_num_rows($query) == 0) {
        echo "<tr><td colspan='5' style='text-align: center;'>Data buku tidak ditemukan.</td></tr>";
    }
    ?>
</table>