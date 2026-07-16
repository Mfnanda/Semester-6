<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses Ditolak!'); window.location.href='../index.php?menu=login';</script>";
    exit();
}

require_once __DIR__ . '/../Config/koneksi.php';
/** @var mysqli $koneksi */

$query = mysqli_query($koneksi, "SELECT * FROM pesan_pengunjung ORDER BY created_at DESC");
if (!$query) {
    $pesanError = 'Tidak dapat mengambil data pesan saat ini.';
} else {
    $pesanError = null;
}

$baseUrl = '../';
include '../templates/header.php';
?>

<div class="container">
    <div class="card">
        <div class="flex-between">
            <div>
                <h2 class="main-title">Daftar Pesan Kontak</h2>
                <p class="subtle-title">Semua pesan dari pengunjung yang masuk melalui form kontak.</p>
            </div>
            <a href="admin_dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Pesan</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pesanError)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted"><?php echo htmlspecialchars($pesanError); ?></td>
                        </tr>
                    <?php elseif (mysqli_num_rows($query) > 0): ?>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo htmlspecialchars($row['nama']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['instansi']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($row['pesan'])); ?></td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada pesan yang masuk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
