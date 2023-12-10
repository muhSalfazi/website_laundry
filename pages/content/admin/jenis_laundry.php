<?php
session_start();

if ( $_SESSION[ 'role' ] != 'admin' ) {

    header( 'Location:../../../index.php' );
    exit(session_destroy());
}
?><?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath( dirname( __FILE__ ) . $ds . '../../../' ) . $ds;
require_once( "{$base_dir}pages{$ds}core{$ds}header.php" );
include( "{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php" );

?>

<main id='main' class='main'>
    <?php

function showAlert( $icon, $title, $message, $redirect = null ) {
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
                    " . ( $redirect ? "window.location.href = '$redirect';" : '' ) . "
                });
            });
        </script>
        ";
}
?>
    <!--create-->

    <?php

// mengecek di tambahkan
if ( isset( $_GET[ 'berhasil' ] ) ) {
    $berhasil = $_GET[ 'berhasil' ];
    if ( $berhasil === 'update_berhasil' ) {
        showAlert( 'success', 'Berhasil', 'Pengguna berhasil di tambahkan.' );
    }
}

?>

    <div class='pagetitle'>
        <h1>Jenis Laundry</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class='breadcrumb-item'><a href='../../content/User/stok_investaris'>Stok Investaris</a></li>
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
                            <i xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                class='bi bi-file-plus' viewBox='0 0 16 16'>
                                <path d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6' />
                                <path fill-rule='evenodd'
                                    d='M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5' />
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
                                        <th scope="col">jenis produk</th>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Nama Produk</th>
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
            echo "<td>" . $row['nama_jenis_laundry'] . "</td>";
            echo "<td>" . $row['kode_produk'] . "</td>";
            echo "<td>" . $row['nama_produk'] . "</td>";
 echo "<td>" . $row['harga_perkilo'] . "</td>";
            // Kolom aksi dengan ikon edit dan delete
            echo "<td class='text-center '>";
            echo "<a href='edit_pengguna.php' class='btn btn-warning btn-sm edit-btn' data-bs-toggle='modal' data-bs-target='#editModal' title='Edit'>
                    <i class='bi bi-pencil-fill'>edit</i>
                </a>";
            echo "<a href='#' class='btn btn-danger btn-sm delete-btn ml-2' data-bs-toggle='modal' data-bs-target='#deleteModal' title='Delete'>
                    <i class='bi bi-trash-fill'>delete</i>
                </a>";
            echo "</td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No data available</td></tr>";
    }

?>




                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Edit -->
                        <div class='modal fade' id='editModal' tabindex='-1' aria-labelledby='editModalLabel'
                            aria-hidden='true'>
                            <!-- Isi modal edit -->
                        </div>

                        <!-- Modal Delete -->
                        <div class='modal fade' id='deleteModal' tabindex='-1' aria-labelledby='deleteModalLabel'
                            aria-hidden='true'>
                            <!-- Isi modal delete -->
                        </div>

                        </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <!-- End Ngoding Disini -->

        </div>
    </section>

</main><!-- End #main -->

<?php
require_once( "{$base_dir}pages{$ds}core{$ds}footer.php" );
?>