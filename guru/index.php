<?php
session_start();

if (!isset($_SESSION["ssLogin"]) || $_SESSION["ssLevel"] !== 'guru') {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";
$title = "Beranda Guru - Qurrotul A'yun";
require_once "../template/header.php";
require_once "../template/sidebar-guru.php"; // sidebar khusus guru
require_once "../template/navbar.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Selamat Datang, Guru!</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard Guru</li>
            </ol>

            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Data Siswa</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="../data/siswa.php">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Mata Pelajaran</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="../data/mata-pelajaran.php">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Nilai Ujian</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="../ujian/nilai-ujian.php">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<?php
require_once "../template/footer.php";
?>
