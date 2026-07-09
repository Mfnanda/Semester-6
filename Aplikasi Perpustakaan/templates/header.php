<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
            <a href="index.php?menu=kontak">Contact</a>
            
            <?php if (isset($_SESSION['role'])): ?>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="admin/admin_dashboard.php" class="nav-btn">Dashboard Admin</a>
                <?php else: ?>
                    <a href="user/user_home.php" class="nav-btn">Menu User</a>
                <?php endif; ?>
                <a href="auth/logout.php" class="nav-btn-danger" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Logout</a>
            <?php else: ?>
                <a href="index.php?menu=login" class="nav-btn">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
</body>
</html>