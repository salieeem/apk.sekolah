<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("Location:../auth/login.php");
    exit;
}

require_once "../config.php";
$title = "Nilai Ujian - Qurrotul A'yun";
require_once "../template/header.php";
require_once "../template/sidebar.php";
require_once "../template/navbar.php";

if (isset($_GET['msg']) && isset($_GET['nis'])) {
    $msg = $_GET['msg'];
    $nis = $_GET['nis'];
} else {
    $msg = "";
    $nis = "";
}

$alert = '';
if ($msg == 'LULUS') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> SELAMAT.. siswa dengan NIS : ' . $nis . ' dinyatakan LULUS..   
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if ($msg == 'GAGAL') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-xmark"></i> Siswa dengan NIS : ' . $nis . ' GAGAL ujian..   
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

$queryNoUjian = mysqli_query($koneksi, "SELECT max(no_ujian) as maxno FROM tbl_ujian");
$data = mysqli_fetch_array($queryNoUjian);
$maxno = $data['maxno'];

$noUrut = (int) substr($maxno, 4, 3);
$noUrut++;
$maxno = "UTS-" . sprintf("%03s", $noUrut);
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-7">
                    <h1 class="mt-4">Nilai Ujian</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="ujian.php">Ujian</a></li>
                        <li class="breadcrumb-item active">Nilai Ujian</li>
                    </ol>
                </div>
                <div class="col-5">
                    <div class="card mt-3 border-0">
                        <h5>Syarat Kelulusan</h5>
                        <ul class="ps-3">
                            <li><small>Nilai minimal tiap mata pelajaran tidak boleh dibawah 50</small></li>
                            <li><small>Nilai rata-rata mata pelajaran tidak boleh dibawah 60</small></li>
                        </ul>
                    </div>
                </div>
                <?php if ($msg != "") {
                    echo $alert;
                } ?>
                <form action="proses-ujian.php" method="POST">
                    <div class="row">
                        <!-- Kolom Kiri: Data Peserta Ujian + Statistik -->
                        <div class="col-md-6">
                            <!-- Data Peserta -->
                            <div class="card mb-2">
                                <div class="card-header">
                                    <i class="fa-solid fa-plus"></i> Data Peserta Ujian
                                </div>
                                <div class="card-body">
                                    <!-- No Ujian -->
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fa-solid fa-rotate fa-sm"></i></span>
                                        <input type="text" name="noUjian" value="<?= $maxno ?>" class="form-control bg-transparent" readonly>
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                                        <input type="date" name="tgl" class="form-control" required>
                                    </div>
                                    <!-- Pilih Siswa -->
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span>
                                        <select name="nis" id="nis" class="form-select" required>
                                            <option value="">-- Pilih Siswa --</option>
                                            <?php
                                            $querySiswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa");
                                            while ($data = mysqli_fetch_array($querySiswa)) {
                                                echo "<option value='{$data['nis']}'>{$data['nis']} - {$data['nama']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Jurusan -->
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fa-solid fa-location-arrow fa-sm"></i></span>
                                        <select name="jurusan" id="jurusan" class="form-select" required>
                                            <option value="">-- Jurusan --</option>
                                            <option value="IPA">IPA</option>
                                            <option value="IPS">IPS</option>
                                            <option value="IPS">Bahasa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistik Nilai -->
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text col-4 fw-bold">Total Nilai</span>
                                        <input type="text" name="sum" class="form-control bg-light" id="total_nilai" placeholder="Total Nilai" readonly required>
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text col-4 fw-bold">Nilai Terendah</span>
                                        <input type="text" name="min" class="form-control bg-light" id="nilai_terendah" placeholder="Terendah" readonly required>
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text col-4 fw-bold">Nilai Tertinggi</span>
                                        <input type="text" name="max" class="form-control bg-light" id="nilai_tertinggi" placeholder="Tertinggi" readonly required>
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text col-4 fw-bold">Nilai Rata-rata</span>
                                        <input type="text" name="avg" class="form-control bg-light" id="rata2" placeholder="Rata-rata" readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Syarat + Tabel Input -->
                        <div class="col-md-6">
                            <!-- Input Nilai -->
                            <div class="card mb-2">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span><i class="fa-solid fa-list"></i> Input Nilai Ujian</span>
                                    <div>
                                        <button type="reset" name="reset" class="btn btn-sm btn-danger me-1"><i class="fa-solid fa-xmark"></i> Reset</button>
                                        <button type="submit" name="simpan" class="btn btn-sm btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>No</center>
                                                </th>
                                                <th>
                                                    <center>Mata Pelajaran</center>
                                                </th>
                                                <th>
                                                    <center>Jurusan</center>
                                                </th>
                                                <th>
                                                    <center>Nilai Ujian</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="kejuruan">
                                            <tr>
                                                <td colspan="4" class="text-center">Data mata pelajaran akan muncul setelah memilih jurusan.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
    </main>
</div>

<script>
    const jurusan = document.getElementById('jurusan');
    const mapelKejuruan = document.getElementById('kejuruan');

    jurusan.addEventListener('change', function() {
        if (!jurusan.value) {
            mapelKejuruan.innerHTML = "<tr><td colspan='4' class='text-center text-muted'>Silakan pilih jurusan</td></tr>";
            return;
        }

        let ajax = new XMLHttpRequest();

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                mapelKejuruan.innerHTML = ajax.responseText;
            }
        }

        ajax.open('GET', 'ajax-mapel.php?jurusan=' + jurusan.value, true);
        ajax.send();
    });


    const total = document.getElementById('total_nilai');
    const minValue = document.getElementById('nilai_terendah');
    const maxValue = document.getElementById('nilai_tertinggi');
    const average = document.getElementById('rata2');

    function fnhitung() {
        let nilaiUjian = document.getElementsByClassName('nilai');

        let totalNilai = 0;
        let listNilai = [];

        for (let i = 0; i < nilaiUjian.length; i++) {
            let nilai = parseInt(nilaiUjian[i].value) || 0;
            totalNilai += nilai;
            listNilai.push(nilai);
        }

        listNilai.sort(function(a, b) {
            return a - b;
        });

        // pastikan elemen-elemen ini ada di HTML
        total.value = totalNilai;
        minValue.value = listNilai[0] || 0;
        maxValue.value = listNilai[listNilai.length - 1] || 0;
        average.value = listNilai.length ? Math.round(totalNilai / listNilai.length) : 0;
    }
</script>

<?php

require_once "../template/footer.php";

?>