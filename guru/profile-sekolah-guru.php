<?php

session_start();


if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Profile Sekolah - Qurrotul A'yun";

require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar-guru.php";

$sekolah = mysqli_query($koneksi, "SELECT * FROM tbl_sekolah WHERE id = 1");
$data = mysqli_fetch_assoc($sekolah);


?>

<div id="layoutSidenav_content">
    <main style="flex: 1;">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Sekolah</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../guru/index.php">Home</a></li>
                <li class="breadcrumb-item active">Profile Sekolah</li>
            </ol>
            <div class="card">
                <div class="card-header">
                    <span class="h5"><i class="fa-solid fa-school"></i> Data Sekolah</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Gambar -->
                        <div class="col-4 text-center px-5">
                            <img src="../asset/image/<?= $data['gambar'] ?>" alt="gambar sekolah"
                                class="mb-3 img-thumbnail" width="100%">
                        </div>

                        <!-- Info Sekolah -->
                        <div class="col-8">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9 pt-2">: <?= $data['nama'] ?></div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9 pt-2">: <?= $data['email'] ?></div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9 pt-2">: <?= $data['status'] ?></div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Akreditasi</label>
                                <div class="col-sm-9 pt-2">: <?= $data['akreditasi'] ?></div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9 pt-2">: <?= $data['alamat'] ?></div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Visi dan Misi</label>
                                <div class="col-sm-9 pt-2">: <?= $data['visimisi'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php

    require_once "../template/footer.php";

    ?>