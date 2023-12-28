<?php
session_start();

if ($_SESSION['role'] != 'admin') {

    header('Location:../../../');
    exit(session_destroy());
}
?>
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");
include("{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php");

?>

<main id='main' class='main'>
    <?php

    function showAlert($icon, $title, $message, $redirect = null)
    {
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
                    " . ($redirect ? "window.location.href = '$redirect';" : '') . "
                });
            });
        </script>
        ";
    }
    ?>
    <!--create-->

    <?php

    // mengecek di edit
    if (isset($_GET['berhasil'])) {
        $berhasil = $_GET['berhasil'];
        if ($berhasil === 'update_berhasil') {
            showAlert('success', 'Berhasil', 'jenis laundry berhasil di update.');
        }
    }
    //berhasil di tambahkan
    if (isset($_GET['add'])) {
        $berhasil = $_GET['add'];
        if ($berhasil === 'tambah_berhasil') {
            showAlert('success', 'Berhasil', 'jenis laundry berhasil di tambahkan .');
        }
    }
    //berhasil di hapus
    if (isset($_GET['hapus'])) {
        $berhasil = $_GET['hapus'];
        if ($berhasil === 'berhasil_dihapus') {
            showAlert('success', 'Berhasil', 'jenis laundry berhasil di HAPUS .');
        }
    }

    ?>

    <div class='pagetitle'>
        <h1>Jenis Laundry</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard-admin'>Home</a></li>
                <li class='breadcrumb-item'><a href='../../content/admin/stok_investaris'>Stok Investaris</a></li>
                <li class=' breadcrumb-item active'>Jenis Laundry</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Jenis Laundry</h5>
                        <a href='./add_jenis' class='btn btn-primary' data-toggle='modal'>
                            <i xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-plus' viewBox='0 0 16 16'>
                                <path d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6' />
                                <path fill-rule='evenodd' d='M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5' />
                            </i>
                            Add Jenis Laundry
                        </a>
                        <p>Data ini terdiri dari semua jenis laundry yang tersedia dalam aplikasi. <b>De'Ungu
                                Laundry</b>.</p>
                        <!--table reponsif-->
                        <div class=" table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>

                                        <th scope="col">No</th>
                                        <th scope="col">jenis layanan</th>
                                        <th scope="col">jenis produk</th>
                                        <th scope="col">ketegori Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">opsi</th>
                                        <!-- Kolom untuk ikon edit dan delete -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $no = 0;
                                    // Check if there are rows to fetch
                                    if (mysqli_num_rows($jenisLaundry) > 0) {
                                        while ($row = mysqli_fetch_array($jenisLaundry)) {
                                            $no++;
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $no . "</th>";
                                            echo "<td>" . $row['jenis_layanan'] . "</td>";
                                            echo "<td>" . $row['nama_jenis_laundry'] . "</td>";
                                            echo "<td>" . $row['nama_produk'] . "</td>";
                                            echo "<td>" . $row['harga_perkilo'] . "</td>";
                                            // Kolom aksi dengan ikon edit dan delete
                                            echo "<td class='text-center '>";
                                            //edit
                                            echo "<a class='btn btn-warning btn-sm edit-btn' data-bs-toggle='modal' data-bs-target='#smallModal" . $no . "'>
            <i class='bi bi-pencil-fill'></i>
            </a>";
                                    ?>

                                            <!-- delete -->
                                            <a class="btn btn-danger btn-sm delete-btn ml-2" title="Delete" onclick="deleteConfirmation(<?= $row['id_jenis_laundry'] ?>, 'jenis_laundry')">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>




                                    <?php
                                            echo "</td>";

                                            echo "</tr>";
                                            // Modal Edit untuk setiap data
                                            echo "<div class='modal fade' id='smallModal" . $no . "' tabindex='-1'>";
                                            echo "<div class='modal-dialog modal-sm'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title'>Edit Jenis Laundry </h5>";
                                            echo "<button type='button' class='btn-close'data-bs-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";


                                            // Ambil data pengguna berdasarkan ID
                                            $id_jenis_laundry = $row['id_jenis_laundry'];
                                            $result = mysqli_query($db_connect, "SELECT * FROM jenis_laundry WHERE id_jenis_laundry = $id_jenis_laundry");
                                            if ($result) {
                                                $jenislaundry = mysqli_fetch_assoc($result);

                                                // Formulir Edit
                                                echo "<div class='modal-body'>";
                                                echo "<form action='../backend/edit_jenis_laundry.php' method='POST'>";
                                                echo "<input type='hidden' name='id_jenis_laundry' value='" . $jenislaundry['id_jenis_laundry'] . "'>";
                                                //
                                                echo "<div class='mb-3'>";
                                                echo "<label for='nama_jenis' class='form-label'>Jenis Produk</label>";
                                                echo " <select class='form-select' name='nama_jenis_laundry' required>";
                                                echo "  <option selected disabled>pilih...</option>";
                                                echo " <option value='PerKILO' " . ($jenislaundry['nama_jenis_laundry'] == 'PerKILO' ? 'selected' : '') . ">PERKILO</option>";
                                                echo "  <option value='Satuan' " . ($jenislaundry['nama_jenis_laundry'] == 'Satuan' ? 'selected' : '') . ">SATUAN</option>";
                                                echo " </select>";
                                                echo "</div>";

                                                //
                                                echo "<div class='mb-3'>";
                                                echo "<label for='no_telp' class='form-label'>Nama Produk</label>";
                                                echo "<input type='text' class='form-control' id='nama_produk' name='nama_produk' value='" . $jenislaundry['nama_produk'] . "' >";
                                                echo "</div>";

                                                echo "<div class='mb-3'>";
                                                echo "<label for='no_telp' class='form-label'>Jumlah Barang</label>";
                                                echo "<input type='number' class='form-control' id='harga_perkilo' name='harga_perkilo' value='" . $jenislaundry['harga_perkilo'] . "' >";
                                                echo "</div>";


                                                // Footer Modal Edit
                                                echo "<div class='modal-footer'>";
                                                echo "<button type='button' class='btn btn-secondary ' data-bs-dismiss='modal'>Close</button>";
                                                echo "<button name='submit' type='submit' class='btn btn-primary'>Save changes</button>";
                                                echo "</div>";

                                                // Akhir Formulir Edit
                                                echo "</form>";
                                                echo "</div>";
                                            }
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No data available</td></tr>";
                                    }
                                    ?>




                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>

            </div>

            <!-- End Ngoding Disini -->

        </div>
    </section>

</main><!-- End #main -->

<?php
include '../../core/footer.php';
?>