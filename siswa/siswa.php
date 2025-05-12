<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";
$title = "Siswa - Qurrotul A'yun";
require_once "../template/header.php";
require_once "../template/sidebar.php";
require_once "../template/navbar.php";

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> Daftar Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Siswa</li>
            </ol>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="h5 my-2"><i class="fa-solid fa-list-ul"></i> Data Siswa</span>
                    <a href="<?= $main_url ?>siswa/add-siswa.php" class="btn btn-primary">
                        <i class="fa-solid fa-user-plus"></i> Tambah Siswa
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                        <thead class="table-light">
                            <th scope="col">
                                <center>No</center>
                            </th>
                            <th scope="col">
                                <center>Foto</center>
                            </th>
                            <th scope="col">
                                <center>NIS</center>
                            </th>
                            <th scope="col">
                                <center>Nama</center>
                            </th>
                            <th scope="col">
                                <center>Kelas</center>
                            </th>
                            <th scope="col">
                                <center>Jurusan</center>
                            </th>
                            <th scope="col">
                                <center>Alamat</center>
                            </th>
                            <th scope="col">
                                <center>Operasi</center>
                            </th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $querySiswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa");
                            while ($data = mysqli_fetch_array($querySiswa)) {
                                $foto = (!empty($data['foto']) && file_exists("../asset/image/{$data['foto']}"))
                                    ? $data['foto']
                                    : 'default-user.png';
                            ?>
                            <tr>
                                <td scope="row">
                                    <center><?= $no++ ?></center>
                                </td>
                                <td style="text-align: center;">
                                    <center>
                                        <img src="../asset/image/<?= $foto ?>" class="rounded-circle border border-2"
                                            width="50" height="50" style="object-fit: cover;">
                                    </center>
                                </td>
                                <td><?= $data['nis'] ?></td>
                                <td><?= ucwords($data['nama']) ?></td>
                                <td>
                                    <center><?= $data['kelas'] ?></center>
                                </td>
                                <td>
                                    <center><?= $data['jurusan'] ?></center>
                                </td>
                                <td><?= $data['alamat'] ?></td>
                                <td>
                                    <center>
                                        <a href="edit-siswa.php?nis=<?= $data['nis'] ?>"
                                            class="btn btn-warning btn-sm me-1" title="Update"><i
                                                class="fa-solid fa-pen"></i></a>
                                        <a href="hapus-siswa.php?nis=<?= $data['nis'] ?>&foto=<?= $data['foto'] ?>"
                                            class="btn btn-danger btn-sm" title="Hapus Siswa"
                                            onclick="return confirm('Anda yakin akan menghapus data ini?')"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </center>
                                </td>
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