<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <style>
        body { font-family: Verdana, Geneva, sans-serif; background-color: #fff; color: #111; margin: 0; padding: 0; }
        
        header { background-color: #eee; padding: 10px 0; }
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 0 20px; max-width: 1000px; margin: 0 auto; }
        .logo { color: #111; font-size: 18px; font-weight: normal; }
        .menu { display: flex; gap: 12px; }
        .menu a { color: #111; text-decoration: none; padding: 5px 8px; }
        .menu a:hover { text-decoration: underline; }
        
        .hero { background-color: transparent; color: #111; padding: 40px 20px 20px; text-align: left; }
        .hero h1 { font-size: 26px; margin: 0 0 10px; }
        .hero p { font-size: 14px; margin: 0 0 12px; }
        .btn-primary { color: #111; text-decoration: underline; }
        
        .container { max-width: 900px; margin: 0 auto 20px; padding: 20px; }
        h2, h3 { color: #111; }
        h2 { border-bottom: 1px solid #ccc; padding-bottom: 8px; margin-top: 20px; }
        p { line-height: 1.5; color: #333; }
        
        .features { margin: 20px 0; }
        .feature-card { padding: 12px 0; margin: 8px 0; border-top: 1px solid #ddd; }
        .feature-card:last-child { border-bottom: 1px solid #ddd; }
        .feature-card h4 { margin: 0 0 4px; font-size: 16px; }
        
        input[type="text"], input[type="date"], textarea { width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; background: #fff; }
        input[type="submit"] { background-color: #111; color: white; padding: 8px 12px; border: none; cursor: pointer; margin-top: 10px; }
        input[type="submit"]:hover { background-color: #333; }
        
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f7f7f7; }

        footer { background-color: #f4f4f4; color: #111; text-align: center; padding: 15px 20px; margin-top: 20px; }
        footer p { margin: 0; font-size: 13px; }
    </style>
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo">📚 Perpustakaan</div>
        <nav class="menu">
            <a href="index.php">Home</a>
            <a href="index.php?menu=tentang">Tentang Kami</a>
            <a href="index.php?menu=visimisi">Visi Misi</a>
            <a href="index.php?menu=koleksi">Koleksi Buku</a>
            <a href="index.php?menu=pinjam">Peminjaman</a>
            <a href="index.php?menu=kontak">Kontak</a>
        </nav>
    </div>
</header>

<?php
$menu = isset($_GET['menu']) ? $_GET['menu'] : '';

if ($menu == '') {
    ?>
    <div class="hero">
        <h1>Selamat Datang di Perpustakaan Kami</h1>
        <p>Jelajahi ribuan koleksi buku dan tingkatkan pengetahuan Anda bersama kami</p>
        <a href="index.php?menu=koleksi" class="btn-primary">Lihat Koleksi Buku</a>
    </div>
    
    <div class="container">
        <div class="features">
            <div class="feature-card">
                <h4>📖 Koleksi Lengkap</h4>
                <p>Ribuan judul buku dari berbagai kategori ilmu pengetahuan</p>
            </div>
            <div class="feature-card">
                <h4>🏢 Fasilitas Modern</h4>
                <p>Ruang baca yang nyaman dan fasilitas lengkap untuk belajar</p>
            </div>
            <div class="feature-card">
                <h4>👥 Layanan Prima</h4>
                <p>Tim pustakawan profesional siap membantu kebutuhan Anda</p>
            </div>
        </div>
    </div>
    <?php
} elseif ($menu == 'tentang') {
    include 'profil.php';
} elseif ($menu == 'visimisi') {
    include 'visimisi.php';
} elseif ($menu == 'koleksi') {
    include 'koleksi.php';
} elseif ($menu == 'pinjam') {
    include 'pinjam.php';
} elseif ($menu == 'kontak') {
    include 'bukutamu.php';
}
?>

<footer>
    <p>&copy; 2026 Sistem Informasi Perpustakaan. All rights reserved.</p>
</footer>

</body>
</html>