<?php
require 'functions.php';

$id = $_GET["id"];

$rows = query("SELECT * FROM mahasiswa WHERE id = $id");

if (isset($_POST["submit"])) {
    if (update($_POST) > 0) {
        echo "<script>
                document.location.href = 'index.php';
                alert('Data berhasil diedit');
            </script>";
    } else {
        echo "<script>
                document.location.href = 'index.php';
                alert('NIM sudah digunakan. Data gagal diedit.');
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form">
        <h1>Edit Data</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $rows[0]["id"] ?>">
            <input type="hidden" name="fotoLama" value="<?= $rows[0]["foto"] ?>">

            <label for="nim">
                <span>NIM</span>
                <input type="text" name="nim" id="nim" required value="<?= $rows[0]["nim"] ?>">
            </label>

            <label for="nama">
                <span>Nama</span>
                <input type="text" name="nama" id="nama" required value="<?= $rows[0]["nama"] ?>">
            </label>

            <label for="alamat">
                <span>Alamat</span>
                <input type="text" name="alamat" id="alamat" required value="<?= $rows[0]["alamat"] ?>">
            </label>

            <label for="foto">
                <span>Foto</span>
                <input type="file" name="foto" id="foto">
            </label>
            <img src="img/<?= $rows[0]['foto'] ?>" width="50">

            <button type="submit" name="submit">Simpan</button>
            <a href="index.php">Batal</a>
        </form>
    </div>
</body>

</html>
