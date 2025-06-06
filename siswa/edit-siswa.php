<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";
$title = "Update Siswa - Qurrotul A'yun";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$nis = $_GET['nis'];

$siswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE nis = '$nis'");
$data = mysqli_fetch_array($siswa);



?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="siswa.php">Siswa</a></li>
                <li class="breadcrumb-item active">Update Siswa</li>
            </ol>

            <form action="proses-siswa.php" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="h5 my-2"><i class="fa-solid fa-pen-to-square"></i> Update Siswa</span>
                        <div>
                            <button type="submit" name="update" class="btn btn-primary"><i
                                    class="fa-solid fa-floppy-disk"></i> Update</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- Form input kiri -->
                            <div class="col-8">
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" name="nis" readonly
                                            class="form-control-plaintext border-bottom" id="nis" value="<?= $nis ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" name="nama" required
                                            class="form-control-plaintext border-bottom" id="nama"
                                            value="<?= $data['nama'] ?>" placeholder="Nama Siswa" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="kelas" id="kelas" class="form-select border-0 border-bottom"
                                            required>
                                            <?php
                                            $kelas = ["X", "XI", "XII"];
                                            foreach ($kelas as $kls) {
                                                if ($data['kelas'] == $kls) { ?>
                                            <option value="<?= $kls; ?>" selected><?= $kls ?></option>
                                            <?php  } else { ?>
                                            <option value="<?= $kls; ?>"><?= $kls ?></option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="jurusan" id="jurusan" class="form-select border-0 border-bottom"
                                            required>
                                            <?php
                                            $jurusan = ["IPA", "IPS", "Bahasa"];
                                            foreach ($jurusan as $jrs) {
                                                if ($data['jurusan'] == $jrs) { ?>
                                            <option value="<?= $jrs; ?>" selected><?= $jrs ?></option>
                                            <?php  } else { ?>
                                            <option value="<?= $jrs; ?>"><?= $jrs ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3"
                                            placeholder="Alamat Siswa" class="form-control"
                                            required><?= $data['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto input kanan -->
                            <div class="col-4 text-center px-5">
                                <input type="hidden" name="fotoLama" value="<?= $data['foto'] ?>">
                                <img src="../asset/image/<?= $data['foto'] ?>" alt="" class="mb-3 rounded" width="120">
                                <input type="file" name="image" class="form-control form-control-sm mb-2">
                                <small class="text-secondary">Pilih foto PNG, JPG atau JPEG ukuran maksimal 1 MB</small>
                                <div><small class="text-secondary">width = height</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>


    <?php

    require_once "../template/footer.php";

    ?>