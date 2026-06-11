<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #121212; color: #e0e0e0; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: auto; background-color: #1e1e1e; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.3); }
        h2 { color: #ffffff; text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .menu { text-align: center; margin-bottom: 20px; }
        .menu a { color: #66b3ff; text-decoration: none; padding: 10px 15px; font-weight: bold; }
        .menu a:hover { color: #ffffff; background-color: #333; border-radius: 5px; }
        input[type="text"], input[type="date"], textarea { width: 100%; padding: 8px; margin-top: 5px; background-color: #333; color: white; border: 1px solid #555; border-radius: 4px; }
        input[type="submit"] { background-color: #66b3ff; color: #111; padding: 10px 15px; border: none; font-weight: bold; border-radius: 4px; cursor: pointer; margin-top: 10px; }
        input[type="submit"]:hover { background-color: #4da6ff; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #444; padding: 10px; text-align: left; }
        th { background-color: #333; }
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