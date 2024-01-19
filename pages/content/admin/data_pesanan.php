<?php

session_start();
require_once "../../core/connection.php";

if ($_SESSION['role'] != 'admin') {
    header('Location: ../../../login');
    exit(session_destroy());
}

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
require_once "{$base_dir}pages{$ds}core{$ds}header.php";
require_once "{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php";
require_once "../backend/filter_pesanan.php";
// Periksa apakah fungsi showAlert sudah ditentukan
require_once "sweetalert.php";

if (isset($_GET['berhasil'])) {
    $berhasil = $_GET['berhasil'];
    if ($berhasil === 'update_berhasil') {
        showAlert('success', 'Berhasil', 'pesanan berhasil di proses.');
    }
}

if (isset($_GET['hapus'])) {
    $berhasil = $_GET['hapus'];
    if ($berhasil === 'berhasil_dihapus') {
        showAlert('success', 'Berhasil', 'Data Pesanan berhasil di HAPUS .');
    }
}

?>

<main id='main' class='main' class='main animated'>

    <div class='pagetitle'>
        <h1>Data Pesanan Laundry</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard-admin'>Home</a></li>
                <li class=' breadcrumb-item active'>Data Pesanan Laundry</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Table Section -->
            <div class='col-lg-12'>
                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Data Pesanan </h5>
                        <p>Data ini terdiri dari semua Pesanan masuk laundry yang tersedia dalam aplikasi.
                            <b>De'Ungu Laundry</b>.
                        </p>

                        <form method='GET' action=''>
                            <label for='filter'>Filter by:</label>
                            <select name='filter' id='filter'>
                                <option value='today' <?php echo ($filter === 'today') ? 'selected' : ''; ?>>Today
                                </option>
                                <option value='month' <?php echo ($filter === 'month') ? 'selected' : ''; ?>>This
                                    Month
                                </option>
                                <option value='year' <?php echo ($filter === 'year') ? 'selected' : ''; ?>>This Year
                                </option>
                                <option value='all' <?php echo ($filter === 'all') ? 'selected' : ''; ?>>All
                                </option>
                            </select>
                            <div class="mt-2">
                                <button cltype='submit' class='btn btn-primary btn-sm'>Tampilkan Data</button>
                            </div>
                        </form>
                    </div>
                    <div class=' table-responsive'>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                if (mysqli_num_rows($order) > 0) {
                                    while ($row = mysqli_fetch_array($order)) {
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
                                        echo '<td>' . $row['status_pembayaran'] . '</td>';
                                        echo "<td class='text-center '>";
                                        echo "<a class='btn btn-warning btn-sm edit-btn' title='Edit Pesanan' data-bs-toggle='modal' data-bs-target='#largemodal" . $no . "'>
                                                    <i class='bi bi-pencil-fill'></i>
                                                </a>";
                                        echo "<a class='btn btn-danger btn-sm delete-btn ml-2' title='Tolak Pesanan' onclick='deleteConfirmation(" . $row['id_order'] . ", \"order\")'>
                                                    <i class='bi bi-x-circle'></i>
                                                </a>";
                                        echo '</td>';
                                        echo '</tr>';

                                        // Modal Edit untuk setiap data
                                        echo "<div class='modal fade ' id='largemodal" . $no . "' tabindex='-1'>";
                                        echo "<div class='modal-dialog modal-dialog-scrollable'>";
                                        echo "<div class='modal-content'>";
                                        echo "<div class='modal-header'>";
                                        echo "<h5 class='modal-title'><strong>Memproses Pesanan</strong></h5>";
                                        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                                        echo '</div>';

                                        // Ambil data pengguna berdasarkan ID
                                        $id_order = $row['id_order'];
                                        $result = mysqli_query($db_connect, "SELECT * FROM `order` WHERE id_order= $id_order");
                                        if ($result) {
                                            $jenislaundry = mysqli_fetch_assoc($result);

                                            // Formulir Edit
                                            echo "<div class='modal-body'>";
                                            echo "<form action='../backend/proses_pemesanan' method='POST'>";
                                            echo "<input type='hidden' name='id_order' value='" . $jenislaundry['id_order'] . "'>";

                                            echo "<div class='mb-4'>";
                                            echo "<label for='no_telp' class='form-label'>Nama Pelanggan</label>";
                                            echo "<input type='text' class='form-control' id='nama_pelanggan' name='nama_pelanggan' value='" . $jenislaundry['nama_pelanggan'] . "' required readonly >";
                                            echo '</div>';
                                            //
                                            echo "<div class='mb-4'>";
                                            echo "<label for='no_telp' class='form-label'>Jenis Layanan</label>";
                                            echo "<input type='text' class='form-control' id='jenis_layanan' name='jenis_layanan' value='" . $jenislaundry['jenis_layanan'] . "' required readonly  >";
                                            echo '</div>';

                                            echo "<div class='mb-4'>";
                                            echo "<label for='no_telp' class='form-label'>Jenis Laundry</label>";
                                            echo "<input type='text' class='form-control' id='jenis_laundry' name='jenis_laundry' value='" . $jenislaundry['jenis_laundry'] . "' required readonly  >";
                                            echo '</div>';

                                            echo "<div class='mb-4'>";
                                            echo "<label for='no_telp' class='form-label'>Kategori Laundry</label>";
                                            echo "<input type='text' class='form-control' id='nama_produk' name='nama_produk' value='" . $jenislaundry['nama_produk'] . "' required readonly  >";
                                            echo '</div>';

                                            echo "<div class='mb-3'>";
                                            echo "<label for='no_telp' class='form-label'>Resi Pesanan</label>";
                                            echo "<input type='text' class='form-control' id='resi_pesanan' name='resi_pesanan' value='" . $jenislaundry['resi_pesanan'] . "' required readonly  >";
                                            echo '</div>';

                                            echo "<div class='mb-4'>";
                                            echo "<label for='no_telp' class='form-label'>Jumlah Kilo/satuan</label>";
                                            echo "<input type='number' class='form-control' id='jumlah_kilo' name='jumlah_kilo' value='" . $jenislaundry['jumlah_kilo'] . "' >";
                                            echo '</div>';

                                            echo "<div class='mb-4'>";
                                            echo "<label for='no_telp' class='form-label'>Total Harga</label>";
                                            echo "<input type='number' class='form-control' id='total_harga' name='total_harga' value='" . $jenislaundry['total_harga'] . "' >";
                                            echo '</div>';

                                            echo "<div class='mb-3'>";
                                            echo "<label for='nama_jenis' class='form-label'>Proses Laundry</label>";
                                            echo " <select class='form-select' name='proses_laundry' required>";
                                            echo '  <option selected disabled>pilih...</option>';
                                            echo " <option value='menunggu' " . ($jenislaundry['proses_laundry'] == 'menunggu' ? 'selected' : '') . '>Menunggu</option>';
                                            echo "  <option value='diproses' " . ($jenislaundry['proses_laundry'] == 'diproses' ? 'selected' : '') . '>Di Proses</option>';
                                            echo "  <option value='selesai' " . ($jenislaundry['proses_laundry'] == 'selesai' ? 'selected' : '') . '>Selesai</option>';
                                            echo ' </select>';
                                            echo '</div>';

                                            echo "<div class='mb-3'>";
                                            echo "<label for='nama_jenis' class='form-label'>Status Pembayaran</label>";
                                            echo " <select class='form-select' name='status_pembayaran' required>";
                                            echo '  <option selected disabled>pilih...</option>';
                                            echo " <option value='belumbayar' " . ($jenislaundry['status_pembayaran'] == 'belumbayar' ? 'selected' : '') . '>Belum Bayar</option>';
                                            echo "  <option value='DP' " . ($jenislaundry['status_pembayaran'] == 'DP' ? 'selected' : '') . '>Uang Muka(DP)</option>';
                                            echo "  <option value='lunas' " . ($jenislaundry['status_pembayaran'] == 'lunas' ? 'selected' : '') . '>Lunas</option>';
                                            echo ' </select>';
                                            echo '</div>';

                                            echo "<div class='mb-4'>";
                                            echo "<label for='no_telp' class='form-label'>Total Bayar</label>";
                                            echo "<input type='number' class='form-control' id='jumlah_bayar' name='jumlah_bayar' value='" . $jenislaundry['jumlah_bayar'] . "' >";
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
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>