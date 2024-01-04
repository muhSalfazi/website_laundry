<!-- index -->
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>

    <title>De'UnguLaundry</title>
    <meta content='' name='description'>
    <meta content='' name='keywords'>

    <!-- Favicons -->
    <link href="assets/img/logo-icon.png" rel="icon">

    <!-- Google Fonts -->
    <link href='https://fonts.gstatic.com' rel='preconnect'>
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i'
        rel='stylesheet'>

    <!-- Vendor CSS Files -->
    <link href='assets/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
    <link href='assets/vendor/bootstrap-icons/bootstrap-icons.css' rel='stylesheet'>
    <link href='assets/vendor/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <link href='assets/vendor/quill/quill.snow.css' rel='stylesheet'>
    <link href='assets/vendor/quill/quill.bubble.css' rel='stylesheet'>
    <link href='assets/vendor/remixicon/remixicon.css' rel='stylesheet'>
    <link href='assets/vendor/simple-datatables/style.css' rel='stylesheet'>

    <!-- Template Main CSS File -->
    <link href='assets/css/style.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  =
* Template Name: NiceAdmin
* Updated: Sep 18 2023 with Bootstrap v5.3.2
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  == -->
</head>
<style>
/* Loading Overlay */
.loading-overlay {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.3s ease-in-out;
    color: darkorchid;
    font-family: "Roboto", sans-serif;
}

.loading-overlay.hidden {
    opacity: 0;
    pointer-events: none;
}

.loading-spinner {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin-bottom: 20px;
}

.loading-text {
    font-size: 18px;
    font-weight: bold;
    font-family: "Pacifico", cursive;
    /* Ganti 'Pacifico' dengan font yang diinginkan */
}


/* Tambahkan animasi untuk elemen dengan class "animated" */
@keyframes slideInUp {
    from {
        transform: translateY(100%);
    }

    to {
        transform: translateY(0);
    }
}

.animated {
    animation: slideInUp 1s ease-in-out;
}
</style>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="loading-overlay" id="loading-overlay">
            <div class="loading-spinner"></div>
            <div class="loading-text">~ De'Ungu Laundry ~</div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <a class="logo d-flex align-items-center">
                <img src="assets/img/logo.jpg" alt="" rel="icon" class="rounded-circle">
                <span class="d-none d-lg-block" style='color:darkslateblue;
'>De'ungu laundry</span>
            </a>
            <i class='bi bi-list toggle-sidebar-btn'></i>
        </div><!-- End Logo -->

        <nav class='header-nav ms-auto'>
            <ul class='d-flex align-items-center'>
                <li class='nav-item dropdown pe-3'>
                    |
                </li>

                <li class='nav-item dropdown pe-3'>

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <a href="./login.php" class="dropdown-item d-flex align-items-center">
                            <button type="button" class="btn btn-primary btn-sm">
                                <span>Login</span>
                            </button>
                        </a>
                    </a>


                </li>




                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    <aside id='sidebar' class='sidebar'>
        <ul class='sidebar-nav' id='sidebar-nav'>

            <!-- End Dashboard Nav -->



            <li class='nav-item'>
                <a class='nav-link' href='./'>
                    <i class='bi bi-grid'></i>
                    <span>Dashboard</span>
                </a>
            </li>


            <!-- End Profile Page Nav -->

        </ul>
    </aside>
    <main id='main' class='main' class='main animated'>

        <div class='pagetitle' data-aos="fade-up">
            <h1>Dashboard</h1>
            <nav>
                <ol class='breadcrumb'>
                    <li class='breadcrumb-item'><a href='dashboard.php'>Home</a></li>
                    <li class='breadcrumb-item active'>Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section contact" data-aos="fade-up">
            <div class="col-lg-12">
                <div class="card p-4">
                    <form action="forms/contact.php" method="post" class="php-email-form">
                        <div class="row gy-4">


                            <div class="card-body">
                                <h5 class="card-title"></h5>

                                <!-- Slides with indicators -->
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="assets/img/daftar_harga.jpg" class="d-block w-100" alt="foto1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/foto4.jpg" class="d-block w-100" alt="foto2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/logo.jpg" class="d-block w-100" alt="foto3">
                                        </div>
                                    </div>

                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>

                                </div><!-- End Slides with indicators -->

                            </div>

                        </div>
                    </form>
                </div>

            </div>
            <div class="col-xl-12">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box card">
                            <i class="bi bi-check2-all"></i>
                            <h3>Harga Terjangkau</h3>
                            <p class="card-text">Kami mengakui bahwa kebersihan pakaian dan karpet adalah kebutuhan
                                penting.
                                Menawarkan harga yang bersaing dan terjangkau untuk semua layanan kami.
                                <strong>Komitmen kami adalah membuat layanan laundry menjadi terjangkau tanpa
                                    mengorbankan
                                    kualitas.</strong>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="info-box card">
                            <i class="bi bi-tools"></i>
                            <h3>Jasa Penuh</h3>
                            <p class="card-text">Menyediakan layanan penuh mulai dari laundry kiloan hingga perawatan
                                khusus karpet.
                                Perhatian khusus untuk memastikan setiap item kembali bersih dan segar.
                                Memberikan solusi lengkap untuk semua kebutuhan pembersihan Anda.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="info-box card">
                            <i class="bi bi-geo-alt-fill"></i>
                            <h3>Location</h3>
                            <div class="table-responsive">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3965.2099833755533!2d107.38805237499157!3d-6.366865493623255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMjInMDAuNyJTIDEwN8KwMjMnMjYuMyJF!5e0!3m2!1sid!2sid!4v1703974936514!5m2!1sid!2sid"
                                    width="1190" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>


                </div>

            </div>




        </section>

    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer" class='main animated'>
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


    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>










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
                }, 200);
            }, 300); // Sesuaikan penundaan ini (dalam milidetik) sesuai kebutuhan
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
    <script src="assets/js/main.js"></script>

    <!-- Tambahkan fungsi JavaScript untuk delete -->


</body>



</html>