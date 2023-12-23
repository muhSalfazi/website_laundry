<?php
session_start();
if ($_SESSION['role'] != 'admin') {

    header('Location:../../../');
    exit(session_destroy());
}
?>
<?php
require_once '../../core/config.php';
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

    // mengecek di tambahkan
    if (isset($_GET['berhasil'])) {
        $berhasil = $_GET['berhasil'];
        if ($berhasil === 'add_berhasil') {
            showAlert('success', 'Berhasil', ' data barang berhasil di ditambahkan.');
        }
    }
    ?>
    <?php
    // mengecek di tambahkan
    if (isset($_GET['berhasil'])) {
        $berhasil = $_GET['berhasil'];
        if ($berhasil === 'edit_berhasil') {
            showAlert('success', 'Berhasil', ' data barang berhasil di update beserta gambar.');
        }
    }

    // mengecek di tambahkan
    if (isset($_GET['sukses'])) {
        $berhasil = $_GET['sukses'];
        if ($berhasil === 'edit_berhasil') {
            showAlert('success', 'Berhasil', ' data barang berhasil di UPDATE .');
        }
    }

    // mengecek di hapus
    if (isset($_GET['hapus'])) {
        $berhasil = $_GET['hapus'];
        if ($berhasil === 'berhasil_dihapus') {
            showAlert('success', 'Berhasil', ' data barang berhasil di HAPUS .');
        }
    }
    ?>

    <div class='pagetitle'>
        <h1>Stok Barang</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class='breadcrumb-item'><a href='../../content/User/stok_investaris'>Stok Investaris</a></li>
                <li class=' breadcrumb-item active'>Stok Barang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Stok Barang</h5>
                        <a href='./add_barang' class='btn btn-primary' data-toggle='modal'>
                            <i xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-plus' viewBox='0 0 16 16'>
                                <path d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6' />
                                <path fill-rule='evenodd' d='M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5' />
                            </i>
                            Add Barang
                        </a>
                        <p>Data ini terdiri dari semua stok barang laundry yang tersedia dalam aplikasi. <b>De'Ungu
                                Laundry</b>.</p>
                        <!--table reponsif-->
                        <div class=" table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>

                                        <th class="tex-center" scope="col">No</th>
                                        <th class="tex-center" scope="col">Nama Barang</th>
                                        <th class="tex-center" scope="col">Kode Barang</th>
                                        <th class="tex-center" scope="col">Total Barang</th>
                                        <th class="tex-center" scope="col">Image</th>
                                        <th class="tex-center" scope="col">opsi</th>
                                        <!-- Kolom untuk ikon edit dan delete -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $no = 0;
                                    // Check if there are rows to fetch
                                    if (mysqli_num_rows($stokBarang) > 0) {
                                        while ($row = mysqli_fetch_array($stokBarang)) {
                                            $no++;
                                            echo "<tr>";
                                            echo "<th class='tex-center' scope='row'>" . $no . "</th>";
                                            echo "<td class='tex-center' scope='row'>" . $row['nama_barang'] . "</td>";
                                            echo "<td class='tex-center'  scope='row'>" . $row['kode_barang'] . "</td>";
                                            echo "<td class='tex-center'  scope='row'>" . $row['total_barang'] . "</td>";
                                    ?>
                                            <td class="text-center"><a href="<?= BASEURL . '/coding_web/project_smstr3/pages/content/' . $row['image']; ?>" target="_blank">Unduh</a>
                                            </td>
                                            <?php
                                            // Kolom aksi dengan ikon edit dan delete
                                            echo "<td class='text-center'>";

                                            //edit
                                            echo "<a class='btn btn-warning btn-sm edit-btn  ' data-bs-toggle='modal'
                                            data-bs-target='#smallModal" . $no . "'>
                                            <i class='bi bi-pencil-fill'></i>
                                        </a>";
                                            ?>

                                            <!-- delete -->
                                            <a class="btn btn-danger btn-sm delete-btn ml-2" title="Delete" onclick="deleteConfirmation(<?= $row['id_stok_barang'] ?>, 'stok_barang')">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>

                                    <?php
                                            echo "</td>";

                                            echo "</tr>";

                                            // ...

                                            // Modal Edit untuk setiap data
                                            echo "<div class='modal fade' id='smallModal" . $no . "' tabindex='-1'>";
                                            echo "<div class='modal-dialog modal-sm'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title'>Edit Stok Barang </h5>";
                                            echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";

                                            // Ambil data barang berdasarkan ID
                                            $id_stok_barang = $row['id_stok_barang'];
                                            $result = mysqli_query($db_connect, "SELECT * FROM stok_barang WHERE id_stok_barang = $id_stok_barang");

                                            if ($result) {
                                                $stok_barang = mysqli_fetch_assoc($result);

                                                // Formulir Edit
                                                echo "<div class='modal-body'>";
                                                echo "<form action='../backend/edit_stok_barang.php' method='POST' enctype='multipart/form-data'>";
                                                echo "<input type='hidden' name='id_stok_barang' value='" . $stok_barang['id_stok_barang'] . "'>";

                                                // Field nama barang
                                                echo "<div class='mb-3'>";
                                                echo "<label for='nama_barang' class='form-label'>Nama Barang</label>";
                                                echo "<input type='text' class='form-control' id='nama_barang' name='nama_barang' value='" . $stok_barang['nama_barang'] . "' >";
                                                echo "</div>";

                                                // Field jumlah barang
                                                echo "<div class='mb-3'>";
                                                echo "<label for='total_barang' class='form-label'>Jumlah Barang</label>";
                                                echo "<input type='number' class='form-control' id='total_barang' name='total_barang' value='" . $stok_barang['total_barang'] . "' >";
                                                echo "</div>";

                                                // Field untuk mengunggah gambar
                                                echo "<div class='mb-3'>";
                                                echo "<label class='form-label' for='image'>Gambar produk:</label>";
                                                echo "<input class='form-control' type='file' name='image' accept='image/*'>";
                                                echo "</div>";

                                                // Footer Modal Edit
                                                echo "<div class='modal-footer'>";
                                                echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
                                                echo "<button name='submit' type='submit' class='btn btn-primary'>Save changes</button>";
                                                echo "</div>";

                                                // Akhir Formulir Edit
                                                echo "</form>";
                                                echo "</div>";
                                            } else {
                                                echo "Error mengambil data barang.";
                                            }

                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            // ...

                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No data available</td></tr>";
                                    }

                                    ?>




                                </tbody>
                            </table>
                        </div>



                        </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<?php
include '../../core/footer.php';
?>