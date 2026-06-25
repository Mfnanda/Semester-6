<?php
session_start();

// PROTEKSI HALAMAN: Hanya Admin yang boleh masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak! Anda bukan Admin.'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require '../config/koneksi.php';
/** @var mysqli $koneksi */

// FITUR TAMBAH USER
if (isset($_POST['tambah_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $nama_lengkap = $_POST['nama_lengkap'];
    $role = $_POST['role'];

    // Cek apakah username sudah dipakai
    $cek_username = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>alert('Gagal! Username sudah digunakan. Pilih username lain.');</script>";
    } else {
        $query_tambah = "INSERT INTO users (username, password, nama_lengkap, role) VALUES ('$username', '$password', '$nama_lengkap', '$role')";
        if (mysqli_query($koneksi, $query_tambah)) {
            echo "<script>alert('Akun baru berhasil ditambahkan!'); window.location.href='kelola_user.php';</script>";
        }
    }
}

// FITUR HAPUS USER
if (isset($_GET['hapus'])) {
    $id_user = $_GET['hapus'];
    
    // Mencegah admin menghapus akunnya sendiri yang sedang dipakai login
    $cek_sendiri = mysqli_query($koneksi, "SELECT username FROM users WHERE id='$id_user'");
    $data_sendiri = mysqli_fetch_assoc($cek_sendiri);
    
    if ($data_sendiri['username'] == $_SESSION['username']) {
        echo "<script>alert('Gagal! Anda tidak bisa menghapus akun Anda sendiri saat sedang login.'); window.location.href='kelola_user.php';</script>";
    } else {
        $query_hapus = "DELETE FROM users WHERE id = '$id_user'";
        if (mysqli_query($koneksi, $query_hapus)) {
            echo "<script>alert('Akun berhasil dihapus!'); window.location.href='kelola_user.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Pengguna</title>
    <!-- Memanggil CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .form-select, .form-input { width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; background: #fff; box-sizing: border-box; }
    </style>
</head>
<body style="padding: 20px; max-width: 900px; margin: 0 auto;">
    
    <h2>👥 Kelola Akun Pengguna</h2>
    <a href="admin_dashboard.php" style="display: inline-block; margin-bottom: 20px; text-decoration: none; color: #d9534f; font-weight: bold;">&larr; Kembali ke Dashboard</a>

    <!-- Kotak Form Tambah Akun -->
    <div style="background-color: #f4f4f4; padding: 20px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #ddd;">
        <h3 style="margin-top: 0;">Tambah Akun Baru</h3>
        <form method="POST" action="">
            <label>Username:</label>
            <input type="text" name="username" class="form-input" required>
            
            <label>Password:</label>
            <input type="password" name="password" class="form-input" required>
            
            <label>Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" class="form-input" required>
            
            <label>Hak Akses (Role):</label>
            <select name="role" class="form-select" required>
                <option value="user">Pengunjung Biasa (User)</option>
                <option value="admin">Administrator (Admin)</option>
            </select>
            
            <input type="submit" name="tambah_user" value="Simpan Akun Baru" style="background-color: #204d74; width: auto; padding: 10px 15px;">
        </form>
    </div>

    <!-- Tabel Daftar Akun -->
    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM users ORDER BY role ASC, id DESC");
        $no = 1;
        
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $data['username'] . "</td>";
            echo "<td>" . $data['nama_lengkap'] . "</td>";
            
            // Memberi warna berbeda untuk role admin dan user
            $warna_role = ($data['role'] == 'admin') ? 'color: blue; font-weight: bold;' : 'color: #555;';
            echo "<td style='$warna_role'>" . strtoupper($data['role']) . "</td>";
            
            echo "<td>";
            // Tombol hapus dimatikan untuk akun sendiri agar tidak eror
            if ($data['username'] == $_SESSION['username']) {
                echo "<span style='color: #aaa;'>Sedang Dipakai</span>";
            } else {
                echo "<a href='kelola_user.php?hapus=" . $data['id'] . "' style='color: red;' onclick='return confirm(\"Hapus akun " . $data['username'] . " secara permanen?\")'>Hapus</a>";
            }
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>