<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_prakweb");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function add($data)
{
    global $conn;

    $nim = htmlspecialchars($data['nim']);
    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $foto = upload();

    if (!$foto) {
        return "Upload foto gagal";
    }

    // Cek apakah NIM sudah ada di database
    $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return "NIM sudah digunakan";
    } else {
        // Jika NIM belum ada, lanjutkan proses INSERT
        $query = "INSERT INTO mahasiswa (nim, nama, alamat, foto) VALUES ('$nim', '$nama', '$alamat', '$foto')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}

function upload() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
            alert('Pilih gambar terlebih dahulu!');
        </script>";
        return false;
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('Yang anda upload bukan gambar!');
        </script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
            alert('Ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    // Lolos pengecekan, gambar siap diupload
    // Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;

    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $alamat = htmlspecialchars($data['alamat']);
    $foto = upload();

    if (!$foto) {
        return "Upload foto gagal";
    }

    // Cek apakah NIM sudah ada di database
    $query = "SELECT * FROM mahasiswa WHERE nim = '$nim' AND id != $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return "NIM sudah digunakan";
    } else {
        // Jika NIM belum ada, lanjutkan proses UPDATE
        $query = "UPDATE mahasiswa SET
                nim = '$nim',
                nama = '$nama',
                alamat = '$alamat',
                foto = '$foto'
                WHERE id = $id
            ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}
?>
