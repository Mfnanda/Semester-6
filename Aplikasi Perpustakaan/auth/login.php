<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek jika sudah login, langsung arahkan ke halaman masing-masing
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/admin_dashboard.php");
        exit();
    } else {
        header("Location: user/user_home.php");
        exit();
    }
}

// Jika tombol login ditekan
if (isset($_POST['login'])) {
    require_once __DIR__ . '/../Config/koneksi.php';
    /** @var mysqli $koneksi */
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']); 

    // COCOKKAN TEKS BIASA: Mencari username dan password secara langsung
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        
        // Simpan username dan role ke session
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        // Arahkan berdasarkan role
        if ($data['role'] == 'admin') {
            echo "<script>alert('Selamat datang, Admin!'); window.location.href='admin/admin_dashboard.php';</script>";
        } else if ($data['role'] == 'user') {
            echo "<script>alert('Selamat datang, User!'); window.location.href='user/user_home.php';</script>";
        }
        exit();
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>

<div class="card card-small">
    <div class="text-center" style="margin-bottom: 20px;">
        <h3 style="margin-bottom: 6px;">Portal Akses Sistem</h3>
        <p class="text-muted" style="margin: 0;">Masuk untuk mengakses layanan perpustakaan</p>
    </div>

    <form action="" method="POST">
        <div class="form-group text-left">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group text-left">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <input type="submit" name="login" value="Masuk Sekarang" class="btn btn-primary btn-full">
    </form>
</div>