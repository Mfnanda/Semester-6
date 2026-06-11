<?php
    // Data Mahasiswa dalam array multidimensi
    $mahasiswa = [
        ["nama" => "Andi", "nilai" => 85],
        ["nama" => "Budi", "nilai" => 90],
        ["nama" => "Cici", "nilai" => 78]
    ];

    // Menghitung rata-rata nilai
    $total_nilai = 0;
    foreach ($mahasiswa as $mhs) {
        $total_nilai += $mhs["nilai"];
    }   
    $rata_rata = $total_nilai / count($mahasiswa);

    echo "Rata-rata nilai mahasiswa: " . $rata_rata; // Output: Rata-rata nilai mahasiswa: 84.33
?>