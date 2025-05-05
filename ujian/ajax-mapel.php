<?php

require_once "../config.php";

// Tambahan: Cek jika 'jurusan' kosong, tampilkan pesan default
if (!isset($_GET['jurusan']) || $_GET['jurusan'] == '') {
    echo "<tr><td colspan='4' class='text-center text-danger'>Silakan pilih jurusan terlebih dahulu.</td></tr>";
    exit;
}

$jurusan = $_GET['jurusan'];

$no = 1;
$queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE jurusan = 'IPA' OR jurusan='$jurusan'");
while ($data = mysqli_fetch_array($queryPelajaran)) { ?>
    <tr>
        <td align="center"><?= $no++ ?></td>
        <td><input type="text" name="mapel[]" value="<?= $data['pelajaran'] ?>" class="border-0 bg-transparent col-12" readonly></td>
        <td><input type="text" name="jurus[]" value="<?= $data['jurusan'] ?>" class="border-0 bg-transparent col-12" readonly></td>
        <td><input type="number" name="nilai[]" value="0" min="0" max="100" step="5" class="form-control nilai text-center" onchange="fnhitung()"></td>
    </tr>
<?php
}
?>