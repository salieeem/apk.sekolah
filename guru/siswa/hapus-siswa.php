<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../../auth/login.php");
    exit;
}

require_once "../../config.php";

$id = $_GET['nis'];
$foto = $_GET['foto'];

mysqli_query($koneksi, "DELETE FROM tbl_siswa WHERE nis = '$id'");

if ($foto != 'default-user.jpg') {
    unlink("../../assets/image/$foto");
}

echo "<script>
            alert('Data Siswa Berhasil Dihapus');
            document.location.href='siswa.php';
    </script>";

return;
