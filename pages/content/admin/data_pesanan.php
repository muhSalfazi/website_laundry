<?php
session_start();

if ($_SESSION['role'] != 'admin') {

    header('Location:../../../');
    exit(session_destroy());
}
?><?php
    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
    require_once("{$base_dir}pages{$ds}core{$ds}header.php");
    require_once("{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php");

    ?>

<main id='main' class='main'>
    <div class='pagetitle'>
        <h1>Data Pesanan</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard-admin'>Home</a></li>
                <li class=' breadcrumb-item active'>Data Pesanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='card'>
                        <div class='card-body mb-5'>
                            <h5 class='card-title'>Data Pesanan</h5>
                            <p>pilih jenis menu Data pesanan <b>De'Ungu Laundry</b>.</p>
                            <div class='row '>
                                <div class='col-md-6 mt-4'>
                                    <a href='./data_satuan-order' class='btn btn-primary col-12 md-3'
                                        data-toggle='modal'>
                                        <i fill='currentColor'>
                                        </i>
                                        SATUAN
                                    </a>
                                </div>
                                <div class='col-md-6 mt-4'>
                                    <!--stokbarang-->
                                    <a href='./data_kiloan-order' class='btn btn-primary col-12 md-6'
                                        data-toggle='modal'>
                                        <i fill='currentColor'>
                                        </i>
                                        KILOAN
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Ngoding Disini -->

        </div>
    </section>

</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>