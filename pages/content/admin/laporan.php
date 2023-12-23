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
    include("{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php");

    ?>

<main id='main' class='main'>


    <div class='pagetitle'>
        <h1>Laporan</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class=' breadcrumb-item active'>Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>

        <!-- End Ngoding Disini -->

        </div>
    </section>

</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>