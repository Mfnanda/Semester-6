<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PROTEKSI HALAMAN
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    echo "<script>
            alert('Akses Ditolak! Silakan login terlebih dahulu.');
            window.location.href='../index.php?menu=login';
          </script>";
    exit();
}

require_once __DIR__ . '/../Config/koneksi.php';

$username_aktif = $_SESSION['username'];

// Statistik User
$query_total = mysqli_query(
    $koneksi,
    "SELECT * FROM peminjaman WHERE username='$username_aktif'"
);
$total_riwayat = mysqli_num_rows($query_total);
$query_aktif = mysqli_query(
    $koneksi,
    "SELECT * FROM peminjaman
     WHERE username='$username_aktif'
     AND status='Dipinjam'"
);
$buku_dipegang = mysqli_num_rows($query_aktif);

$baseUrl = '../';
include '../templates/header.php';
?>

<div class="container">

    <div class="card">

        <!-- Header -->
        <div>
            <h2 class="main-title">
                👋 Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            </h2>

            <p class="subtle-title">
                Selamat datang di ruang baca pribadi Anda.
            </p>
        </div>

        <hr style="margin:20px 0; border:none; border-top:1px solid #e5e7eb;">

        <!-- Statistik -->
        <div class="grid-2">

            <div class="stat-card bg-purple">
                <h3><?php echo $total_riwayat; ?></h3>
                <p>📚 Riwayat Peminjaman</p>
            </div>

            <div class="stat-card bg-teal">
                <h3><?php echo $buku_dipegang; ?></h3>
                <p>📖 Buku Dipinjam</p>
            </div>

        </div>

        <!-- Menu Cepat -->
        <h3 style="margin-top:24px;">Mulai Aktivitas</h3>

        <div class="grid-2">

            <a href="../index.php?menu=koleksi"
               class="card text-center"
               style="margin-bottom:0;">

                <h3>📖 Eksplorasi Koleksi</h3>

                <p class="text-muted">
                    Cari dan baca buku favoritmu.
                </p>

            </a>

            <a href="form_pinjam.php"
               class="card text-center"
               style="margin-bottom:0;">

                <h3>✍️ Pinjam Buku Baru</h3>

                <p class="text-muted">
                    Isi form reservasi fisik.
                </p>

            </a>

        </div>

        <!-- Riwayat -->
        <div class="card" style="margin-top:24px;">

            <h3>Status Buku Saya</h3>

            <div class="table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Judul Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php

                    $query_riwayat = mysqli_query(
                        $koneksi,
                        "SELECT * FROM peminjaman
                         WHERE username='$username_aktif'
                         ORDER BY id DESC
                         LIMIT 5"
                    );

                    if (mysqli_num_rows($query_riwayat) > 0) {

                        while ($row = mysqli_fetch_assoc($query_riwayat)) {

                            $cls = 'badge-warning';

                            if ($row['status'] == 'Dipinjam') {
                                $cls = 'badge-info';
                            }

                            if ($row['status'] == 'Dikembalikan') {
                                $cls = 'badge-success';
                            }

                    ?>

                        <tr>

                            <td>
                                <strong>
                                    <?php echo htmlspecialchars($row['judul_buku']); ?>
                                </strong>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['tanggal_pinjam']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['tanggal_kembali']); ?>
                            </td>

                            <td>
                                <span class="badge <?php echo $cls; ?>">
                                    <?php echo htmlspecialchars($row['status']); ?>
                                </span>
                            </td>

                        </tr>

                    <?php

                        }

                    } else {

                        echo "
                        <tr>
                            <td colspan='4'
                                class='text-center text-muted'>
                                Belum ada riwayat.
                            </td>
                        </tr>";
                    }

                    ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include '../templates/footer.php'; ?>