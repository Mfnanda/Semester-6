<?php
session_start();
session_unset();    // Menghapus semua variabel session
session_destroy();  // Menghancurkan sesi secara total

// Arahkan kembali ke halaman utama
echo "<script>alert('Anda telah berhasil logout.'); window.location.href='../index.php';</script>";
?>