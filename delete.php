<?php
require 'functions.php';

$id = $_GET['id'];

if (delete($id) > 0) {
    $message = "Data berhasil dihapus";
} else {
    $message = "Data gagal dihapus";
}

echo "<script>
    alert('$message');
    document.location.href = 'index.php';
</script>";
?>
