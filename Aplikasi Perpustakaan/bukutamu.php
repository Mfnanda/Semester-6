<?php
// Logika PHP untuk menyimpan pesan ke database
if (isset($_POST['kirim_pesan'])) {
    require_once __DIR__ . '/Config/koneksi.php';
    /** @var mysqli $koneksi */

    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $instansi = mysqli_real_escape_string($koneksi, trim($_POST['instansi']));
    $pesan = mysqli_real_escape_string($koneksi, trim($_POST['pesan']));

    $query = mysqli_query($koneksi, "INSERT INTO pesan_pengunjung (nama, instansi, pesan) VALUES ('$nama', '$instansi', '$pesan')");

    if ($query) {
        echo "<script>alert('Terima kasih! Pesan Anda berhasil dikirim.'); window.location.href='index.php?menu=kontak';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pesan.');</script>";
    }
}
?>

<div class="card">
    <div class="flex-between" style="margin-bottom: 16px; border-bottom: none; padding-bottom: 0;">
        <div>
            <h2 class="main-title">Kontak Kami</h2>
            <p class="subtle-title">Jika Anda ingin mengajukan kerja sama, bertanya terkait layanan, atau menyampaikan kebutuhan institusi, silakan gunakan kontak berikut.</p>
        </div>
    </div>

    <div class="grid-2" style="margin-top: 16px;">
        <div class="card" style="margin-bottom: 0; background: var(--bg-2);">
            <h4 style="margin-top: 0;">Informasi Perpustakaan</h4>
            <p style="margin: 8px 0;"><strong>Alamat:</strong> Jl. Pendidikan No. 1, Jakarta Raya</p>
            <p style="margin: 8px 0;"><strong>Email:</strong> perpus@kampus.com</p>
            <p style="margin: 8px 0;"><strong>Telepon:</strong> 0812-3456-7890</p>
            <p style="margin: 8px 0;"><strong>Jam Operasional:</strong> Senin - Jumat (08:00 - 16:00 WIB)</p>
        </div>

        <div class="card" style="margin-bottom: 0; background: var(--bg-2);">
            <h4 style="margin-top: 0;">Tinggalkan Pesan</h4>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Asal Instansi / Kampus</label>
                    <input type="text" name="instansi" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Pesan atau Pertanyaan</label>
                    <textarea name="pesan" rows="5" class="form-control" required></textarea>
                </div>

                <input type="submit" name="kirim_pesan" value="Kirim Pesan" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>