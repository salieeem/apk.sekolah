<?php

session_start();

require_once "../config.php";

$role = $_POST['role'] ?? 'admin';
$query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username' AND level = '$role'");


// jika tombol login ditekan
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // hanya cek berdasarkan username dulu
    $resul = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

    // cek apakah username ditemukan
    if (mysqli_num_rows($resul) === 1) {
        $row = mysqli_fetch_assoc($resul);

        // verifikasi password
        if (password_verify($password, $row["password"])) {
            // set session login di sini kalau perlu
            $_SESSION["ssLogin"] = true;
            $_SESSION["ssUser"] = $username;
            header("Location: ../index.php");
            exit;
        } else {
            echo "<script>
                    alert('Password salah!');
                    document.location.href = 'login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Username tidak terdaftar!');
                document.location.href = 'login.php';
              </script>";
    }
}
