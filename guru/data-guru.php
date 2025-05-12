<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";
$title = "Guru - Qurrotul A'yun";
require_once "../template/header.php";
require_once "../template/sidebar-guru.php";
require_once "../template/navbar.php";

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Guru</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../guru/index.php">Home</a></li>
                <li class="breadcrumb-item active">Guru</li>
            </ol>
            <div class="card">
                <div class="card-header">
                    <span class="h5"><i class="fa-solid fa-users"></i> Data Guru</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>No</center>
                                </th>
                                <th scope="col">
                                    <center>Foro</center>
                                </th>
                                <th scope="col">
                                    <center>NIP</center>
                                </th>
                                <th scope="col">
                                    <center>Nama</center>
                                </th>
                                <th scope="col">
                                    <center>Telpon</center>
                                </th>
                                <th scope="col">
                                    <center>Agama</center>
                                </th>
                                <th scope="col">
                                    <center>Alamat</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
                            while ($data = mysqli_fetch_array($queryGuru)) {
                            ?>
                            <tr>
                                <td scope="row">
                                    <center><?= $no++ ?></center>
                                </td>
                                <td>
                                    <center><img src="../asset/image/<?= $data['foto'] ?>"
                                            class="rounded-circle border border-2" width="50" height="50"
                                            style="object-fit: cover;" alt=""></center>
                                </td>
                                <td><?= $data['nip'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['telpon'] ?></td>
                                <td><?= $data['agama'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php

    require_once "../template/footer.php";

    ?>