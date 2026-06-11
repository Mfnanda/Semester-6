<?php

function hitungHasilKHS($tugas, $uts, $uas) {
    return ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.5);
}

function tentukanGrade($nilai) {
    if ($nilai >= 90) {
        return "A";
    } elseif ($nilai >= 80) {
        return "B";
    } elseif ($nilai >= 60) {
        return "C";
    } else {
        return "D";
    }
}

// Inisialisasi biar tidak warning
$nilaiTugas = $nilaiUTS = $nilaiUAS = 0;
$hasilAngka = 0;
$grade = "";
$keterangan = "";
$error = "";

// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validasi kosong
    if (empty($_POST['tugas']) || empty($_POST['uts']) || empty($_POST['uas'])) {
        $error = "Semua field harus diisi!";
    } else {

        $nilaiTugas = floatval($_POST['tugas']);
        $nilaiUTS   = floatval($_POST['uts']);
        $nilaiUAS   = floatval($_POST['uas']);

        // Validasi range nilai
        if ($nilaiTugas < 0 || $nilaiTugas > 100 ||
            $nilaiUTS < 0 || $nilaiUTS > 100 ||
            $nilaiUAS < 0 || $nilaiUAS > 100) {

            $error = "Nilai harus antara 0 - 100";

        } else {

            // Hitung nilai
            $hasilAngka = hitungHasilKHS($nilaiTugas, $nilaiUTS, $nilaiUAS);
            $grade = tentukanGrade($hasilAngka);

            // Keterangan
            if ($hasilAngka >= 85) {
                $keterangan = "Lulus dengan sangat baik";
            } elseif ($hasilAngka >= 70) {
                $keterangan = "Lulus";
            } else {
                $keterangan = "Tidak Lulus";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil KHS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .box1 {
            width: 400px;
            margin: 50px auto;
            padding: 25px;
            background: yellow;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .hasil p {
            margin: 8px 0;
        }

        .error {
            color: red;
            text-align: center;
        }

        .btn {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            background: blue;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="box1">
    <h2>Hasil Nilai KHS</h2>

    <?php if ($error != ""): ?>
        <p class="error"><b><?php echo $error; ?></b></p>
    <?php else: ?>

    <div class="hasil">
        <p>Nilai Tugas : <b><?php echo $nilaiTugas; ?></b></p>
        <p>Nilai UTS   : <b><?php echo $nilaiUTS; ?></b></p>
        <p>Nilai UAS   : <b><?php echo $nilaiUAS; ?></b></p>

        <hr>

        <p>Total Nilai : <b><?php echo number_format($hasilAngka,2); ?></b></p>
        <p>Grade       : <b><?php echo $grade; ?></b></p>
        <p>Keterangan  : <b><?php echo $keterangan; ?></b></p>
    </div>

    <?php endif; ?>

    <div class="btn">
        <a href="LatihanPertemuan6.php">Kembali</a>
    </div>
</div>

</body>
</html>