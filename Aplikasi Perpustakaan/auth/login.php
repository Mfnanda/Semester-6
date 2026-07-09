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
    require 'config/koneksi.php';
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

<div style="max-width: 350px; margin: 40px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; font-family: sans-serif;">
    <h3 style="text-align: center; margin-top: 0; color: #333;">Login Sistem</h3>
    <p style="text-align: center; font-size: 13px; color: #666;">Silakan masuk untuk melanjutkan</p>
    
    <form action="" method="POST">
        <label style="font-size: 14px; font-weight: bold; color: #444;">Username:</label><br>
        <input type="text" name="username" required style="width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><br>
        
        <label style="font-size: 14px; font-weight: bold; color: #444;">Password:</label><br>
        <input type="password" name="password" required style="width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><br>
        
        <input type="submit" name="login" value="Masuk" style="width: 100%; padding: 10px; background-color: #333; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
    </form>
</div>