<?php
session_start();

if ( $_SESSION[ 'role' ] != 'admin' ) {

    header( 'Location:../../../index.php' );
    exit( session_destroy() );
}
?><?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath( dirname( __FILE__ ) . $ds . '../../../' ) . $ds;
require_once( "{$base_dir}pages{$ds}core{$ds}header.php" );
require_once( "{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php" );

?>

<main id='main' class='main'>
    <?php

function showAlert( $icon, $title, $message, $redirect = null ) {
    echo "
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: '$icon',
                    title: '$title',
                    html: '<p class=\"p-popup\">$message</p>',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    " . ( $redirect ? "window.location.href = '$redirect';" : '' ) . "
                });
            });
        </script>
        ";
}
?>
    <!--create-->

    <?php

// mengecek di tambahkan
if ( isset( $_GET[ 'berhasil' ] ) ) {
    $berhasil = $_GET[ 'berhasil' ];
    if ( $berhasil === 'update_berhasil' ) {
        showAlert( 'success', 'Berhasil', 'Pengguna berhasil di tambahkan.' );
    }
}

?>

    <div class='pagetitle'>
        <h1>Stok Investaris</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard.php'>Home</a></li>
                <li class=' breadcrumb-item active'>Stok Investaris</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->
            <div class='row'>
                <div class='col-lg-12 '>
                    <div class='card'>
                        <div class='card-body mb-5'>
                            <h5 class='card-title'>Stok Inventaris</h5>
                            <p>pilih jenis menu stok Inventaris <b>De'Ungu Laundry</b>.</p>
                            <div class='row '>
                                <div class='col-md-6 mt-4'>
                                    <a href='./jenis_laundry' class='btn btn-primary col-12 md-3' data-toggle='modal'>
                                        <i fill='currentColor' class="bi bi-bookmark">
                                        </i>
                                        jenis Laundry
                                    </a>
                                </div>
                                <div class='col-md-6 mt-4'>
                                    <!--stokbarang-->
                                    <a href='./stok_barang' class='btn btn-primary col-12 md-6' data-toggle='modal'>
                                        <i class='bi bi-minecart' fill='currentColor'>
                                        </i>
                                        stok barang
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
require_once( "{$base_dir}pages{$ds}core{$ds}footer.php" );
?>