<?php

session_start();
require_once "../../core/connection.php";

if ($_SESSION['role'] != 'admin') {
    header('Location: ../../../');
    exit(session_destroy());
}

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
require_once "{$base_dir}pages{$ds}core{$ds}header.php";
require_once "{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php";
require_once "../backend/filter_pelanggan.php";

// Function to show alerts using SweetAlert
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
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    " . ($redirect ? "window.location.href = '$redirect';" : '') . "
                });
            });
        </script>
        ";
    }
}
?>

<?php
// mengecek di edit
if (isset($_GET['berhasil'])) {
    $berhasil = $_GET['berhasil'];
    if ($berhasil === 'update_berhasil') {
        showAlert('success', 'Berhasil', 'Data Pelanggan berhasil di update.');
    }
}
// berhasil di tambahkan
if (isset($_GET['add'])) {
    $berhasil = $_GET['add'];
    if ($berhasil === 'add_berhasil') {
        showAlert('success', 'Berhasil', 'Pelanggan berhasil ditambahkan.');
    }
}
// berhasil di hapus
if (isset($_GET['hapus'])) {
    $berhasil = $_GET['hapus'];
    if ($berhasil === 'berhasil_dihapus') {
        showAlert('success', 'Berhasil', 'Data Pelanggan berhasil dihapus.');
    }
}
?>

<main id='main' class='main animated'>
    <div class='pagetitle'>
        <h1>Pelanggan</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard-admin'>Home</a></li>
                <li class='breadcrumb-item active'>Data Pelanggan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>
            <div class='col-lg-12'>
                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Data Pelanggan</h5>
                        <a href='./add_pelanggan' class='btn btn-primary btn-sm' data-toggle='modal'>
                            <i class='bi bi-person-plus-fill'></i> Add Pelanggan
                        </a>
                        <p>Data ini adalah data semua pengguna aplikasi <b>De'Ungu Laundry</b>.</p>
                        <!-- filter data -->
                        <form method='GET' action=''>
                            <label for='filter'>Filter by:</label>
                            <select name='filter' id='filter'>
                                <option value='today' <?php echo ($filter === 'today') ? 'selected' : ''; ?>>Today
                                </option>
                                <option value='month' <?php echo ($filter === 'month') ? 'selected' : ''; ?>>This Month
                                </option>
                                <option value='year' <?php echo ($filter === 'year') ? 'selected' : ''; ?>>This Year
                                </option>
                                <option value='all' <?php echo ($filter === 'all') ? 'selected' : ''; ?>>All</option>
                            </select>
                            <!-- Tambahkan input tersembunyi untuk menyimpan nilai filter -->
                            <input type="hidden" name="original_filter" value="<?php echo $filter; ?>">
                            <div class="mt-2">
                                <button type='submit' name="submit" class='btn btn-primary btn-sm'>Tampilkan
                                    Data</button>
                            </div>
                        </form>
                        <!-- sampai sini -->
                        <div class='col-lg-12'>
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">No Handphone</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        if ($data_pelanggan) {
                                            while ($row = mysqli_fetch_assoc($data_pelanggan)) {
                                                $no++;
                                                echo "<tr>";
                                                echo "<th scope='row'>" . $no . "</th>";
                                                echo "<td>" . $row['nama_lengkap'] . "</td>";
                                                echo "<td>" . $row['no_telp'] . "</td>";
                                                echo "<td>" . $row['alamat'] . "</td>";
                                                echo "<td class='text-center'>";
                                                echo "<a class='btn btn-warning btn-sm edit-btn' data-bs-toggle='modal' data-bs-target='#smallModal" . $no . "'>
                                                <i class='bi bi-pencil-fill'></i>
                                                </a>";
                                                echo "<a class='btn btn-danger btn-sm delete-btn ml-2' title='Delete' onclick='deleteConfirmation(" . $row['id_pelanggan'] . ", \"pelanggan\")'>
                                                <i class='bi bi-trash-fill'></i>
                                                </a>";
                                                echo "</td>";
                                                echo "</tr>";
                                                // Modal Edit untuk setiap data
                                                echo "<div class='modal fade' id='smallModal" . $no . "' tabindex='-1'>";
                                                echo "<div class='modal-dialog modal-sm'>";
                                                echo "<div class='modal-content'>";
                                                echo "<div class='modal-header'>";
                                                echo "<h5 class='modal-title'>Edit Pelanggan</h5>";
                                                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                                                echo "</div>";
                                                // Ambil data pelanggan berdasarkan ID
                                                $id_pelanggan = $row['id_pelanggan'];
                                                $result_edit = mysqli_query($db_connect, "SELECT * FROM pelanggan WHERE id_pelanggan = $id_pelanggan");
                                                if ($result_edit) {
                                                    $pelanggan = mysqli_fetch_assoc($result_edit);
                                                    // Formulir Edit
                                                    echo "<div class='modal-body'>";
                                                    echo "<form action='../backend/edit_pelanggan.php' method='POST'>";
                                                    echo "<input type='hidden' name='id_pelanggan' value='" . $pelanggan['id_pelanggan'] . "'>";
                                                    echo "<div class='mb-3'>";
                                                    echo "<label for='nama_lengkap' class='form-label'>Nama Lengkap</label>";
                                                    echo "<input type='text' class='form-control' id='nama_lengkap' name='nama_lengkap' value='" . $pelanggan['nama_lengkap'] . "' required>";
                                                    echo "</div>";
                                                    echo "<div class='mb-3'>";
                                                    echo "<label for='no_telp' class='form-label'>No Handphone</label>";
                                                    echo "<input type='number' class='form-control' id='no_telp' name='no_telp' value='" . $pelanggan['no_telp'] . "' required>";
                                                    echo "</div>";
                                                    echo "<div class='mb-3'>";
                                                    echo "<label for='alamat' class='form-label'>Alamat</label>";
                                                    echo "<input type='text' class='form-control' id='alamat' name='alamat' value='" . $pelanggan['alamat'] . "' required>";
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
                                                    echo "Error mengambil data pelanggan.";
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php
require_once "{$base_dir}pages{$ds}core{$ds}footer.php";
?>