<?php
$host = "127.0.0.1";
$user = "root";       
$pass = "";           
$db   = "db_perpustakaan";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error() . ". Pastikan layanan MySQL/XAMPP sudah dijalankan.");
}

$checkTable = mysqli_query($koneksi, "SHOW TABLES LIKE 'buku'");
if ($checkTable && mysqli_num_rows($checkTable) > 0) {
    $existingColumns = [];
    $resultCols = mysqli_query($koneksi, "SHOW COLUMNS FROM buku");
    while ($col = mysqli_fetch_assoc($resultCols)) {
        $existingColumns[] = $col['Field'];
    }

    if (!in_array('sinopsis', $existingColumns, true)) {
        mysqli_query($koneksi, "ALTER TABLE buku ADD COLUMN sinopsis TEXT DEFAULT NULL");
    }

    if (!in_array('isi_buku', $existingColumns, true)) {
        mysqli_query($koneksi, "ALTER TABLE buku ADD COLUMN isi_buku LONGTEXT DEFAULT NULL");
    }
}

$checkPesanTable = mysqli_query($koneksi, "SHOW TABLES LIKE 'pesan_pengunjung'");
if ($checkPesanTable && mysqli_num_rows($checkPesanTable) == 0) {
    mysqli_query($koneksi, "CREATE TABLE pesan_pengunjung (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        instansi VARCHAR(150) NOT NULL,
        pesan TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
} elseif ($checkPesanTable && mysqli_num_rows($checkPesanTable) > 0) {
    $existingPesanColumns = [];
    $resultPesanCols = mysqli_query($koneksi, "SHOW COLUMNS FROM pesan_pengunjung");
    while ($col = mysqli_fetch_assoc($resultPesanCols)) {
        $existingPesanColumns[] = $col['Field'];
    }

    if (!in_array('nama', $existingPesanColumns, true)) {
        mysqli_query($koneksi, "ALTER TABLE pesan_pengunjung ADD COLUMN nama VARCHAR(100) NOT NULL");
    }

    if (!in_array('instansi', $existingPesanColumns, true)) {
        mysqli_query($koneksi, "ALTER TABLE pesan_pengunjung ADD COLUMN instansi VARCHAR(150) NOT NULL");
    }

    if (!in_array('pesan', $existingPesanColumns, true)) {
        mysqli_query($koneksi, "ALTER TABLE pesan_pengunjung ADD COLUMN pesan TEXT NOT NULL");
    }

    if (!in_array('created_at', $existingPesanColumns, true)) {
        mysqli_query($koneksi, "ALTER TABLE pesan_pengunjung ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    }
}
?>