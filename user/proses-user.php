<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $nama     = trim(htmlspecialchars($_POST['nama']));
    $jabatan  = $_POST['jabatan'];
    $alamat   = trim(htmlspecialchars($_POST['alamat']));
    $level    = $_POST['level']; // <- Tambahkan ini
    $foto     = trim(htmlspecialchars($_FILES['image']['name']));
    $password = 1234;
    $pass     = password_hash($password, PASSWORD_DEFAULT);

    $cekusername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekusername) > 0) {
        header("location:add-user.php?msg=cancel");
        return;
    }

    if ($foto != null) {
        $url = 'add-user.php';
        $foto = uploadimg($url);
    } else {
        $foto = 'default.png';
    }

    mysqli_query($koneksi, "INSERT INTO tbl_user (username, password, nama, jabatan, alamat, foto, level) 
                            VALUES ('$username', '$pass', '$nama', '$jabatan', '$alamat', '$foto', '$level')")
        or die(mysqli_error($koneksi));

    header("location:add-user.php?msg=added");
    return;
}
