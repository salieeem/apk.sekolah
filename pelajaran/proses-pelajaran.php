<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $pelajaran = htmlspecialchars($_POST['pelajaran']);
    $kelas = $_POST['kelas'];
    $guru = $_POST['guru'];
    
    $cekPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE pelajaran='$pelajaran'");
    if (mysqli_num_rows($cekPelajaran) > 0) {
        header("location:pelajaran.php?msg=cancel");
        return;
    }

    mysqli_query($koneksi, "INSERT INTO tbl_pelajaran VALUES (null, '$pelajaran', '$kelas', '$guru')");
    header("location:pelajaran.php?msg=added");
    return;    
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $pelajaran = htmlspecialchars($_POST['pelajaran']);
    $kelas = $_POST['kelas'];
    $guru = $_POST['guru'];

    $queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE id = $id");
    $data = mysqli_fetch_array($queryPelajaran);
    $curPelajaran = $data['pelajaran'];

    $cekPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE pelajaran = '$pelajaran'");

    // if ($pelajaran == $curPelajaran) {
    //     if (mysqli_num_rows($cekPelajaran) > 0) {
    //         header("location:pelajaran.php?msg=cancelupdate");
    //         return;
    // }

    // }

    mysqli_query($koneksi, "UPDATE tbl_pelajaran SET pelajaran = '$pelajaran', kelas = '$kelas', guru = '$guru' WHERE id = $id");

    header("location:pelajaran.php?msg=updated");
    return;

}

