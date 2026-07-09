<?php
session_start();
include 'templates/header.php';

$menu = isset($_GET['menu']) ? $_GET['menu'] : '';

if ($menu == '') {
    ?>
    <div class="hero">
        <h1>Selamat Datang di Sistem Informasi Perpustakaan</h1>
        <p>Menjadi portal resmi untuk mengakses layanan koleksi, peminjaman, dan informasi perpustakaan secara modern dan terintegrasi.</p>
        <br>
        <a href="index.php?menu=koleksi" class="btn btn-primary">Lihat Koleksi Buku</a>
    </div>

    <div class="grid-3">
        <div class="card text-center">
            <h4>📖 Koleksi Lengkap</h4>
            <p>Ribuan judul buku dari berbagai bidang ilmu pengetahuan dan referensi akademik.</p>
        </div>
        <div class="card text-center">
            <h4>🏢 Fasilitas Modern</h4>
            <p>Ruang baca yang nyaman, teratur, dan mendukung kebutuhan belajar jangka panjang.</p>
        </div>
        <div class="card text-center">
            <h4>👥 Layanan Prima</h4>
            <p>Tim pendukung siap membantu setiap kebutuhan akses dan layanan pengguna.</p>
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
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            echo "<script>alert('Anda login sebagai Admin. Admin tidak perlu mengisi formulir peminjaman.'); window.location.href='admin/admin_dashboard.php';</script>";
        } else {
            echo "<script>window.location.href='user/form_pinjam.php';</script>";
        }
    } else {
        echo "<script>alert('Silakan login terlebih dahulu untuk melakukan peminjaman buku!'); window.location.href='index.php?menu=login';</script>";
    }
} elseif ($menu == 'kontak') {
    include 'bukutamu.php';
} elseif ($menu == 'tambah_buku') {
    include 'tambah_buku.php';
} elseif ($menu == 'edit_buku') {
    include 'edit_buku.php';
} elseif ($menu == 'login') {
    include 'auth/login.php';
}

include 'templates/footer.php';
?>