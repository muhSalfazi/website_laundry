<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location:../../../');
    exit(session_destroy());
}
?><?php
    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
    require_once("{$base_dir}pages{$ds}core{$ds}header.php");
    require_once("{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php");

    ?>

<main id='main' class='main'>

    <div class='pagetitle'>
        <h1>Stok Barang</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class='breadcrumb-item'><a href='../../content/admin/stok_investaris.php'>Stok Inventaris</a></li>
                <li class='breadcrumb-item'><a href='../../content/admin/stok_barang'>Stok Barang</a></li>
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
                        <h5 class='card-title'>Tambah Stok Barang</h5>

                        <!-- Custom Styled Validation -->
                        <form action='../backend/add-barang-proses.php' method='post' enctype='multipart/form-data' class='row g-3 needs-validation' novalidate>
                            <div class='col-md-6'>
                                <label for='validationCustom02' class='form-label'>Nama Barang</label>
                                <input type='text' class='form-control' name='nama_barang' placeholder=' silahkan isi' required>
                                <div class='invalid-feedback'>
                                    Harap berikan nama Lengkap yang valid.
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <label for='validationCustom02' class='form-label'>Total Barang</label>
                                <input type='number' class='form-control' name='total_barang' placeholder=' silahkan isi' required>
                                <div class='invalid-feedback'>
                                    Harap berikan Email yang valid.
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <label for='image' class='col-sm-2 col-form-label'>Gambar Produk</label>
                                <div class='col-sm-10'>
                                    <input class='form-control' type='file' name='image'>
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
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>