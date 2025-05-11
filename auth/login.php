<?php

session_start();

if (isset($_SESSION["ssLogin"])) {
    header("Location: ../index.php");
    exit;
}

require_once '../config.php';


$sekolah = mysqli_query($koneksi, "SELECT * FROM tbl_sekolah WHERE id = 1");
$data = mysqli_fetch_array($sekolah);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Qurrotul A'yun</title>
    <link href="<?= $main_url ?>asset/sb-admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="<?= $main_url ?>asset/image/toga.png">

    <!-- GANTI BAGIAN STYLE DENGAN YANG INI -->
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #bgLogin {
            background-image: url("../asset/image/<?= $data['gambar'] ?>");
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 30px 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-logo img {
            width: 100px;
            height: auto;
        }

        .btn-primary {
            border-radius: 30px;
        }

        .card-footer {
            background: none;
        }
    </style>

</head>

<body id="bgLogin">
    <div class="login-card">
        <div class="login-logo">
            <?php
            $role = $_GET['role'] ?? 'admin'; // default ke admin jika tidak diset
            $roleImage = $role . '-image.png'; // akan jadi 'admin-image.png', 'guru-image.png', dst.
            ?>
            <img src="<?= $main_url ?>asset/image/<?= $roleImage ?>" alt="Login Image" style="max-height: 150px;">

            <h3 class="text-center font-weight-light my-4">
                Login - <?= ucfirst($_GET['role'] ?? 'admin') ?>
            </h3>

        </div>
        <form action="proseslogin.php" method="POST">
            <div class="form-floating mb-3">
                <input class="form-control" id="username" name="username" type="text" pattern="[A-Za-z0-9]{3,}" title="Kombinasi huruf dan angka min 3 karakter" placeholder="Username" autocomplete="off" required />
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputPassword" type="password" placeholder="Password" minlength="4" name="password" required />
                <label for="inputPassword">Password</label>
            </div>
            <?php $role = isset($_GET['role']) && in_array($_GET['role'], ['admin', 'guru', 'siswa']) ? $_GET['role'] : 'admin'; ?>
            <input type="hidden" name="role" value="<?= $role ?>">
            <button type="submit" name="login" class="btn btn-primary col-12">Login</button>
            <div class="text-center my-3">
                <small class="text-muted">Login sebagai:</small><br>
                <a href="login.php?role=admin" class="btn btn-outline-secondary btn-sm m-1">Admin</a>
                <a href="login.php?role=guru" class="btn btn-outline-secondary btn-sm m-1">Guru</a>
                <a href="login.php?role=siswa" class="btn btn-outline-secondary btn-sm m-1">Siswa</a>
            </div>
        </form>
        <div class="card-footer text-center py-3">
            <div class="text-muted small">Copyright &copy; Qurrotul A'yun <?= date("Y") ?></div>
        </div>
    </div>
</body>

</html>