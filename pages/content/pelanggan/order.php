<?php
session_start();

if ( $_SESSION[ 'role' ] != 'pelanggan' ) {
    header( 'Location:../../../index.php' );
    exit( session_destroy() );
}
?><?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath( dirname( __FILE__ )  . $ds . '../../../' ) . $ds;
require_once( "{$base_dir}pages{$ds}core{$ds}header.php" );
require_once( "{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php" );

?>

<main id='main' class='main'>

    <div class='pagetitle'>
        <h1>Order</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class='breadcrumb-item'><a href='../../content/User/Pengguna'>Data Pengguna</a></li>
                <li class=' breadcrumb-item active'>Order </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Form Pesanan</h5>

                        <!-- Custom Styled Validation -->
                        <form action='./proses-add' method='post' enctype='multipart/form-data'
                            class='row g-3 needs-validation' novalidate>
                            <div class='col-md-3'>
                                <label for='validationCustom04' class='form-label'>Role</label>
                                <select class='form-select' name='role' required>
                                    <option selected disabled>pilih...</option>
                                    <option value='PerKILO'>Kiloan</option>
                                    <option value='Satuan'>satuan</option>
                                </select>
                                <div class='invalid-feedback'>
                                    Silakan pilih jenis laundry bagian yang valid.
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <label for='validationCustom02' class='form-label'>Jenis Laundry </label>
                                <input type='text' class='form-control' name='nama_lengkap' placeholder='silahkan isi'
                                    required>
                                <div class='invalid-feedback'>
                                    Harap berikan nama Lengkap yang valid.
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <label for='validationCustom05' class='form-label'>Password</label>
                                <input type='password' class='form-control' name='password' required>
                                <div class='invalid-feedback'>
                                    Harap berikan password yang valid.
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <label for='validationCustom03' class='form-label'>Alamat</label>
                                <input type='text' class='form-control' name='alamat' required>
                                <div class='invalid-feedback'>
                                    Harap berikan alamat yang valid.
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <label for='validationCustom03' class='form-label'>No Handphone</label>
                                <input type='text' class='form-control' name='no_telp' required>
                                <div class='invalid-feedback'>
                                    Harap berikan No Handphone yang valid.
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <label for='validationCustom04' class='form-label'>Role</label>
                                <select class='form-select' name='role' required>
                                    <option selected disabled>pilih...</option>
                                    <option value='admin'>admin</option>
                                    <option value='pelanggan'>pelanggan</option>
                                </select>
                                <div class='invalid-feedback'>
                                    Silakan pilih role bagian yang valid.
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