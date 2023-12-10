<?php
session_start();

if ( $_SESSION[ 'role' ] != 'admin' ) {
    header( 'Location:../../../index.php' );
    exit( session_destroy() );
}

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath( dirname( __FILE__ )  . $ds . '../../../../' ) . $ds;
require_once( "{$base_dir}pages{$ds}core{$ds}header.php" );
require_once( "{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php" );

?>

<main id='main' class='main'>

    <div class='pagetitle'>
        <h1>Jenis Laundry</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class='breadcrumb-item'><a href='../../content/User/stok_investaris.php'>Stok Inventaris</a></li>
                <li class='breadcrumb-item'><a href='../../content/User/jenis_laundry'>Jenis Laundry</a></li>
                <li class=' breadcrumb-item active'>Add Jenis Laundry </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Tambah Jenis Laundry</h5>

                        <!-- Custom Styled Validation -->
                        <form action='../backend/add_jenis-proses.php' method='post' enctype='multipart/form-data'
                            class='row g-3 needs-validation' novalidate>
                            <div class='col-md-4'>
                                <label for='validationCustom04' class='form-label'>Jenis Laundry</label>
                                <select class='form-select' name='nama_jenis_laundry' required>
                                    <option selected disabled>pilih...</option>
                                    <option value='PerKILO'>PERKILO</option>
                                    <option value='Satuan'>SATUAN</option>
                                </select>
                                <div class='invalid-feedback'>
                                    Silakan pilih role bagian yang valid.
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <label for='validationCustom02' class='form-label'>Nama Produk</label>
                                <input type='text' class='form-control' name='nama_produk' placeholder=' silahkan isi'
                                    required>
                                <div class='invalid-feedback'>
                                    Harap berikan Email yang valid.
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <label for='validationCustom02' class='form-label'>Harga</label>
                                <input type='number' class='form-control' name='harga_perkilo'
                                    placeholder='silahkan isi' required>

                                <div class='invalid-feedback'>
                                    Harap berikan Email yang valid.
                                </div>
                            </div>
                            <div class='col-12'>
                                <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' value='' id='invalidCheck' required>
                                    <label class='form-check-label' for='invalidCheck'>
                                        Setuju dengan syarat dan ketentuan
                                    </label>
                                    <div class='invalid-feedback'>
                                        Anda harus menyetujuinya sebelum mengirimkan.
                                    </div>
                                </div>
                            </div>

                            <div class='col-12'>
                                <button class='btn btn-primary' name='submit' type='submit'>Submit
                                    form</button>
                            </div>
                        </form><!-- End Custom Styled Validation -->

                    </div>
                </div>

            </div>
        </div>

        <!-- End Ngoding Disini -->

    </section>

</main><!-- End #main -->

<?php
require_once( "{$base_dir}pages{$ds}core{$ds}footer.php" );
?>