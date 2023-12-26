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

// Initialize $order variable
$order = array();

// Check if the form is submitted
if (isset($_POST['cek_order'])) {
    $resi_pesanan = $_POST['resi_pesanan'];

    // Assume you have a database connection named $db_connect
    $query = "SELECT * FROM `order` WHERE resi_pesanan = ?";
    $stmt = $db_connect->prepare($query);
    $stmt->bind_param('s', $resi_pesanan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch order details into the $order variable
        $order = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        // Display a message if the order is not found
        header('Location: ../../../pages-error-404.html');
    }
}

// The rest of your HTML and PHP code remains unchanged
?>

<main id='main' class='main'>

    <div class='pagetitle'>
        <h1>Cek Order Pesanan</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class=' breadcrumb-item active'>Cek Order Pesanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class='col-lg-12'>

                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>CEK ORDER</h5>

                        <!-- Custom Styled Validation -->
                        <form action='' method='post' enctype='multipart/form-data' class='row g-3 needs-validation'
                            novalidate>

                            <div class='col-md-12'>
                                <label for='validationCustom02' class='form-label'>Resi Pesanan</label>
                                <input type='text' class='form-control' name='resi_pesanan'
                                    placeholder="masukan resi anda" required>
                                <div class='invalid-feedback'>
                                    Harap Berikan Resi Pesanan Yang Valid
                                </div>
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
                                <button class='btn btn-primary' name='cek_order' type='submit'>check order</button>
                            </div>

                        </form><!-- End Custom Styled Validation -->

                    </div>
                </div>

                <!-- Start Ngoding Disini -->

                <div class='col-lg-12'>
                    <div class='card'>
                        <div class='card-body'>

                            <!-- Table with stripped rows -->
                            <table class='table table-hover'>
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

                                        <!-- Kolom untuk ikon edit dan delete -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    // Check if there are rows to fetch
                                    if (!empty($order)) {
                                        foreach ($order as $row) {
                                            // Display order details
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

                                    ?>


                                    <?php
                                            echo '</td>';

                                            echo '</tr>';
                                        }
                                    } else {
                                        echo "<tr><td colspan='10' style='color:red; font-size:smaller;' >input data resi terlebih dahulu!!</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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