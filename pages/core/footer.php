<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>mhs.UBP.Karawang</span>/De'unguLaundry</strong>.
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        <i class="bi bi-whatsapp"><span><a href="https://wa.me/+6281284733340"
                    target="_blank">De'unguLaundry</a></span></i>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<!-- <script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script> -->
<script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../../../assets/vendor/echarts/echarts.min.js"></script>
<script src="../../../assets/vendor/quill/quill.min.js"></script>
<script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- bsweetalert -->
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






<!-- spinners -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const loadingOverlay = document.getElementById('loading-overlay');

    // Sembunyikan overlay loading setelah halaman sepenuhnya dimuat
    window.addEventListener('load', () => {
        // Secara opsional, tambahkan penundaan sebelum menyembunyikan overlay
        setTimeout(() => {
            loadingOverlay.classList.add('hidden');

            // Secara opsional, tambahkan penundaan sebelum mengatur display menjadi 'none'
            setTimeout(() => {
                loadingOverlay.style.display = 'none';
            }, 500);
        }, 400); // Sesuaikan penundaan ini (dalam milidetik) sesuai kebutuhan
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('main').classList.add('animated');
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
    integrity="sha512-pAAahXk1u5rwO30vqMvsPHUd2U94v0tE6n2t+RbeX7TlXsFP8h0XMToUO4CQ1+uDNkrA/+g6slCSx8EiDohS9A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
AOS.init();
</script>

<!-- Template Main JS File -->
<script src="../../../assets/js/main.js"></script>

<!-- Tambahkan fungsi JavaScript untuk delete -->


</body>



</html>