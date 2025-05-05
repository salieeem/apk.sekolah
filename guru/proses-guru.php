<?php

session_start();

if (!isset($_SESSION['ssLogin']) ) {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $nip = htmlspecialchars($_POST['nip']);
    $nama = htmlspecialchars($_POST['nama']);
    $telpon = htmlspecialchars($_POST['telpon']);
    $agama = $_POST['agama'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $foto = htmlspecialchars($_FILES['image']['name']);

    $cekNip = mysqli_query($koneksi, "SELECT nip FROM tbl_guru WHERE nip='$nip'");
    if (mysqli_num_rows($cekNip) > 0) {
        header('location:add-guru.php?msg=cancel');
        return;

    }


    if ($foto != null) {
        $url = "add-guru.php";
        $foto = uploadimg($url);

    } else {
        $foto = 'default-user.png';
    }

    mysqli_query($koneksi, "INSERT INTO tbl_guru VALUES (null, '$nip', '$nama', '$alamat', '$telpon', '$agama', '$foto')");

    header("location:add-guru.php?msg=added");
    return;
    }

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nip = htmlspecialchars($_POST['nip']);
    $nama = htmlspecialchars($_POST['nama']);
    $telpon = htmlspecialchars($_POST['telpon']);
    $agama = $_POST['agama'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $foto = htmlspecialchars($_POST['fotoLama']);

    $sqlGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru WHERE id=$id");
    $data = mysqli_fetch_array($sqlGuru);
    $curNip = $data['nip'];

    $newNip = mysqli_query($koneksi, "SELECT nip FROM tbl_guru WHERE nip='$nip'");

    if ($nip != $curNip) {
        if (mysqli_num_rows($newNip) > 0) {
            header("location:edit-guru.php?msg=cancel");
            return;
        }
    }
    
    if ($_FILES['image']['error'] === 4) {
        $fotoguru = $foto;
    } else {
        $url = "guru.php";
        $foto = uploadimg($url);
        if ($foto !== 'defalut.png') {
            @unlink('../asset/image/' . $foto);
        }
    }

    mysqli_query($koneksi, "UPDATE tbl_guru SET 
                nip='$nip', nama='$nama', telpon='$telpon', agama='$agama', alamat='$alamat', foto='$fotoguru' WHERE id=$id");


    header("location:guru.php?msg=updated");
    return;
}




?>