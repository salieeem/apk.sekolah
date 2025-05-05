<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$id   = $_GET["id"];
$foto = $_GET["foto"];

mysqli_query($koneksi, "DELETE FROM tbl_guru WHERE id = $id");

if ($foto != 'default-user.jpg') {
    unlink("../asset/image/" . $foto);
}

header("Location:guru.php?msg=deleted");
return;

?>