<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= $main_url ?>guru/index.php">Qurrotul A'yun</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <span class="text-white text capitalize"><?= $_SESSION["ssUser"] ?></span>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" data-bs-toggle="modal" href="#mdlProfileUser">Profile User</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?= $main_url ?>auth/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <?php
    $username = $_SESSION["ssUser"];
    $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    $profile = mysqli_fetch_array($queryUser);
    ?>
    <div class="modal" tabindex="-1" id="mdlProfileUser">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Profile User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">
                    <div class="card mx-auto" style="max-width: 600px;">
                        <div class="card-body d-flex flex-wrap justify-content-center">
                            <div class="me-4 mb-3">
                                <img src="<?= $main_url ?>asset/image/<?= $profile['foto'] ?>" alt="Foto User" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            <div class="text-start" style="min-width: 300px;">
                                <h5 class="mb-3">User</h5>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold">Nama</div>
                                    <div class="col-1">:</div>
                                    <div class="col-7"><?= $profile['nama'] ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold">Jabatan</div>
                                    <div class="col-1">:</div>
                                    <div class="col-7"><?= $profile['jabatan'] ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold">Alamat</div>
                                    <div class="col-1">:</div>
                                    <div class="col-7"><?= $profile['alamat'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>