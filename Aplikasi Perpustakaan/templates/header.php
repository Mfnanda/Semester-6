<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$baseUrl = isset($baseUrl) ? $baseUrl : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/style.css?v=6">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header class="topbar">
    <div class="navbar">
        <a href="<?php echo $baseUrl; ?>index.php" class="brand">
            <img src="<?php echo $baseUrl; ?>assets/images/pngtree-colorful-book-stack-logo-design-perfect-for-education-or-library-projects-vector-png-image_15444285.png" alt="Logo Perpustakaan" class="brand-logo">
            <span class="brand-text">
                <span>Perpustakaan</span>
                <small class="brand-sub">Sistem Informasi Digital</small>
            </span>
        </a>
        <button class="menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav class="menu" id="siteMenu" aria-label="Navigasi utama">
            <a href="<?php echo $baseUrl; ?>index.php">Home</a>
            <a href="<?php echo $baseUrl; ?>index.php?menu=tentang">Tentang Kami</a>
            <a href="<?php echo $baseUrl; ?>index.php?menu=visimisi">Visi Misi</a>
            <a href="<?php echo $baseUrl; ?>index.php?menu=koleksi">Koleksi Buku</a>
            <a href="<?php echo $baseUrl; ?>index.php?menu=pinjam">Peminjaman</a>
            <a href="<?php echo $baseUrl; ?>index.php?menu=kontak">Contact</a>

            <?php if(isset($_SESSION['role'])): ?>

            <?php if($_SESSION['role'] == 'master'): ?>

                <a href="<?php echo $baseUrl; ?>admin/admin_dashboard.php"
                class="nav-btn">
                    👑 Dashboard Master
                </a>

            <?php elseif($_SESSION['role'] == 'admin'): ?>

                <a href="<?php echo $baseUrl; ?>admin/admin_dashboard.php"
                class="nav-btn">
                    Dashboard Admin
                </a>

            <?php else: ?>

                <a href="<?php echo $baseUrl; ?>user/user_home.php"
                class="nav-btn">
                    Menu User
                </a>

            <?php endif; ?>

            <a href="<?php echo $baseUrl; ?>auth/logout.php"
            class="nav-btn-danger"
            onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                Logout
            </a>

            <?php else: ?>

                <a href="<?php echo $baseUrl; ?>index.php?menu=login"
                class="nav-btn">
                    Login
                </a>

            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="page-shell">