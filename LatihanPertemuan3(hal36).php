<?php
    // cara 1: Menggunakan fungsi array()
    $data = array(
        "nama" => "John Doe",
        "umur" => 30,
        "pekerjaan" => "Programmer"
    );

    // cara 2: Menggunakan sintaks []
    $nilai = [
        "matematika" => 90,
        "fisika" => 85,
        "kimia" => 88
    ];

    // Mengakses elemen array
    echo $data["nama"]; // Output: John Doe
    echo $nilai["fisika"]; // output: 85
?>