<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Home</div>
                <a class="nav-link" href="../guru/index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Data</div>
                <a class="nav-link" href="../data/siswa.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Data Siswa
                </a>
                <a class="nav-link" href="../data/mata-pelajaran.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                    Mata Pelajaran
                </a>
                <a class="nav-link" href="../ujian/nilai-ujian.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard"></i></div>
                    Nilai Ujian
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= $_SESSION['ssUser'] ?>
        </div>
    </nav>
</div>