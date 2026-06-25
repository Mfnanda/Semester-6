<h3>Daftar Koleksi Buku</h3>
<p>Berikut adalah buku yang tersedia di perpustakaan kami:</p>

<a href="index.php?menu=tambah_buku" style="display: inline-block; padding: 8px 12px; background-color: #111; color: #fff; text-decoration: none; margin-bottom: 15px;">+ Tambah Buku</a>

<table>
    <tr>
        <th>No</th>
        <th>Judul Buku</th>
        <th>Pengarang</th>
        <th>Tahun Terbit</th>
        <th>Aksi</th> </tr>
    <?php
    require 'koneksi.php';
    /** @var mysqli $koneksi */
    
    // Mengambil data dari tabel buku
    $query = mysqli_query($koneksi, "SELECT * FROM buku");
    $no = 1;
    
    while ($data = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $data['judul'] . "</td>";
        echo "<td>" . $data['pengarang'] . "</td>";
        echo "<td>" . $data['tahun'] . "</td>";
        
        // Tombol Edit dan Hapus (Mengambil 'id' dari database sebagai parameter)
        // Pastikan nama kolom primary key kamu adalah 'id', jika beda (misal 'id_buku'), silakan ubah di bawah ini
        echo "<td>
                <a href='index.php?menu=edit_buku&id=" . $data['id'] . "' style='color: blue;'>Edit</a> | 
                <a href='hapus_buku.php?id=" . $data['id'] . "' style='color: red;' onclick='return confirm(\"Apakah Anda yakin ingin menghapus buku ini?\")'>Hapus</a>
              </td>";
        echo "</tr>";
    }
    ?>
</table>