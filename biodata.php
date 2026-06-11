<!DOCTYPE html>
<html>
<head>
<title>Form Biodata</title>
<style>
    body{font-family:Arial; text-align:left;}
 
    .box{width:400px; margin:auto; margin-top:30px; padding:20px; border:1px solid #ccc;}
    input, select, textarea{width:90%; padding:8px; margin:5px;}
    button{padding:10px; width:95%; background:blue; color:white; cursor:pointer; border:none;}

    .pilihan{width: auto; margin-right: 5px; padding: 0;}
    
    .lainnya-container {
        display: inline-flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
    }
    
    #hobby_lainnya_input {
        width: 150px;
        padding: 8px;
    }
</style>
</head>
<body>
<div class="box">
    <h2>Form Biodata</h2>
<form method="POST" action="hasil.php">
    <input type="text" name="nama" placeholder="Nama"><br>
    <input type="password" name="password" placeholder="Password"><br>
    
    Gender:<br>
    <input type="radio" class="pilihan" name="gender" value="Laki-Laki"> Laki-Laki
    <input type="radio" class="pilihan" name="gender" value="Perempuan"> Perempuan
    <br><br>
    
    Hobby:<br>
    <input type="checkbox" class="pilihan" name="hobby[]" value="Mancing"> Mancing
    <input type="checkbox" class="pilihan" name="hobby[]" value="Game"> Game
    <input type="checkbox" class="pilihan" name="hobby[]" value="Ngoding"> Ngoding
    <span class="lainnya-container">
        <input type="checkbox" class="pilihan" id="check_lainnya" name="hobby[]" value="Lainnya"> Lainnya
        <input type="text" id="hobby_lainnya_input" name="hobby_spesifik" placeholder="Hobi Lainnya?">
    </span>
    
    <br><br>
    Pendidikan:
    <select name="pendidikan">
        <option value="">-- Pilih --</option>
        <option value="SD">SD</option>
        <option value="SMP">SMP</option>
        <option value="SMA">SMA</option>
        <option value="S1">S1</option>
    </select>
    <br><br>
    
    Alamat:<br>
    <textarea name="alamat"></textarea><br>
    <button type="submit">Kirim</button>
</form>
</div>
</body>
</html>