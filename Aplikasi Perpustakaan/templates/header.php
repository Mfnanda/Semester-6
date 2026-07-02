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
            
            <?php 
            // Jika pengguna SUDAH LOGIN (Sesi Role sudah terbentuk)
            if (isset($_SESSION['role'])): 
            ?>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="admin/admin_dashboard.php" style="background-color: #204d74; color: #fff; border-radius: 4px;">Dashboard Admin</a>
                <?php else: ?>
                    <a href="user/user_home.php" style="background-color: #204d74; color: #fff; border-radius: 4px;">Menu User</a>
                <?php endif; ?>
                
                <a href="auth/logout.php" style="background-color: #d9534f; color: #fff; border-radius: 4px;" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Logout</a>
                
            <?php 
            // Jika pengguna BELUM LOGIN
            else: 
            ?>
                <a href="index.php?menu=login" style="background-color: #111; color: #fff; border-radius: 4px;">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>