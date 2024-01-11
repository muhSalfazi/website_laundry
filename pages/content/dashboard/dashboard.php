<?php
session_start();

if ($_SESSION['role'] != 'pelanggan') {
    header('Location: ../../../login');
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>

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
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../../../assets/img/daftar_harga.jpg" class="d-block w-100" alt="foto1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../../../assets/img/foto4.jpg" class="d-block w-100" alt="foto2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../../../assets/img/logo.jpg" class="d-block w-100" alt="foto3">
                                    </div>
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
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
                        <p>Kami mengakui bahwa kebersihan pakaian dan karpet adalah kebutuhan penting.
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
                        <p>Menyediakan layanan penuh mulai dari laundry kiloan hingga perawatan khusus karpet.
                            Perhatian khusus untuk memastikan setiap item kembali bersih dan segar.
                            Memberikan solusi lengkap untuk semua kebutuhan pembersihan Anda.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="info-box card">
                        <i class="bi bi-geo-alt-fill"></i>
                        <h3>Location</h3>
                        <div class="table-responsive">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3965.2099833755533!2d107.38805237499157!3d-6.366865493623255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMjInMDAuNyJTIDEwN8KwMjMnMjYuMyJF!5e0!3m2!1sid!2sid!4v1703974936514!5m2!1sid!2sid" width="1190" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>


            </div>

        </div>




    </section>

</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
