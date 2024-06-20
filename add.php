<?php
require 'functions.php';

// Mengecek apakah tombol submit sudah dipencet belum
if (isset($_POST["submit"])) {
    $result = add($_POST);
    if (is_string($result)) {
        echo "<script>
                alert('$result');
            </script>";
    } else {
        echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'index.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>

    <!-- My Style -->
    <link href="style.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form">
        <h1>Tambah Data</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nim">
                <span>NIM</span>
                <input type="text" name="nim" id="nim" required autocomplete="off">
            </label>

            <label for="nama">
                <span>Nama</span>
                <input type="text" name="nama" id="nama" required autocomplete="off">
            </label>

            <label for="alamat">
                <span>Alamat</span>
                <input type="text" name="alamat" id="alamat" required autocomplete="off">
            </label>

            <label for="foto">
                <span>Foto</span>
                <input type="file" name="foto" id="foto">
            </label>

            <button type="submit" name="submit">Tambah</button>
            <a href="index.php">Batal</a>
        </form>
    </div>

</body>

</html>
