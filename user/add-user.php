<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Tambah User - Qurrotul A'yun";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$msg = $_GET['msg'] ?? '';
$alert = '';

if ($msg == 'cancel') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-xmark"></i> Tambah user gagal, Username sudah ada...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} elseif ($msg == 'notimage') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-xmark"></i> Tambah user gagal, File yang anda upload bukan gambar...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} elseif ($msg == 'oversize') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-xmark"></i> Tambah user gagal, Maximal ukuran gambar 1 MB...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} elseif ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i> Tambah user berhasil, segera ganti password anda!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>

<body>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tambah User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
                </ol>

                <?php if ($msg !== '') echo $alert; ?>

                <form action="proses-user.php" method="POST" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <span class="h5"><i class="fa-solid fa-square-plus"></i> Tambah User</span>
                            <button type="submit" name="simpan" class="btn btn-primary float-end">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan
                            </button>
                            <button type="reset" name="reset" class="btn btn-danger float-end me-1">
                                <i class="fa-solid fa-xmark"></i> Reset
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Kiri -->
                                <div class="col-8">
                                    <div class="mb-3 row">
                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                        <label class="col-sm-1 col-form-label text-center">:</label>
                                        <div class="col-sm-9">
                                            <input type="text" pattern="[A-Za-z0-9]{3,}"
                                                title="Minimal 3 karakter kombinasi huruf besar kecil dan angka"
                                                class="form-control" id="username" name="username" maxlength="20"
                                                required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                        <label class="col-sm-1 col-form-label text-center">:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nama" name="nama" maxlength="20"
                                                required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                        <label class="col-sm-1 col-form-label text-center">:</label>
                                        <div class="col-sm-9">
                                            <select name="jabatan" id="jabatan" class="form-select" required>
                                                <option value="" selected>--Pilih Jabatan--</option>
                                                <option value="Kepsek">Kepsek</option>
                                                <option value="Staf TU">Staf TU</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Guru">Siswa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="level" class="col-sm-2 col-form-label">Level</label>
                                        <label class="col-sm-1 col-form-label text-center">:</label>
                                        <div class="col-sm-9">
                                            <select name="level" id="level" class="form-select" required>
                                                <option value="" selected>--Pilih Level--</option>
                                                <option value="admin">Admin</option>
                                                <option value="guru">Guru</option>
                                                <option value="siswa">Siswa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <label class="col-sm-1 col-form-label text-center">:</label>
                                        <div class="col-sm-9">
                                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"
                                                placeholder="Alamat lengkap" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- Kanan -->
                                <div class="col-4 text-center px-5">
                                    <img src="../asset/image/default-user.png" alt="Foto User"
                                        class="img-thumbnail mb-3" style="width: 60%; object-fit: cover;">
                                    <div class="mb-2">
                                        <input type="file" name="image" class="form-control form-control-sm">
                                    </div>
                                    <small class="text-muted d-block">Pilih foto PNG, JPG atau JPEG ukuran maksimal 1
                                        MB</small>
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
</body>