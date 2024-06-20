<?php
require 'functions.php';

$result = query("SELECT * FROM mahasiswa ORDER BY nim ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <!-- My Style -->
    <link href="style.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css">
</head>

<body>
    <div class="container">
        <h1>Data Mahasiswa Universitas CINA</h1>

        <div class="action">
            <a class="add" href="add.php">Tambah Data</a>
        </div>

        <div class="table">
            <table border="1px" cellspacing="0" cellpadding="10">
                <tr class="tHead">
                    <th>No</th>
                    <th>Foto</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Detail</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                </tr>

                <?php $i = 1 ?>
                <?php foreach ($result as $row): ?>
                    <tr class="tData">
                        <td><?= $i; ?></td>
                        <td><img src="img/<?= $row["foto"]; ?>" width="100"></td>
                        <td><?= $row["nim"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["alamat"]; ?></td>
                        <td>
                            <a href="detail.php?id=<?= $row['id'] ?>" style="color: black; text-align: center;">
                                <i data-feather="info" width="15px" height="15px"></i>
                            </a>
                        </td>
                        <td>
                            <a href="update.php?id=<?= $row['id'] ?>" style="color: black; text-align: center;">
                                <i data-feather="edit" width="15px" height="15px"></i>
                            </a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('Apakah anda ingin menghapus data <?= $row['nama']; ?>')"
                                style="color: black; text-align: center;">
                                <i data-feather="trash-2" width="15px" height="15px"></i>
                            </a>
                        </td>
                    </tr>

                    <?php $i++; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <!-- My script -->
    <script src="js/script.js"></script>

</body>

</html>
