<?php

// buat koneksi
$koneksi = mysqli_connect("sql313.byethost5.com", "b5_38928852", "LgHNiq#j*Z5wDkP", "b5_38928852_db_sekolah");

// cek koneksi
//  if (mysqli_connect_errno()) {
//     echo "Gagal koneksi ke database";
// } else {
//     echo "berhasil koneksi";
// }

// url induk

$main_url = "http://qurrotaayun.byethost5.com/";


function uploadimg($url)
{
    $namafile = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmp = $_FILES['image']['tmp_name'];

    $validExtension = ['jpg', 'jpeg', 'png'];
    $fileExtension = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $validExtension)) {
        header("location: " . $url . '?msg=notimage');
        die;
    }

    if ($ukuran > 5000000) {
        header("location: " . $url . '?msg=oversize');
        die;
    }

    if ($url == 'profile-sekolah.php') {
        $namafilebaru = rand(0, 50) . '-bgLogin.' . $fileExtension;
    } else {
        $namafilebaru = rand(10, 1000) . '-' . $namafile;
    }

    // ✅ gunakan path absolut dari root project
    $targetPath = __DIR__ . "/asset/image/" . $namafilebaru;
    move_uploaded_file($tmp, $targetPath);

    return $namafilebaru;
}
