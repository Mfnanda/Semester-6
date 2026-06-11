<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuis dan Latihan - Jawaban Lengkap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .kotak-soal {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h3 {
            margin-top: 0;
            color: #333;
        }
    </style>
</head>
<body>

    <h2>Jawaban Kuis dan Latihan</h2>

    <div class="kotak-soal">
        <h3>Soal 1: Menghitung Biaya Pengecatan Dinding</h3>
        <?php
        $luas_dinding = 3 * 4;
        $luas_pintu = 1 * 2;
        $luas_jendela = 1 * 1;
        $luas_cat = $luas_dinding - ($luas_pintu + $luas_jendela);
        $biaya_per_meter = 25000;
        $total_biaya = $luas_cat * $biaya_per_meter;

        echo "Luas dinding yang diberi cat: " . $luas_cat . " m<sup>2</sup> <br>";
        echo "Total biaya pengecatan: Rp. " . number_format($total_biaya, 0, ',', '.');
        ?>
    </div>

    <div class="kotak-soal">
        <h3>Soal 2: Form Aksi dan Looping</h3>
        <form method="POST" action="">
            <label>Nama: </label>
            <input type="text" name="nama" required><br><br>
            
            <label>Aksi: </label><br>
            <input type="radio" name="aksi" value="Melangkah" required> Melangkah<br>
            <input type="radio" name="aksi" value="Melompat"> Melompat<br><br>
            
            <label>Jumlah: </label>
            <input type="number" name="jumlah" required><br><br>
            
            <input type="submit" name="submit" value="Go">
        </form>
        <br>

        <?php
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $aksi = $_POST['aksi'];
            $jumlah = $_POST['jumlah'];

            echo "<strong>Output:</strong><br>";
            for ($i = 1; $i <= $jumlah; $i++) {
                echo "$nama $aksi $i kali <br>";
            }
            echo "$nama berhenti $aksi";
        }
        ?>
    </div>

    <div class="kotak-soal">
        <h3>Soal 3: Output Logika NPM</h3>
        <p><em>NPM Akhir: 02 ($a=0, $b=2)</em></p>
        <?php
        //  digit NPM terakhir saya 02
        $a = 0;
        $b = 2;

        $c = $a < $b;
        echo "0 < 2 : $c"; 
        echo "<hr>";
        
        $c = $a == $b;
        echo "0 == 2 : $c";
        echo "<hr>";
        
        $c = $a >= $b;
        echo "0 >= 2 : $c";
        ?>
    </div>

    <div class="kotak-soal">
        <h3>Soal 4: Menghitung Volume Tabung</h3>
        <?php
     
        if (!defined('PHI')) {
            define("PHI", 3.14);
        }

        $r = 10;
        $t = 20;
        $volume = PHI * ($r * $r) * $t;
        echo "Konstanta PHI = " . PHI . "<br>";
        echo "Jari-jari (r) = $r <br>";
        echo "Tinggi (t) = $t <br>";
        echo "Perhitungan Volume Tabung = " . PHI . " x $r<sup>2</sup> x $t <br>";
        echo "<strong>Hasil Volume Tabung = $volume</strong>";
        ?>
    </div>

</body>
</html>