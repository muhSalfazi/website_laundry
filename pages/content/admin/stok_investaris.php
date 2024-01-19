<?php
session_start();
if ($_SESSION['role'] != 'admin') {

    header('Location:../../../login');
    exit(session_destroy());
}

require_once '../../core/config.php';
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");
include("{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php");
require_once "sweetalert.php";

// mengecek di tambahkan
if (isset($_GET['berhasil'])) {
    $berhasil = $_GET['berhasil'];
    if ($berhasil === 'add_berhasil') {
        showAlert('success', 'Berhasil', ' data barang berhasil di ditambahkan.');
    }
}

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


<main id='main' class='main' class='main animated'>



    <div class='pagetitle'>
        <h1>Data Investaris</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard-admin'>Home</a></li>
                <li class=' breadcrumb-item active'>Stok Investaris</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Stok Investaris</h5>
                        <a href='./add_barang' class="col-md-6">
                            <button type="button" class="btn btn-primary btn-sm mt-2 ">
                                <i class=" bi bi-file-earmark-plus-fill"></i>

                                <span> Add Barang</span>
                            </button>

                        </a>

                        <a href='../backend/download_pdf.php' target="_blank" class="col-md-6">

                            <button type="button" class="btn btn-primary btn-sm mt-2">
                                <i class='bi bi-file-earmark-pdf-fill'></i>

                                <span> Download Data</span>
                            </button>
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
                                    <td class="text-center">
                                        <a href="<?= BASEURL . '/coding_web/project_smstr3/pages/content/' . $row['image']; ?>"
                                            target="_blank">Unduh</a>

                                        <!-- <img src="<?php
                                                                //  BASEURL . '/coding_web/project_smstr3/pages/content/' . $row['image']; 
                                                                ?>"
                                        alt="Gambar" /> -->
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
                                    <a class="btn btn-danger btn-sm delete-btn ml-2" title="Delete"
                                        onclick="deleteConfirmation(<?= $row['id_stok_barang'] ?>, 'stok_barang')">
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
                                        }
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