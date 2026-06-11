<?php
// Jika form disubmit
$hasil = "";
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nilai = $_POST['nilai'];

    // Menentukan Kategori Genap/Ganjil menggunakan modulus (%)
    if ($nilai % 2 == 0) {
        $kategori_angka = "Genap";
    } else {
        $kategori_angka = "Ganjil";
    }

    // Percabangan if...elseif...else untuk menentukan grade
    if ($nilai >= 85 && $nilai <= 100) {
        $grade = "A";
    } elseif ($nilai >= 75) { 
        $grade = "B";
    } elseif ($nilai >= 60) {
        $grade = "C";
    } elseif ($nilai >= 50) {
        $grade = "D";
    } else {
        $grade = "E";
    }

    // Menentukan Status Kelulusan (Nilai 60 ke atas dinyatakan Lulus)
    // Ditambahkan warna: Hijau untuk Lulus, Merah untuk Gagal
    if ($nilai >= 60) {
        $status_kelulusan = "<span style='color: green;'>Selamat Anda Lulus!</span>";
    } else {
        $status_kelulusan = "<span style='color: red;'>Waduh Anda Gagal!</span>";
    }

    // Switch untuk pesan tambahan
    switch ($grade) {
        case "A": $pesan = "Hebat! Pertahankan."; break;
        case "B": $pesan = "Bagus, tingkatkan lagi."; break;
        case "C": $pesan = "Cukup, perlu belajar lebih giat."; break;
        case "D": $pesan = "Kurang, ayo lebih rajin."; break;
        default: $pesan = "Sangat kurang, jangan menyerah!"; break;
    }

    // Perulangan contoh: menampilkan angka 1-5
    $loopOutput = "";
    for ($i=1; $i<=5; $i++) {
        $loopOutput .= "Perulangan ke-$i<br>";
    }

    // Menambahkan variabel ke dalam output hasil
    $hasil = "
        <h3>Hasil Penilaian</h3>
        <p>Nama : <b>$nama</b></p>
        <p>Nilai : <b>$nilai</b></p>
        <p>Grade : <b>$grade</b></p>
        <p>Keterangan : <b>$kategori_angka</b></p>
        <p>Status : <b>$status_kelulusan</b></p>
        <p>Pesan : $pesan</p>
        <h4>Contoh Perulangan:</h4>
        $loopOutput
    ";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Program Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #2c3e50;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            max-width: 400px;
        }
        input[type=text], input[type=number] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type=submit] {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background: #2980b9;
        }
        .hasil {
            margin-top: 20px;
            background: #ecf0f1;
            padding: 15px;
            border-radius: 8px;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <h2>Program Penilaian Mahasiswa</h2>
    <form method="post">
        <label>Nama Mahasiswa:</label>
        <input type="text" name="nama" required>
        <label>Nilai (0-100):</label>
        <input type="number" name="nilai" min="0" max="100" required>
        <input type="submit" name="submit" value="Proses">
    </form>

    <?php if ($hasil != ""): ?>
        <div class="hasil">
            <?php echo $hasil; ?>
        </div>
    <?php endif; ?>
</body>
</html>