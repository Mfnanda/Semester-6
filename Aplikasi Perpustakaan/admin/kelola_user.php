<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi halaman admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak!'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require_once __DIR__ . '/../Config/koneksi.php';

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

$baseUrl = '../';
include '../templates/header.php';
?>

<div class="container">
    <div class="card">
        <div class="flex-between">
            <div>
                <h2 class="main-title">👥 Kelola Akun Pengguna</h2>
                <p class="subtle-title">Tambah, lihat, dan kelola akses pengguna sistem perpustakaan.</p>
            </div>
            <a href="admin_dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
        
        <div class="card" style="background: var(--bg-2); margin-bottom: 24px;">
            <h3 style="margin-top: 0;">Tambah Akun Baru</h3>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label>Password:</label>
                    <input type="text" name="password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label>Hak Akses (Role):</label>
                    <select name="role" class="form-control">
                        <option value="user">Pengunjung Biasa (User)</option>
                        <option value="admin">Administrator (Admin)</option>
                    </select>
                </div>
                
                <input type="submit" name="tambah" value="Simpan Akun Baru" class="btn btn-primary">
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
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
                            <strong class="<?php echo ($row['role'] == 'admin') ? 'text-admin' : 'text-user'; ?>">
                                <?php echo $row['role']; ?>
                            </strong>
                        </td>
                        <td>
                            <?php if ($row['username'] == $_SESSION['username']) { ?>
                                <span class="text-muted">Sedang Dipakai</span>
                            <?php } else { ?>
                                <a href="kelola_user.php?hapus=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus akun <?php echo $row['username']; ?>?');" style="padding: 6px 12px; font-size: 12px;">Hapus</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>