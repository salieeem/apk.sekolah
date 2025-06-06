<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("Location:../auth/login.php");
    exit;
}

require_once "../config.php";
$title = "Data Ujian - Qurrotul A'yun";
require_once "../template/header.php";
require_once "../template/sidebar.php";
require_once "../template/navbar.php";

?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Ujian</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Data Ujian</li>
            </ol>
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-list-ul"></i> Data Ujian
                    <a href="nilai-ujian.php" class="btn btn-sm btn-primary float-end ms-1"><i
                            class="fa-solid fa-plus"></i>Tambah Data ujian</a>
                    <div class="dropdown" style="margin-top: -30px;">
                        <button class="btn btn-primary btn-sm dropdown-toggle float-end" type="button"
                            data-bs-toggle="dropdown">Cetak</button>
                        <ul class="dropdown-menu">
                            <li><button type="button" onclick="printDoc()" class="dropdown-item"><i
                                        class="fa-solid fa-magnifying-glass"></i> Hasil Ujian</button></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#mdlCetak"><i class="fa-solid fa-magnifying-glass"></i> Nilai
                                    Ujian</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>No Ujian</center>
                                </th>
                                <th scope="col">
                                    <center>NIS</center>
                                </th>
                                <th scope="col">
                                    <center>Jurusan</center>
                                </th>
                                <th scope="col">
                                    <center>Total Nilai</center>
                                </th>
                                <th scope="col">
                                    <center>Nilai Terendah</center>
                                </th>
                                <th scope="col">
                                    <center>Nilai Tertinggi</center>
                                </th>
                                <th scope="col">
                                    <center>Nilai Rata-rata</center>
                                </th>
                                <th scope="col">
                                    <center>Hasil Ujian</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryUjian = mysqli_query($koneksi, "SELECT * FROM tbl_ujian");
                            while ($data = mysqli_fetch_array($queryUjian)) {
                            ?>
                            <tr>
                                <td><?= $data['no_ujian'] ?></td>
                                <td><?= $data['nis'] ?></td>
                                <td><?= $data['jurusan'] ?></td>
                                <td align="center"><?= $data['total_nilai'] ?></td>
                                <td align="center"><?= $data['nilai_terendah'] ?></td>
                                <td align="center"><?= $data['nilai_tertinggi'] ?></td>
                                <td align="center"><?= $data['nilai_rata2'] ?></td>
                                <td>
                                    <?php if ($data['hasil_ujian'] == "LULUS") { ?>
                                    <button type="button"
                                        class="btn btn-success btn-sm rounded-0 col-10 fw-bold text-uppercase"><?= $data['hasil_ujian'] ?></button>
                                    <?php } else { ?>
                                    <button type="button"
                                        class="btn btn-danger btn-sm rounded-0 col-10 fw-bold text-uppercase"><?= $data['hasil_ujian'] ?></button>
                                    <?php } ?>
                                </td>
                            </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal" tabindex="-1" id="mdlCetak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label class="form-label">Pilih No Peserta Ujian</label>
                    <select name="no" id="no" class="form-select">
                        <option value="">-- No Ujian --</option>
                        <?php
                        $dataUjian = mysqli_query($koneksi, "SELECT * FROM tbl_ujian");
                        while ($data = mysqli_fetch_array($dataUjian)) { ?>
                        <option value="<?= $data['no_ujian'] ?>">
                            <?= $data['no_ujian'] . ' - ' . $data['nis'] . ' - ' . $data['jurusan'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="previewPDF()">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function printDoc() {
        const myWindow = window.open("../report/r-ujian.php", "", "width=900, height=600, left=100")
    }

    let noUjian = document.getElementById('no')

    function previewPDF() {
        if (noUjian.value != '') {
            const myWindow = window.open("../report/r-nilai-ujian.php?noUjian" + noUjian.value);
        }

    }
    </script>

    <?php

    require_once "../template/footer.php";

    ?>