<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Pertemuan 6</title>
</head>
<body>
    <h2>Program Hitung Hasil KHS</h2>
    <form method="post">
        <label>Input Nilai Tugas:</label>
        <input type="number" name="tugas" min="0" max="100" required>
        <label>Input Nilai UTS:</label>
        <input type="number" name="uts" min="0" max="100" required>
        <label>Input Nilai UAS:</label>
        <input type="number" name="uas" min="0" max="100" required>
        <input type="submit" name="submit" value="Proses">
    </form>
</body>
</html>

<?php
/**
* Fungsi untuk menghitung nilai akhir KHS berdasarkan bobot:
* Tugas: 20%, UTS: 30%, UAS: 50%
*/
function hitungHasilKHS($tugas, $uts, $uas) {
// Menghitung nilai berdasarkan rumus yang diberikan
$nilaiAkhir = ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.5);
return $nilaiAkhir;
}

/**
* Fungsi untuk menentukan Grade (A, B, C, atau D)
* berdasarkan nilai KHS yang sudah dihitung.
*/
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nilaiTugas = isset($_POST['tugas']) ? floatval($_POST['tugas']) : 0;
    $nilaiUTS = isset($_POST['uts']) ? floatval($_POST['uts']) : 0;
    $nilaiUAS = isset($_POST['uas']) ? floatval($_POST['uas']) : 0;

    // 1. Hitung angka nilai akhir
    $hasilAngka = hitungHasilKHS($nilaiTugas, $nilaiUTS, $nilaiUAS);
    // 2. Tentukan huruf grade berdasarkan angka tersebut
    $grade = tentukanGrade($hasilAngka);

    // 3. Tampilkan hasil
    echo "--- Laporan KHS Mahasiswa --- <br>";
    echo "Nilai Tugas: $nilaiTugas <br>";
    echo "Nilai UTS: $nilaiUTS <br>";
    echo "Nilai UAS: $nilaiUAS <br>";
    echo "----------------------------- <br>";
    echo "Total Nilai KHS: <b>$hasilAngka</b> <br>";
    echo "Grade Anda: <b>$grade</b>";
}
?>