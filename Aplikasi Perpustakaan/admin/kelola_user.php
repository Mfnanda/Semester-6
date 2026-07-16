<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'master'])) {
    echo "<script>
            alert('Akses Ditolak!');
            window.location.href='../index.php?menu=login';
          </script>";
    exit();
}

require_once __DIR__ . '/../Config/koneksi.php';

$isMaster = ($_SESSION['role'] === 'master');


// ======================
// TAMBAH USER
// ======================
if (isset($_POST['tambah'])) {

    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = mysqli_real_escape_string($koneksi, trim($_POST['password']));
    $role     = mysqli_real_escape_string($koneksi, trim($_POST['role']));

    // ADMIN hanya boleh membuat user/admin
    if (!$isMaster && $role == 'master') {

        echo "<script>
                alert('Admin tidak dapat membuat akun Master!');
              </script>";

    } else {

        $cek = mysqli_query(
            $koneksi,
            "SELECT * FROM users WHERE username='$username'"
        );

        if (mysqli_num_rows($cek) > 0) {

            echo "<script>
                    alert('Username sudah digunakan!');
                  </script>";

        } else {

            mysqli_query(
                $koneksi,
                "INSERT INTO users(username,password,role)
                 VALUES('$username','$password','$role')"
            );

            echo "<script>
                    alert('Akun berhasil ditambahkan!');
                    window.location='kelola_user.php';
                  </script>";
            exit();
        }
    }
}



// ======================
// HAPUS USER
// ======================
if (isset($_GET['hapus'])) {

    $id = (int) $_GET['hapus'];

    $cekUser = mysqli_query(
        $koneksi,
        "SELECT * FROM users WHERE id='$id'"
    );

    if (mysqli_num_rows($cekUser) > 0) {

        $target = mysqli_fetch_assoc($cekUser);

        // Tidak boleh hapus akun sendiri
        if ($target['username'] == $_SESSION['username']) {

            echo "<script>
                    alert('Tidak dapat menghapus akun sendiri!');
                    window.location='kelola_user.php';
                  </script>";
            exit();
        }

        // ADMIN hanya boleh hapus USER
        if ($_SESSION['role'] == 'admin') {

            if ($target['role'] != 'user') {

                echo "<script>
                        alert('Admin hanya dapat menghapus User!');
                        window.location='kelola_user.php';
                      </script>";
                exit();
            }
        }

        // MASTER tidak boleh hapus MASTER
        if ($_SESSION['role'] == 'master') {

            if ($target['role'] == 'master') {

                echo "<script>
                        alert('Master tidak dapat menghapus akun Master!');
                        window.location='kelola_user.php';
                      </script>";
                exit();
            }
        }

        mysqli_query(
            $koneksi,
            "DELETE FROM users WHERE id='$id'"
        );

        echo "<script>
                alert('Akun berhasil dihapus!');
                window.location='kelola_user.php';
              </script>";
        exit();
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
                <p class="subtle-title">
                    Tambah dan kelola akun pengguna sistem.
                </p>
            </div>

            <a href="admin_dashboard.php" class="btn btn-secondary">
                Kembali ke Dashboard
            </a>

        </div>

        <div class="card" style="background: var(--bg-2); margin-bottom:24px;">

            <h3>Tambah Akun Baru</h3>

            <form method="POST">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="text"
                           name="password"
                           class="form-control"
                           required>
                </div>

                <div class="form-group">
                    <label>Role</label>

                    <select name="role" class="form-control">

                        <option value="user">User</option>
                        <option value="admin">Admin</option>

                        <?php if ($isMaster): ?>
                            <option value="master">Master</option>
                        <?php endif; ?>

                    </select>
                </div>

                <button type="submit"
                        name="tambah"
                        class="btn btn-primary">
                    Simpan Akun Baru
                </button>

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

                $query = mysqli_query(
                    $koneksi,
                    "SELECT * FROM users ORDER BY id ASC"
                );

                $no = 1;

                while ($row = mysqli_fetch_assoc($query)) {

                ?>

                    <tr>

                        <td><?php echo $no++; ?></td>

                        <td>
                            <?php echo htmlspecialchars($row['username']); ?>
                        </td>

                        <td>

                            <?php

                            if ($row['role'] == 'master') {

                                echo "<span class='badge badge-danger'>👑 MASTER</span>";

                            } elseif ($row['role'] == 'admin') {

                                echo "<span class='badge badge-warning'>🛠 ADMIN</span>";

                            } else {

                                echo "<span class='badge badge-info'>👤 USER</span>";
                            }

                            ?>

                        </td>

                        <td>

                            <?php

                            if ($row['username'] == $_SESSION['username']) {

                                echo "<span class='text-muted'>Akun Anda</span>";

                            } elseif (
                                $_SESSION['role'] == 'admin' &&
                                ($row['role'] == 'admin' || $row['role'] == 'master')
                            ) {

                                echo "<span class='text-muted'>Tidak Diizinkan</span>";

                            } else {

                            ?>

                                <a href="kelola_user.php?hapus=<?php echo $row['id']; ?>"
                                   class="btn btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus akun ini?')">
                                    Hapus
                                </a>

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