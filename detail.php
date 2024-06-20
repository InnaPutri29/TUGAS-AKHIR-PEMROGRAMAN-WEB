<?php
require 'functions.php';

$id = $_GET['id'];

$result = query("SELECT * FROM mahasiswa WHERE id = $id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-detail">
        <h1>Detail Data <?= $result[0]['nama'] ?></h1>
        
        <a class="add" href="index.php">Keluar</a>
        <table border="1px" cellspacing="0" cellpadding="10">
            <tr>
                <th>Foto</th>
                <td><img src="img/<?= $result[0]['foto'] ?>" width="100"></td>
            </tr>
            <tr>
                <th>NIM</th>
                <td><?= $result[0]['nim'] ?></td>
            </tr>
            <tr>
                <th>Nama</th>
                <td><?= $result[0]['nama'] ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?= $result[0]['alamat'] ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
