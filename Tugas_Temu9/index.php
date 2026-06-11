<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: white; margin: 0; padding: 0; }
        
        /* Header & Navigation */
        header { background-color: #333; padding: 0; }
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; max-width: 1200px; margin: 0 auto; }
        .logo { color: white; font-size: 20px; font-weight: bold; }
        .menu { display: flex; gap: 20px; }
        .menu a { color: white; text-decoration: none; padding: 10px 15px; }
        .menu a:hover { background-color: #555; }
        
        /* Hero Section */
        .hero { background-color: #666; color: white; padding: 60px 20px; text-align: center; }
        .hero h1 { font-size: 32px; margin-bottom: 15px; }
        .hero p { font-size: 16px; margin-bottom: 20px; }
        .btn-primary { background-color: #333; color: white; padding: 10px 20px; text-decoration: none; }
        .btn-primary:hover { background-color: #555; }
        
        /* Container */
        .container { max-width: 1000px; margin: 20px auto; padding: 20px; background: white; }
        h2, h3 { color: #333; }
        h2 { border-bottom: 1px solid #ccc; padding-bottom: 10px; }
        p { line-height: 1.6; color: #333; }
        
        /* Feature Cards */
        .features { margin: 20px 0; }
        .feature-card { background: #f9f9f9; padding: 15px; margin: 10px 0; border: 1px solid #ddd; }
        .feature-card h4 { color: #333; }
        
        /* Forms & Tables */
        input[type="text"], input[type="date"], textarea { width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #999; }
        input[type="submit"] { background-color: #333; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px; }
        input[type="submit"]:hover { background-color: #555; }
        
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { border: 1px solid #999; padding: 10px; text-align: left; }
        th { background-color: #f0f0f0; }
        
        /* Footer */
        footer { background-color: #333; color: white; text-align: center; padding: 20px; margin-top: 40px; }
        footer p { color: white; margin: 0; font-size: 14px; }
    </style>
</head>
<body>

<!-- Navigation Bar -->
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
    // Landing Page
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

<!-- Footer -->
<footer>
    <p>&copy; 2024 Sistem Informasi Perpustakaan. All rights reserved.</p>
</footer>

</body>
</html>