<?php

session_start();


if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once '../config.php';

// jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $id         = $_POST['id'];
    $nama       = trim(htmlspecialchars($_POST['nama']));
    $email      = trim(htmlspecialchars($_POST['email']));
    $status     = $_POST['status'];
    $akreditasi = $_POST['akreditasi'];
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $visimisi   = $_POST['visimisi'];
    $gbr        = trim(htmlspecialchars($_POST['gbrLama']));

    // cek apakah ada upload gambar baru
    if ($_FILES['image']['error'] == 0) {
        $url = 'profile-sekolah.php';
        $gbrSekolah = uploadimg($url);
        @unlink('../asset/image/' . $gbr); // fix typo path
    } else {
        $gbrSekolah = $gbr;
    }

    // update data
    mysqli_query($koneksi, "UPDATE tbl_sekolah SET 
                nama = '$nama', 
                email = '$email', 
                status = '$status', 
                akreditasi = '$akreditasi', 
                alamat = '$alamat', 
                visimisi = '$visimisi', 
                gambar = '$gbrSekolah' 
                WHERE id = '$id'
                ") or die(mysqli_error($koneksi));
                
    header("location: profile-sekolah.php?msg=updated");
    return;
}
?>
