<?php
// Pastikan koneksi dipanggil (jika belum ada di index)
require 'config/koneksi.php';
/** @var mysqli $koneksi */
?>

<h2>📚 Daftar Koleksi Buku</h2>
<p style="color: #555; margin-bottom: 25px;">Jelajahi koleksi buku terbaik kami. Baca sinopsisnya, dan silakan masuk (login) untuk membaca isi lengkap buku.</p>

<div style="margin-bottom: 25px; text-align: right;">
    <form method="GET" action="index.php">
        <input type="hidden" name="menu" value="koleksi">
        <input type="text" name="cari" placeholder="Cari judul atau pengarang..." style="padding: 10px; width: 280px; border: 1px solid #ccc; border-radius: 4px;">
        <input type="submit" value="Cari Buku" style="padding: 10px 20px; background-color: #111; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
    </form>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
    
    <?php
    $keyword = isset($_GET['cari']) ? $_GET['cari'] : '';
    
    // PERBAIKAN: Menggunakan kolom 'judul' sesuai database
    if ($keyword != '') {
        $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul LIKE '%$keyword%' OR pengarang LIKE '%$keyword%' ORDER BY id DESC");
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");
    }

    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_array($query)) {
            
            // Cek apakah kolom sinopsis ada dan tidak kosong.
            $sinopsis = (isset($data['sinopsis']) && $data['sinopsis'] != '') 
                        ? $data['sinopsis'] 
                        : "Sinopsis belum tersedia untuk buku ini. Buku ini merupakan salah satu koleksi referensi unggulan yang ada di perpustakaan kami dan sangat direkomendasikan untuk dibaca.";

            echo '<div style="border: 1px solid #e1e4e8; border-radius: 8px; padding: 20px; background-color: #ffffff; box-shadow: 0 4px 6px rgba(0,0,0,0.04); display: flex; flex-direction: column;">';
            
            // PERBAIKAN: Menggunakan 'judul' dan 'tahun'
            echo '<h3 style="margin-top: 0; margin-bottom: 10px; color: #204d74; font-size: 18px; line-height: 1.4;">' . $data['judul'] . '</h3>';
            echo '<p style="font-size: 13px; color: #666; margin-top: 0; margin-bottom: 15px; border-bottom: 1px dashed #ddd; padding-bottom: 10px;">';
            echo '✍️ <strong>' . $data['pengarang'] . '</strong> &nbsp;|&nbsp; 📅 ' . $data['tahun'];
            echo '</p>';

            // Sinopsis
            echo '<div style="flex-grow: 1;">';
            echo '<p style="font-size: 14px; line-height: 1.6; color: #444; text-align: justify;"><strong>Sinopsis:</strong><br>';
            echo substr($sinopsis, 0, 160) . '...</p>'; 
            echo '</div>';

            // LOGIKA HAK AKSES (LOGIN)
            echo '<div style="margin-top: 20px; text-align: center; border-top: 1px solid #eee; padding-top: 15px;">';
            
            // JIKA SUDAH LOGIN: Arahkan ke file baca_buku.php dengan membawa ID buku
            if (isset($_SESSION['role'])) {
                echo '<a href="baca_buku.php?id=' . $data['id'] . '" style="display: block; padding: 10px 15px; background-color: #5cb85c; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: 0.3s;">📖 Baca Isi Buku</a>';
            } else {
                // JIKA BELUM LOGIN: Arahkan ke halaman login
                echo '<a href="index.php?menu=login" style="display: block; padding: 10px 15px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px; transition: 0.3s;">🔒 Login untuk Membaca</a>';
            }
            
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div style="grid-column: 1 / -1; text-align: center; padding: 40px; background-color: #f9f9f9; border: 1px dashed #ccc; border-radius: 8px;">';
        echo '<h4 style="color: #666;">Buku yang Anda cari tidak ditemukan.</h4>';
        echo '</div>';
    }
    ?>

</div>