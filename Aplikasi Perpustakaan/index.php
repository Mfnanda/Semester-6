<?php
// Wajib ditaruh paling atas untuk memulai sesi login
session_start();

// Memanggil komponen header atas
include 'templates/header.php';

// Menangkap request menu dari URL
$menu = isset($_GET['menu']) ? $_GET['menu'] : '';

// Routing (Pengaturan Halaman)
if ($menu == '') {
    // Tampilan Halaman Utama (Home)
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
    // PERBAIKAN LOGIKA: Proteksi menu peminjaman berdasarkan Role Login
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            // Jika yang klik adalah Admin
            echo "<script>alert('Anda login sebagai Admin. Admin tidak perlu mengisi formulir peminjaman.'); window.location.href='admin/admin_dashboard.php';</script>";
        } else {
            // Jika yang klik adalah User biasa
            echo "<script>window.location.href='user/form_pinjam.php';</script>";
        }
    } else {
        // Jika belum login sama sekali (Guest)
        echo "<script>alert('Silakan login terlebih dahulu untuk melakukan peminjaman buku!'); window.location.href='index.php?menu=login';</script>";
    }
} elseif ($menu == 'kontak') {
    include 'bukutamu.php';
} elseif ($menu == 'tambah_buku') {
    include 'tambah_buku.php';
} elseif ($menu == 'edit_buku') {
    include 'edit_buku.php';
} elseif ($menu == 'login') {
    // Rute ke halaman login
    include 'auth/login.php';
}

// Memanggil komponen footer bawah
include 'templates/footer.php';
?>