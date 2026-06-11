<h3>Daftar Koleksi Buku</h3>
<p>Berikut adalah buku yang tersedia di perpustakaan kami:</p>

<table>
    <tr>
        <th>No</th>
        <th>Judul Buku</th>
        <th>Pengarang</th>
        <th>Tahun Terbit</th>
    </tr>
    <?php
    require 'koneksi.php';
    /** @var mysqli $koneksi */
    $query = mysqli_query($koneksi, "SELECT * FROM buku");
    $no = 1;
    
    while ($data = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $data['judul'] . "</td>";
        echo "<td>" . $data['pengarang'] . "</td>";
        echo "<td>" . $data['tahun'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>