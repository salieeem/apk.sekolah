<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";
$title = "Tambah Siswa - Qurrotul A'yun";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$queryNis = mysqli_query($koneksi, "SELECT MAX(nis) AS maxnis FROM tbl_siswa");
$data = mysqli_fetch_array($queryNis);
$maxnis = $data["maxnis"];


$noUrutan = (int) substr($maxnis, 3, 3);
$noUrutan++;
$maxnis = "NIS" . sprintf("%03s", $noUrutan);


?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="siswa.php">Siswa</a></li>
                <li class="breadcrumb-item active">Tambah Siswa</li>
            </ol>

            <form action="proses-siswa.php" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i> Tambah Siswa</span>
                        <div>
                            <button type="reset" name="reset" class="btn btn-danger me-2"><i
                                    class="fa-solid fa-xmark"></i> Reset</button>
                            <button type="submit" name="simpan" class="btn btn-primary"><i
                                    class="fa-solid fa-floppy-disk"></i> Simpan</button>
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
                                        <input type="text" name="nis" required
                                            class="form-control-plaintext border-bottom" id="nis">
                                        <!-- value=<.?= $maxnis ?>" -->
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" name="nama" required
                                            class="form-control-plaintext border-bottom" id="nama">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="kelas" id="kelas" class="form-select border-0 border-bottom"
                                            required>
                                            <option value="" selected>--Pilih Kelas--</option>
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="jurusan" id="jurusan" class="form-select border-0 border-bottom"
                                            required>
                                            <option value="" selected>--Pilih Jurusan--</option>
                                            <option value="IPA">IPA</option>
                                            <option value="IPS">IPS</option>
                                            <option value="Bahasa">Bahasa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3"
                                            placeholder="Alamat Siswa" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto input kanan -->
                            <div class="col-4 text-center px-5">
                                <img src="../asset/image/default-user.png" alt="Foto" class="mb-3 img-thumbnail"
                                    width="120">
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