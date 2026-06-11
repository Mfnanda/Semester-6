<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: white; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: auto; padding: 20px; }
        h2 { text-align: center; border-bottom: 1px solid #ccc; padding-bottom: 10px; }
        .menu { text-align: center; margin-bottom: 20px; }
        .menu a { color: blue; text-decoration: none; padding: 10px 15px; margin: 5px; }
        .menu a:hover { text-decoration: underline; }
        input[type="text"], input[type="date"], textarea { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #999; }
        input[type="submit"] { background-color: blue; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px; }
        input[type="submit"]:hover { background-color: darkblue; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #999; padding: 10px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>

<div class="container">
    <h2>Sistem Informasi Perpustakaan</h2>
    
    <div class="menu">
        <a href="index.php?menu=profil">Profil</a>
        <a href="index.php?menu=koleksi">Koleksi Buku</a>
        <a href="index.php?menu=pinjam">Peminjaman</a>
        <a href="index.php?menu=bukutamu">Tinggalkan Pesan</a>
    </div>

    <?php
    $menu = isset($_GET['menu']) ? $_GET['menu'] : '';

    if ($menu == 'profil') {
        include 'profil.php';
    } elseif ($menu == 'koleksi') {
        include 'koleksi.php';
    } elseif ($menu == 'pinjam') {
        include 'pinjam.php';
    } elseif ($menu == 'bukutamu') {
        include 'bukutamu.php';
    } else {
        echo "<p style='text-align:center;'>Selamat datang di portal Perpustakaan. Silakan pilih menu di atas.</p>";
    }
    ?>
</div>

</body>
</html>