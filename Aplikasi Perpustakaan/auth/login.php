<?php
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
    require 'config/koneksi.php';
    /** @var mysqli $koneksi */
    $username = $_POST['username'];
    $password = $_POST['password']; // Ingat: di sistem nyata, password harus di-hash (MD5/Bcrypt). Ini versi dasar untuk belajar.

    // Mencari kecocokan data di database
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        
        // Simpan data ke dalam session
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['role'] = $data['role'];

        // Cek rolenya apa, lalu arahkan (redirect)
        if ($data['role'] == 'admin') {
            echo "<script>alert('Selamat datang, Admin!'); window.location.href='admin/admin_dashboard.php';</script>";
        } else if ($data['role'] == 'user') {
            echo "<script>alert('Selamat datang, User!'); window.location.href='user/user_home.php';</script>";
        }
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>

<div style="max-width: 350px; margin: 40px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
    <h3 style="text-align: center; margin-top: 0;">Login Sistem</h3>
    <p style="text-align: center; font-size: 13px;">Silakan masuk untuk melanjutkan</p>
    
    <form action="" method="POST">
        Username: <br>
        <input type="text" name="username" required><br>
        
        Password: <br>
        <input type="password" name="password" required><br>
        
        <input type="submit" name="login" value="Masuk" style="width: 100%; margin-top: 15px;">
    </form>
</div>