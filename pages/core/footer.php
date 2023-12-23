<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>mhs.UBP.Karawang</span>/De'unguLaundry</strong>. Seluruh hak cipta
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../../../assets/vendor/echarts/echarts.min.js"></script>
<script src="../../../assets/vendor/quill/quill.min.js"></script>
<script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../../assets/vendor/php-email-form/validate.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



<!-- Tambahkan fungsi JavaScript di bagian head -->
<script>
function deleteConfirmation(id, type) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data ini akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke delete.php dengan menyertakan parameter ID dan type
            window.location.href = `../../content/backend/delete.php?id_${type}=${id}`;
        }
    });
};
</script>

<script>
document.getElementById("logoutButton").addEventListener("click", function() {
    var konfirmasi = confirm('Apakah Anda yakin ingin keluar dari sistem?');
    if (konfirmasi) {
        window.location.href = '../../content/backend/logout.php';
    } else {
        // Tidak lakukan apa-apa jika pengguna membatalkan logout
    }
});
</script>



<script>
function deletepesanan(id, type) {
    Swal.fire({
        title: 'Apakah Anda yakin?',

        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, TOLAK!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke delete.php dengan menyertakan parameter ID dan type
            window.location.href = `../../content/backend/delete.php?id_${type}=${id}`;
        }
    });
};
</script>




<!-- Template Main JS File -->
<script src="../../../assets/js/main.js"></script>

<!-- Tambahkan fungsi JavaScript untuk delete -->


</body>



</html>