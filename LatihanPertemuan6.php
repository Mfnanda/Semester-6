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
    <h2>Form Input Nilai KHS</h2>
<form method="POST" action="hasilKHS.php">
    <input type="number" name="tugas" min="0" max="100" required><br>
    <input type="number" name="uts" min="0" max="100" required><br>
    <input type="number" name="uas" min="0" max="100" required><br>
    <button type="submit">Kirim</button>
</form>
</div>
</body>
</html>