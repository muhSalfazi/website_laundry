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
        <h1>Order Pesanan</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>

                <li class=' breadcrumb-item active'>order Pesanan </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Order layanan Setrika</h5>

                        <!-- Custom Styled Validation -->
                        <form action='../backend/order' method='post' enctype='multipart/form-data'
                            class='row g-3 needs-validation' novalidate>

                            <div class='col-md-4'>
                                <label for='validationCustom02' class='form-label'>Nama Pelanggan</label>
                                <input type='text' class='form-control' name='nama_pelanggan' value="  <?php echo $nama_lengkap;
                                                                                                        ?>" required
                                    readonly>
                                <div class='invalid-feedback'>
                                    Silakan pilih jenis bagian yang valid.
                                </div>
                            </div>

                            <div class='col-md-4'>
                                <label for='validationCustom02' class='form-label'>No Handphone</label>
                                <input type='text' class='form-control' name='no_telp' value="<?php echo $no_telp; ?>"
                                    required readonly>
                                <div class='invalid-feedback'>

                                </div>
                            </div>
                            <div class='col-md-4'>
                                <label for='validationCustom04' class='form-label'>Jenis Layanan</label>
                                <select class='form-select' id="layanan" name='jenis_layanan' required>
                                    <option selected disabled>pilih...</option>
                                    <option value='cuci+setrika'>cuci+setrika</option>
                                    <option value='cuci'>cuci</option>
                                    <option value='setrika'>setrika</option>
                                    <option value='karpet'>karpet</option>
                                </select>
                                <div class='invalid-feedback'>

                                </div>
                            </div>

                            <div class='col-md-4'>
                                <label for='validationCustom04' class='form-label'>Jenis Laundry</label>
                                <select class='form-select' id="jenis" name='jenis_laundry' required>
                                    <option selected disabled>pilih jenis layanan terlebih dahulu</option>
                                </select>
                                <div class='invalid-feedback'>
                                    isi jenis layanan terlebih dahulu
                                </div>
                            </div>


                            <div class='col-md-4'>
                                <label for='validationCustom02' class='form-label'>kategori laundry</label>
                                <select class='form-select' name="nama_produk" id="nama_produk" required>
                                    <option selected disabled>pilih jenis kategori dahulu</option>
                                    <!-- <option selected disabled>isi jenis Laundry dahulu</option> -->
                                    <!-- <input type='text' class='form-control' name='nama_produk' placeholder=' silahkan isi'
                                    required> -->
                                </select>
                                <div class='invalid-feedback'>
                                    isi jenis Laundry dahulu
                                </div>
                            </div>

                            <div class=' col-md-4'>
                                <label for='validationCustom04' class='form-label'>layanan antar</label>
                                <select class='form-select' id="alamat_input" name='layanan_antar' required>
                                    <option selected disabled>pilih...</option>
                                    <option value='antar jemput'>Antar Jemput</option>
                                    <option value='tidak'>tidak</option>
                                </select>

                            </div>
                            <!-- alamat -->
                            <div class='col-md-12 ' id="alamat_antar_fields">
                                <label for='validationCustom02' class='form-label'>Alamat</label>
                                <input type='text' class='form-control' name='alamat'
                                    placeholder="isi layanan antar dahulu" required readonly>

                            </div>

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
<!-- modal -->
<!-- pilih layanan -->
<script>
$(document).ready(function() {
    // Fungsi untuk mereset jenis kategori dan kategori laundry
    function resetJenisKategori() {
        $("#jenis").val(null);
        $("#nama_produk").val(null);
    }

    // Fungsi untuk memperbarui opsi-opsi jenis kategori berdasarkan jenis layanan
    function updateJenisKategoriOptions(jenis) {

        var options = "<option selected disabled>pilih...</option>";

        // Logika penentuan opsi-opsi untuk jenis kategori
        if (jenis == 'cuci+setrika') {
            options += "<option value='kiloan'>Kiloan</option>";
            options += "<option value='satuan'>SATUAN</option>";
        } else if (jenis == 'setrika') {
            options += "<option value='kiloan'>Kiloan</option>";
            options += "<option value='paketan'>Paketan</option>";
        } else if (jenis == 'cuci') {
            options += "<option value='kiloan'>Kiloan</option>";
            options += "<option value='satuan'>SATUAN</option>";
        } else if (jenis == 'karpet') {

            options += "<option value='karpet'>karpet</option>";
        }

        // Hapus opsi yang tidak diperlukan
        $("#jenis").html(options);
        $("#nama_produk").html("<option selected disabled>isi jenis Laundry dahulu</option>");

    }

    // Event handler untuk perubahan jenis layanan
    $("#layanan").on('change', function() {
        var jenis = $(this).val();

        // Reset dan update opsi-opsi berdasarkan jenis layanan
        resetJenisKategori();
        updateJenisKategoriOptions(jenis);


    });

    // Event handler untuk perubahan jenis kategori
    $("#jenis").on('change', function() {
        var jenis = $(this).val();



        // Logika untuk memperbarui opsi-opsi kategori laundry berdasarkan jenis kategori
        var kategoriOptions = "<option selected disabled>pilih...</option>";

        if (jenis == 'kiloan') {
            kategoriOptions += "<option value='Reguler'>Reguler</option>";
            kategoriOptions += "<option value='2 hari'>2 hari</option>";
            kategoriOptions += "<option value='3 hari'>1 hari</option>";
            kategoriOptions += "<option value='4 hari'>8 jam</option>";
            kategoriOptions += "<option value='3 jam'>3 jam</option>";
        } else if (jenis == 'satuan') {
            kategoriOptions += "<option value='sprey,selimut'>sprey,selimut</option>";
            kategoriOptions += "<option value='bed cover'>bed cover</option>";
            kategoriOptions += "<option value='jas'>jas</option>";
            kategoriOptions += "<option value='jas 1 stel'>jas 1 stel</option>";
        } else if (jenis == 'paketan') {
            kategoriOptions += "<option value='paket setrika'>Paket Setika</option>";
        } else if (jenis == 'karpet') {
            kategoriOptions += "<option value='karpet kecil'>karpet kecil</option>";
            kategoriOptions += "<option value='karpet sedang'>karpet sedang</option>";
            kategoriOptions += "<option value='karpet jumbo'>karpet jumbo</option>";
        }

        // Update opsi-opsi kategori laundry
        $("#nama_produk").html(kategoriOptions);
    });

    // Event handler untuk perubahan layanan antar
    $("#alamat_input").on('change', function() {
        var layanan = $(this).val();


        // Logika untuk memperbarui input alamat berdasarkan layanan antar
        var alamatField = "<label for='validationCustom02' class='form-label'>Alamat</label>" +
            "<input type='text' class='form-control' name='alamat' value='" + (layanan ==
                'antar jemput' ? '<?php echo $alamat; ?>' : '--') + "' required readonly>" +
            "</div>";

        // Update input alamat
        $("#alamat_antar_fields").html(alamatField);
    });
});
</script>


<!-- antarjemput -->