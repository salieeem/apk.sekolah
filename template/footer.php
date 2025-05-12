    <footer class="py-4 bg-light mt-auto border">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Qurrota A'yun 2025</div>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="<?= $main_url ?>asset/sb-admin/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?= $main_url ?>asset/sb-admin/assets/demo/chart-area-demo.js"></script>
    <script src="<?= $main_url ?>asset/sb-admin/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="<?= $main_url ?>asset/sb-admin/js/datatables-simple-demo.js"></script>

    <script>
$(document).ready(function() {
    $('#datatablesSimple').DataTable();
});
    </script>

    <script>
window.addEventListener('DOMContentLoaded', event => {
    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});
    </script>

    <script>
document.getElementById("toggleSidebar").addEventListener("click", function() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("d-none"); // Bootstrap: hide/show
});
    </script>


    </body>

    </html>