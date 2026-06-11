<?php
$host = "localhost";
$user = "root";       // Username default XAMPP
$pass = "";           // Password default XAMPP (dikosongkan)
$db   = "db_perpustakaan";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>