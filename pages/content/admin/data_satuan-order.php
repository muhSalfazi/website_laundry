<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../../../');
    session_destroy();
}
?>
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");
require_once("{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php");

// Periksa apakah fungsi showAlert sudah ditentukan
if (!function_exists('showAlert')) {
    function showAlert($icon, $title, $message, $redirect = null)
    {
        echo "
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: '$icon',
                    title: '$title',
                    html: '<p class=\"p-popup\">$message</p>',
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        " . ($redirect ? "window.location.href = '$redirect';" : '') . "
                    }
                });
            });
        </script>
        ";
    }
}
?>

<main id='main' class='main'>

    <div class='pagetitle'>
        <h1>Data Pesanan Satuan</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class='breadcrumb-item'><a href='../../content/admin/data_pesanan.php'>Data Pesanan</a></li>
                <li class=' breadcrumb-item active'>Data Pesanan Satuan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->
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

            <?php

            // mengecek di edit


            ?>

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'></h5>

                        <div class='col-lg-12'>

                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Data Pesanan Jenis Satuan</h5>
                                    <p>Data ini terdiri dari semua Pesanan masuk laundry yang tersedia dalam aplikasi.
                                        <b>De'Ungu
                                            Laundry</b>.
                                    </p>
                                    <!--table reponsif-->
                                    <div class=' table-responsive'>
                                        <!-- Table with stripped rows -->
                                        <table class='table datatable'>
                                            <thead>
                                                <tr>

                                                    <th scope='col'>No</th>
                                                    <th scope='col'>nama pelanggan</th>
                                                    <th scope='col'>jenis layanan</th>
                                                    <th scope='col'>jenis_laundry</th>
                                                    <th scope='col'>resi pesanan</th>
                                                    <th scope='col'>layanan antar</th>
                                                    <th scope='col'>Alamat</th>
                                                    <th scope='col'>proses laundry</th>
                                                    <th scope='col'>status pembayaran</th>

                                                    <th scope='col'>opsi</th>
                                                    <!-- Kolom untuk ikon edit dan delete -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $no = 0;
                                                // Check if there are rows to fetch
                                                if (mysqli_num_rows($order) > 0) {
                                                    while ($row = mysqli_fetch_array($order)) {
                                                        //hanya menampilkan data jenis laundry satuan
                                                        if ($row['jenis_laundry'] == 'satuan') {
                                                            $no++;
                                                            echo '<tr>';
                                                            echo "<th scope='row'>" . $no . '</th>';
                                                            echo '<td>' . $row['nama_pelanggan'] . '</td>';
                                                            echo '<td>' . $row['jenis_layanan'] . '</td>';
                                                            echo '<td>' . $row['jenis_laundry'] . '</td>';
                                                            echo '<td>' . $row['resi_pesanan'] . '</td>';
                                                            echo '<td>' . $row['layanan_antar'] . '</td>';
                                                            echo '<td>' . $row['alamat'] . '</td>';
                                                            echo '<td>' . $row['proses_laundry'] . '</td>';
                                                            echo '<td>' . $row['stasus_pembayaran'] . '</td>';

                                                            // Kolom aksi dengan ikon edit dan delete
                                                            echo "<td class='text-center '>";
                                                            //edit
                                                            echo "<a class='btn btn-warning btn-sm edit-btn' title='Edit Pesanan'data-bs-toggle='modal' data-bs-target='#largemodal" . $no . "'>
                                                            <i class='bi bi-pencil-fill'></i>
                                                            </a>";
                                                ?>
                                                            <!-- delete -->
                                                            <a class='btn btn-danger btn-sm delete-btn ml-2' title='Tolak Pesanan' onclick="deleteConfirmation(<?= $row['id_order'] ?>, 'order')">
                                                                <i class='bi bi-x-circle'></i>
                                                            </a>

                                                <?php
                                                            echo '</td>';

                                                            echo '</tr>';
                                                        } else {
                                                        }
                                                        // Modal Edit untuk setiap data
                                                        echo "<div class='modal fade ' id='largemodal" . $no . "' tabindex='-1'>";
                                                        echo "<div class='modal-dialog modal-dialog-scrollable'>";
                                                        echo "<div class='modal-content'>";
                                                        echo "<div class='modal-header'>";
                                                        echo "<h5 class='modal-title'><strong>Edit Pesanan Order</strong></h5>";
                                                        echo "<button type='button' class='btn-close'data-bs-dismiss='modal' aria-label='Close'></button>";
                                                        echo '</div>';

                                                        // Ambil data pengguna berdasarkan ID
                                                        $id_order = $row['id_order'];
                                                        $result = mysqli_query($db_connect, "SELECT * FROM `order` WHERE id_order= $id_order");
                                                        if ($result) {
                                                            $jenislaundry = mysqli_fetch_assoc($result);

                                                            // Formulir Edit
                                                            echo "<div class='modal-body'>";
                                                            echo "<form action='../backend/edit_jenis_laundry.php' method='POST'>";
                                                            echo "<input type='hidden' name='id_jenis_laundry' value='" . $jenislaundry['id_order'] . "'>";

                                                            //
                                                            echo "<div class='mb-4'>";
                                                            echo "<label for='no_telp' class='form-label'>Nama Produk</label>";
                                                            echo "<input type='text' class='form-control' id='nama_produk' name='nama_produk' value='" . $jenislaundry['nama_pelanggan'] . "' required readonly >";
                                                            echo '</div>';

                                                            //
                                                            echo "<div class='mb-4'>";
                                                            echo "<label for='no_telp' class='form-label'>Nama Produk</label>";
                                                            echo "<input type='text' class='form-control' id='nama_produk' name='nama_produk' value='" . $jenislaundry['nama_produk'] . "' required readonly  >";
                                                            echo '</div>';
                                                            //

                                                            echo "<div class='mb-3'>";
                                                            echo "<label for='no_telp' class='form-label'>Resi Pesanan</label>";
                                                            echo "<input type='text' class='form-control' id='nama_produk' name='nama_produk' value='" . $jenislaundry['resi_pesanan'] . "' required readonly  >";
                                                            echo '</div>';
                                                            //

                                                            //
                                                            echo "<div id='total-harga-container' style='display: none;'>" . $jenislaundry['total_harga'] . '</div>';

                                                            //
                                                            echo "<div class='mb-3'>";
                                                            echo "<label for='nama_jenis' class='form-label'>Proses Laundry</label>";
                                                            echo " <select class='form-select' name='nama_jenis_laundry' required>";
                                                            echo '  <option selected disabled>pilih...</option>';
                                                            echo " <option value='menunggu' " . ($jenislaundry['proses_laundry'] == 'menunggu' ? 'selected' : '') . '>Menunggu</option>';
                                                            echo "  <option value='diproses' " . ($jenislaundry['proses_laundry'] == 'diproses' ? 'selected' : '') . '>Di Proses</option>';
                                                            echo "  <option value='selesai' " . ($jenislaundry['proses_laundry'] == 'selesai' ? 'selected' : '') . '>Selesai</option>';
                                                            echo ' </select>';
                                                            echo '</div>';
                                                            //

                                                            echo "<div class='mb-3'>";
                                                            echo "<label for='nama_jenis' class='form-label'>Status Pembayaran</label>";
                                                            echo " <select class='form-select' id='pembayaran' name='status_pembayaran' required>";
                                                            echo '  <option selected disabled>pilih...</option>';
                                                            echo " <option value='belumbayar' " . ($jenislaundry['sttus_pembayaran'] == 'belumbayar' ? 'selected' : '') . '>belum bayar</option>';
                                                            echo "  <option value='DP' " . ($jenislaundry['status_pembayaran'] == 'DP' ? 'selected' : '') . '>Uang muka(DP)</option>';
                                                            echo "  <option value='lunas' " . ($jenislaundry['status_pembayaran'] == 'lunas' ? 'selected' : '') . '>Lunas</option>';
                                                            echo ' </select>';
                                                            echo '</div>';
                                                            //

                                                            echo "<div class='mb-4'>";
                                                            echo "<label for='no_telp' class='form-label'>Nama Produk</label>";
                                                            echo "<input type='text' class='form-control' id='nama_produk' name='nama_produk' value='" . $jenislaundry['total_harga'] . "' required readonly  >";
                                                            echo '</div>';
                                                            // Footer Modal Edit
                                                            echo "<div class='modal-footer'>";
                                                            echo "<button type='button' class='btn btn-secondary ' data-bs-dismiss='modal'>Close</button>";
                                                            echo "<button name='submit' type='submit' class='btn btn-primary'>Save changes</button>";
                                                            echo '</div>';

                                                            // Akhir Formulir Edit
                                                            echo '</form>';
                                                            echo '</div>';
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