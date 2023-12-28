<?php
session_start();

if ($_SESSION['role'] != 'pelanggan') {
    header('Location: ../../../');
    exit();
}

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");
require_once("{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php");

// Periksa apakah pengguna telah login
if (isset($_SESSION['alamat']) && isset($_SESSION['nama_lengkap']) && isset($_SESSION['no_telp'])) {
    $alamat = $_SESSION['alamat'];
    $nama_lengkap = $_SESSION['nama_lengkap'];
    $no_telp = $_SESSION['no_telp'];
} else {
    // Handle the case where session variables are not set
    echo "Session variables are not set!";
}

// Tampilkan data di dalam HTML
?>


<main id='main' class='main'>

    <div class='pagetitle'>
        <h1>Cuci + Setrika</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class='breadcrumb-item'><a href='../../content/pelanggan/order'>order</a></li>
                <li class=' breadcrumb-item active'>Cuci+Setrika </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Order Cuci + Setrika</h5>
                        <a href='./add_jenis' class='btn btn-primary' data-bs-toggle="modal"
                            data-bs-target="#modalDialogScrollable">
                            <i xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                class='bi bi-bag-check-fill' viewBox='0 0 16 16'>
                                <path d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6' />
                                <path fill-rule='evenodd'
                                    d='M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5' />
                            </i>
                            Daftar Kategori Yang Tersedia
                        </a>
                        <!-- Custom Styled Validation -->
                        <form action='../backend/order' method='post' enctype='multipart/form-data'
                            class='row g-3 needs-validation' novalidate>

                            <div class='col-md-4'>
                                <label for='validationCustom02' class='form-label'>Nama Pelanggan</label>
                                <input type='text' class='form-control' name='nama_pelanggan' value="  <?php echo $nama_lengkap;
                                                                                                        ?>" required
                                    readonly>

                            </div>

                            <div class='col-md-4'>
                                <label for='validationCustom02' class='form-label'>No Handphone</label>
                                <input type='text' class='form-control' name='no_telp' value="<?php echo $no_telp; ?>"
                                    required readonly>
                            </div>

                            <div class=' col-md-4'>
                                <label for='validationCustom04' class='form-label'>Jenis Laundry</label>
                                <select class='form-select' id="jenis" name='jenis_laundry' required>
                                    <option selected disabled>pilih...</option>
                                    <option value='kiloan'>Kiloan</option>
                                    <option value='satuan'>SATUAN</option>
                                </select>
                                <div class='invalid-feedback'>
                                    Silakan pilih jenis bagian yang valid.
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <label for='validationCustom02' class='form-label'>kategori laundry</label>
                                <select class='form-select' name="nama_produk" id="nama_produk"></select>
                                <!-- <input type='text' class='form-control' name='nama_produk' placeholder=' silahkan isi'
                                    required> -->
                                <p style="color:red; font-size:smaller; ">isi jenis laundry terlebih dahulu!!</p>
                                <div class='invalid-feedback'>
                                    Harap berikan produk yang valid.
                                </div>
                            </div>
                            <div class=' col-md-4'>
                                <label for='validationCustom04' class='form-label'>layanan antar</label>
                                <select class='form-select' id="alamat_input" name='layanan_antar' required>
                                    <option selected disabled>pilih...</option>
                                    <option value='antar jemput'>Antar Jemput</option>
                                    <option value='tidak'>tidak</option>
                                </select>
                                <div class='invalid-feedback'>
                                    Silakan pilih jenis bagian yang valid.
                                </div>
                            </div>
                            <!-- alamat -->
                            <div class='col-md-4 ' id="alamat_antar_fields"></div>

                            <div class=' col-12'>
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
                                <button class='btn btn-primary' name='submit' type='submit'>Order</button>
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

<div class="modal fade" id="modalDialogScrollable" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Daftar Katergori Yang tersedia</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class=" table-responsive">
                    <!-- Table with stripped rows -->
                    <table class="table table-hover">
                        <thead>
                            <tr>

                                <th scope="col">No</th>
                                <th scope="col">Jenis Layanan</th>
                                <th scope="col">Jenis Kategori</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>

                                <!-- Kolom untuk ikon edit dan delete -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $no = 0;
                            // Check if there are rows to fetch
                            if (mysqli_num_rows($jenisLaundry) > 0) {
                                while ($row = mysqli_fetch_array($jenisLaundry)) {
                                    if ($row['jenis_layanan'] == 'cuci+setrika') {
                                        $no++;
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $no . "</th>";
                                        echo "<td>" . $row['jenis_layanan'] . "</td>";
                                        echo "<td>" . $row['nama_jenis_laundry'] . "</td>";

                                        echo "<td>" . $row['nama_produk'] . "</td>";
                                        echo "<td>" . $row['harga_perkilo'] . "</td>";
                                    }
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- pilih kategori -->
<script>
$(document).ready(function() {
    $("#jenis").on('change', function() {
        var jenis = $(this).val();

        if (jenis == 'kiloan') {
            $("#nama_produk").html(
                "<option value='Reguler'>Reguler</option>" +
                "<option value='2 hari'>2 hari</option>" +
                "<option value='3 hari'>1 hari</option>" +
                "<option value='4 hari'>8 jam</option>" +
                "<option value='3 jam'>3 jam</option>"
            );
        } else if (jenis == 'satuan') {
            $("#nama_produk").html(
                "<option value='boneka'>boneka</option>" +
                "<option value='boneka besar'>boneka besar</option>" +
                "<option value='boneka jumbo'>boneka jumbo</option>" +
                "<option value='karpet kecil'>karpet</option>" +
                "<option value='karpet sedang'>karpet sedang</option>" +
                "<option value='karpet jumbo'>karpet jumbo</option>" +
                "<option value='sprey,selimut'>sprey,selimut</option>" +
                "<option value='bed cover'>bed cover</option>" +
                "<option value='jas'>jas</option>" +
                "<option value='jas 1 stel'>jas 1 stel</option>"

            );
        } else {
            $("#nama_produk").css("visibility", "hidden");
        }

        // Tambahkan bagian ini untuk memperlihatkan kembali elemen jika jenis bukan satuan atau kiloan
        if (jenis != 'satuan' && jenis != 'kiloan') {
            $("#nama_produk").css("visibility", "visible");
        }
    });
});
</script>

<!-- antarjemput -->
<script>
$(document).ready(function() {
    $("#alamat_input").on('change', function() {
        var layanan = $(this).val();

        if (layanan == 'antar jemput') {
            // Tampilkan input alamat jika layanan adalah antar jemput
            $("#alamat_antar_fields").html(
                // "<div class='col-md-4'>" +
                "<label for='validationCustom02' class='form-label'>Alamat</label>" +
                "<input type='text' class='form-control' name='alamat' value='<?php echo $alamat; ?>' required readonly>" +
                "</div>"
            );

        }
        if (layanan == 'tidak') {
            // Tampilkan input alamat jika layanan adalah antar jemput
            $("#alamat_antar_fields").html(
                // "<div class='col-md-4'>" +
                "<label for='validationCustom02' class='form-label'>Alamat</label>" +
                "<input type='text' class='form-control' name='alamat' value='--' required readonly>" +
                "</div>"
            );
        } else {
            // Sembunyikan input alamat jika layanan bukan antar jemput
            $("#alamat_antar_fields").html("");
        }
    });
});
</script>