<?php
session_start();
require_once "../config.php";

// Cek apakah tombol login ditekan
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $role = $_POST['role'] ?? 'admin'; // Default ke 'admin' jika tidak ada

    // Query untuk mendapatkan data pengguna berdasarkan username dan peran
    $result = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username' AND level = '$role'");

    // Cek apakah pengguna ditemukan
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user["password"])) {
            // Set session
            $_SESSION["ssLogin"] = true;
            $_SESSION["ssUser"] = $user['username'];
            $_SESSION["ssLevel"] = $user['level'];

            // Redirect berdasarkan peran
            if ($user['level'] == 'admin') {
                header("Location: ../index.php");
            } elseif ($user['level'] == 'guru') {
                header("Location: ../guru/index.php");
            } elseif ($user['level'] == 'siswa') {
                header("Location: ../siswa/index.php");
            }
            exit;
        } else {
            echo "<script>
                    alert('Password salah!');
                    document.location.href = 'login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Username atau peran tidak ditemukan!');
                document.location.href = 'login.php';
              </script>";
    }
} else {
    // Jika akses langsung ke file ini tanpa melalui form login
    header("Location: login.php");
    exit;
}