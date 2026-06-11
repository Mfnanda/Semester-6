<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
        
        /* Navigation Bar */
        header { background-color: #2c3e50; padding: 0; position: sticky; top: 0; z-index: 100; }
        .navbar { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; }
        .logo { color: white; font-size: 24px; font-weight: bold; }
        .menu { display: flex; gap: 30px; flex-wrap: wrap; }
        .menu a { color: white; text-decoration: none; font-size: 14px; transition: color 0.3s; }
        .menu a:hover { color: #3498db; }
        
        /* Landing Page Hero */
        .hero { background-color: #34495e; color: white; padding: 80px 20px; text-align: center; }
        .hero h1 { font-size: 42px; margin-bottom: 15px; }
        .hero p { font-size: 18px; max-width: 600px; margin: 0 auto 30px; }
        .btn-primary { display: inline-block; background-color: #3498db; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; transition: background-color 0.3s; }
        .btn-primary:hover { background-color: #2980b9; }
        
        /* Content Container */
        .container { max-width: 1000px; margin: 40px auto; padding: 20px; background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 10px; margin-bottom: 20px; }
        h3 { color: #34495e; margin: 20px 0 10px; }
        p { line-height: 1.6; color: #555; margin-bottom: 15px; }
        
        /* Features/Cards */
        .features { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin: 30px 0; }
        .feature-card { background: #ecf0f1; padding: 20px; border-radius: 5px; text-align: center; }
        .feature-card h4 { color: #2c3e50; margin-bottom: 10px; }
        
        /* Forms & Tables */
        input[type="text"], input[type="date"], textarea { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #bdc3c7; border-radius: 4px; font-family: Arial; }
        textarea { resize: vertical; min-height: 100px; }
        input[type="submit"] { background-color: #3498db; color: white; padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; transition: background-color 0.3s; margin-top: 10px; }
        input[type="submit"]:hover { background-color: #2980b9; }
        
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #bdc3c7; padding: 12px; text-align: left; }
        th { background-color: #34495e; color: white; }
        tr:nth-child(even) { background-color: #ecf0f1; }
        
        /* Footer */
        footer { background-color: #2c3e50; color: white; text-align: center; padding: 20px; margin-top: 40px; }
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