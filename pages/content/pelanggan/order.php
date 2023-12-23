<?php
session_start();

if ($_SESSION['role'] != 'pelanggan') {
    header('Location:../../../');
    exit(session_destroy());
}

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");
require_once("{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php");

require '../../core/connection.php';
?>

<main id='main' class='main'>

    <div class='pagetitle'>
        <h1>Order</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>

                <li class=' breadcrumb-item active'>Order Pesanan </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>pilih jenis
                            layanan</h5>

                        <!-- Custom Styled Validation -->
                        <div class='col-12 mt-3'>
                            <a href='add_cuci+setrika' type='submit' name='submit' class='btn btn-primary w-100'>CUCI +
                                SETRIKA</a>

                        </div>
                        <div class='col-12 mt-3'>
                            <a href='setrika' type='submit' name='submit' class='btn btn-primary w-100'>SETRIKA</a>

                        </div>
                        <div class='col-12 mt-3'>
                            <a href='karpet' type='submit' name='submit' class='btn btn-primary w-100' data-bs-toggle='modal' data-bs-target='#smallModal2'>KARPET</a>

                        </div>
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
<!-- cuci+strika -->
<div class='modal fade' id='smallModal' tabindex='-1'>
    <div class='modal-dialog modal-sm'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>Cuci + Setrika</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>

                <form action='../backend/order.php' method='POST' enctype='multipart/form-data'>
                    <div class='mb-3'>
                        <label for='validationCustom02' class='form-label'>Nama Pelanggan</label>
                        <input type='text' class='form-control' name='nama_pelanggan' required>

                    </div>
                    <div class='mb-3'>
                        <label for='validationCustom04' class='form-label'>Kategori</label>
                        <select class='form-select' name='jenis_laundry' required>
                            <option selected disabled>pilih...</option>
                            <option value='kiloan'>PERKILO</option>
                            <option value='Satuan'>SATUAN</option>
                        </select>
                        <div class='invalid-feedback'>
                            Silakan pilih role bagian yang valid.
                        </div>
                    </div>
                    <div class='mb-3'>
                        <label for='validationCustom02' class='form-label'>Nama Produk</label>
                        <input type='text' class='form-control' name='nama_produk' placeholder=' silahkan isi' required>
                        <div class='invalid-feedback'>
                            Harap berikan Email yang valid.
                        </div>
                    </div>

                    <div class='modal-footer'>
                        <a class='btn btn-secondary' data-bs-dismiss='modal'>Close</a>
                        <button type='submit' name='submit' class='btn btn-primary'>Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Large Modal-->

<!-- setrika -->
<div class='modal fade' id='smallModal2' tabindex='-1'>
    <div class='modal-dialog modal-sm'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>Setrika</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                <form action='../backend/edit_stok_barang.php' method='POST' enctype='multipart/form-data'>
                    <div class='mb-3'>
                        <label for='validationCustom02' class='form-label'>Nama Pelanggan</label>
                        <input type='text' class='form-control' name='nama_produk' value="<?php echo $nama_lengkap;
                                                                                            ?>" required readonly>

                    </div>
                    <div class='mb-3'>
                        <label for='validationCustom04' class='form-label'>Kategori</label>
                        <select class='form-select' name='nama_jenis_laundry' required>
                            <option selected disabled>pilih...</option>
                            <option value='PerKILO'>PERKILO</option>
                            <option value='Satuan'>SATUAN</option>
                        </select>
                        <div class='invalid-feedback'>
                            Silakan pilih role bagian yang valid.
                        </div>
                    </div>
                    <div class='mb-3'>
                        <label for='validationCustom02' class='form-label'>Nama Produk</label>
                        <input type='text' class='form-control' name='nama_produk' placeholder=' silahkan isi' required>
                        <div class='invalid-feedback'>
                            Harap berikan Email yang valid.
                        </div>
                    </div>

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='button' class='btn btn-primary'>Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Large Modal-->

<!-- setrika -->
<div class='modal fade' id='smallModal3' tabindex='-1'>
    <div class='modal-dialog modal-sm'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>Karpet</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                <form action='../backend/edit_stok_barang.php' method='POST' enctype='multipart/form-data'>
                    <div class='mb-3'>
                        <label for='validationCustom02' class='form-label'>Nama Pelanggan</label>
                        <input type='text' class='form-control' name='nama_produk' value="<?php echo $nama_lengkap;
                                                                                            ?>" required readonly>

                    </div>
                    <div class='mb-3'>

                        <label for='validationCustom04' class='form-label'>Kategori</label>
                        <select class='form-select' name='nama_jenis_laundry' required>
                            <option selected disabled>pilih...</option>
                            <option value='Satuan'>SATUAN</option>
                        </select>
                        <div class='invalid-feedback'>
                            Silakan pilih role bagian yang valid.
                        </div>
                    </div>
                    <div class='mb-3'>
                        <label for='validationCustom02' class='form-label'>Nama Produk</label>
                        <input type='text' class='form-control' name='nama_produk' placeholder=' silahkan isi' required>
                        <div class='invalid-feedback'>
                            Harap berikan Email yang valid.
                        </div>
                    </div>

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='button' class='btn btn-primary'>Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Large Modal-->