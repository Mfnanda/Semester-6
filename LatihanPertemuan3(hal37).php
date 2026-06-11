<?php
$mahasiswa = [
    ["nama" => "Andi", "umur" => 20],
    ["nama" => "Budi", "umur" => 22],
    ["nama" => "Cici", "umur" => 21]
];
//mengakses elemen array multidimensi
echo $mahasiswa[0]["nama"]; //output: Andi
echo $mahasiswa[1]["umur"]; //output: 22
?>