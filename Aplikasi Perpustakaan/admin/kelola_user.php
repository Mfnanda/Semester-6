<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi halaman admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak!'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require '../config/koneksi.php';
/** @var mysqli $koneksi */

// Jika tombol Simpan Akun Baru ditekan
if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']); 
    $role = $_POST['role'];

    // Cek apakah username sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah terdaftar! Gunakan username lain.');</script>";
    } else {
        // Insert tanpa kolom nama_lengkap
        $insert = mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
        if ($insert) {
            echo "<script>alert('Akun berhasil ditambahkan!'); window.location.href='kelola_user.php';</script>";
        } else {
            echo "<script>alert('Gagal menambah akun!');</script>";
        }
    }
}

// Jika tombol Hapus ditekan
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $hapus = mysqli_query($koneksi, "DELETE FROM users WHERE id='$id_hapus'");
    if ($hapus) {
        echo "<script>alert('Akun berhasil dihapus!'); window.location.href='kelola_user.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Akun Pengguna</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="padding: 20px; font-family: sans-serif; background-color: #f4f4f4;">

<div style="max-width: 800px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    
    <h2 style="color: #333; display: flex; align-items: center; gap: 10px;">👥 Kelola Akun Pengguna</h2>
    <a href="admin_dashboard.php" style="color: #d9534f; text-decoration: none; font-weight: bold; margin-bottom: 20px; display: inline-block;">← Kembali ke Dashboard</a>
    
    <div style="background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 30px;">
        <h3 style="margin-top: 0;">Tambah Akun Baru</h3>
        
        <form action="" method="POST">
            <label style="font-weight: bold; color: #444;">Username:</label><br>
            <input type="text" name="username" required style="width: 100%; padding: 8px; margin: 8px 0 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><br>
            
            <label style="font-weight: bold; color: #444;">Password:</label><br>
            <input type="text" name="password" required style="width: 100%; padding: 8px; margin: 8px 0 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><br>
            
            <label style="font-weight: bold; color: #444;">Hak Akses (Role):</label><br>
            <select name="role" style="width: 100%; padding: 8px; margin: 8px 0 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                <option value="user">Pengunjung Biasa (User)</option>
                <option value="admin">Administrator (Admin)</option>
            </select><br>
            
            <input type="submit" name="tambah" value="Simpan Akun Baru" style="background-color: #2c3e50; color: white; padding: 10px 15px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
        </form>
    </div>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id ASC");
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td>
                    <strong style="color: <?php echo ($row['role'] == 'admin') ? 'blue' : '#555'; ?>; text-transform: uppercase;">
                        <?php echo $row['role']; ?>
                    </strong>
                </td>
                <td>
                    <?php 
                    // Mencegah admin menghapus akunnya sendiri yang sedang dipakai login
                    if ($row['username'] == $_SESSION['username']) { 
                    ?>
                        <span style="color: #aaa; font-style: italic;">Sedang Dipakai</span>
                    <?php } else { ?>
                        <a href="kelola_user.php?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus akun <?php echo $row['username']; ?>?');" style="color: red; text-decoration: none; font-weight: bold;">Hapus</a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>