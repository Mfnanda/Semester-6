<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
</head>
<body>

    <h2>Sistem Informasi Perpustakaan</h2>
    
    <!-- Menu Navigasi -->
    <a href="index.php?menu=profil">Profil</a> | 
    <a href="index.php?menu=visimisi">Visi & Misi</a> | 
    <a href="index.php?menu=kontak">Kontak</a> | 
    <a href="index.php?menu=bukutamu">Buku Tamu</a>
    <hr>

    <?php
    // Menu yang diklik
    $menu = isset($_GET['menu']) ? $_GET['menu'] : '';

    // Menggunakan if-else sederhana untuk memanggil file
    if ($menu == 'profil') {
        include 'profil.php';
    } elseif ($menu == 'visimisi') {
        include 'visimisi.php';
    } elseif ($menu == 'kontak') {
        require 'kontak.php'; // Menggunakan require agar ada variasi sesuai soal
    } elseif ($menu == 'bukutamu') {
        include 'bukutamu.php';
    } else {
        echo "<p>Selamat datang di beranda Sistem Informasi Perpustakaan.</p>";
        echo "<p>Silakan pilih menu di atas.</p>";
    }
    ?>

</body>
</html>