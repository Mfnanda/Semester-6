<?php
$nama = $_POST['nama'] ?? "";
$password = $_POST['password'] ?? "";
$gender = $_POST['gender'] ?? "";
$hobby = $_POST['hobby'] ?? [];
$hobby_spesifik = $_POST['hobby_spesifik'] ?? "";
$pendidikan = $_POST['pendidikan'] ?? "";
$alamat = $_POST['alamat'] ?? "";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Biodata</title>
<style>
body{font-family:Arial; text-align:center;}
.box{width:400px; margin:auto; margin-top:30px; padding:20px; border:1px solid
#ccc;}
.hasil{text-align:left; margin-top:15px;}
button{padding:10px; margin-top:10px;}
</style>
</head>
<body>
<div class="box" id="printArea">
<h2>Hasil Biodata</h2>
<div class="hasil">
Nama: <?php echo $nama; ?><br>
Password: <?php echo $password; ?><br>
Gender: <?php echo $gender; ?><br>
Hobby:
<?php
$hobby_list = [];
foreach($hobby as $h){
if($h === "Lainnya" && !empty($hobby_spesifik)){
$hobby_list[] = $hobby_spesifik;
} else {
$hobby_list[] = $h;
}
}
echo implode(", ", $hobby_list);
?>
<br>
Pendidikan: <?php echo $pendidikan; ?><br>
Alamat: <?php echo $alamat; ?><br>
</div>
</div>
<br>
<button onclick="window.print()">🖨️ Print</button>
<br><br>
<a href="biodata.php">← Kembali ke Form</a>
</body>
</html>