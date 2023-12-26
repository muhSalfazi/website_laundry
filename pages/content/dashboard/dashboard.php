<?php
session_start();

if ($_SESSION['role'] != 'pelanggan') {
    header('Location: ../../../');
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>

<main id='main' class='main'>

    <div class='pagetitle'>
        <h1>Dashboard</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='dashboard.php'>Home</a></li>
                <li class='breadcrumb-item active'>Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section contact">
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
                                        <img src="../../../assets/img/foto4.jpg" class="d-block w-100" alt="foto1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../../../assets/img/foto2.jpg" class="d-block w-100" alt="foto2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../../../assets/img/foto5.jpg" class="d-block w-100" alt="foto3">
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
                        <p>Kami mengakui bahwa kebersihan pakaian dan karpet adalah kebutuhan penting.<br>
                            Menawarkan harga yang bersaing dan terjangkau untuk semua layanan kami.<br>

                            <strong>Komitmen kami adalah membuat layanan laundry menjadi terjangkau tanpa
                                mengorbankan
                                kualitas.</strong>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-star-fill"></i>
                        <h3>Kualitas Terbaik</h3>
                        <p>Prioritas kami adalah kebersihan dan kualitas pelayanan.
                            Menggunakan teknologi dan produk pembersih terkini untuk hasil optimal.<br>
                            Tim berpengalaman kami berkomitmen memberikan hasil terbaik untuk pakaian dan karpet
                            Anda.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-tools"></i>
                        <h3>Jasa Penuh</h3>
                        <p>Menyediakan layanan penuh mulai dari laundry kiloan hingga perawatan khusus karpet. <br>
                            Perhatian khusus untuk memastikan setiap item kembali bersih dan segar.<br>
                            Memberikan solusi lengkap untuk semua kebutuhan pembersihan Anda.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-headset"></i>
                        <h3>Pelayanan Penuh</h3>
                        <p>Tim pelayanan pelanggan yang siap membantu dengan pertanyaan atau permintaan Anda.
                            Memahami keunikan setiap pelanggan dan memberikan pengalaman pelayanan yang ramah dan
                            personal.<br>
                            Kami peduli terhadap kepuasan pelanggan dan berusaha untuk membuat setiap interaksi
                            menyenangkan.</p>
                    </div>
                </div>
            </div>

        </div>




    </section>

</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>