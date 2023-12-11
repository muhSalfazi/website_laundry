<?php
session_start();
if ( $_SESSION[ 'role' ] != 'admin' ) {

    header( 'Location:../../../index.php' );
    exit( session_destroy() );
}
?><?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath( dirname( __FILE__ ) . $ds . '../../../' ) . $ds;
require_once( "{$base_dir}pages{$ds}core{$ds}header.php" );
include( "{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php" );

?>

<main id='main' class='main'>

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
                            <i xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                class='bi bi-file-plus' viewBox='0 0 16 16'>
                                <path d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6' />
                                <path fill-rule='evenodd'
                                    d='M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5' />
                            </i>
                            Add Barang
                        </a>

                        <!-- Small Modal -->

                        <p>Data ini terdiri dari semua stok barang laundry yang tersedia dalam aplikasi. <b>De'Ungu
                                Laundry</b>.</p>
                        <!--table reponsif-->
                        <div class=" table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>

                                        <th scope="col">No</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Total Barang</th>
                                        <th scope="col">Gambar Barang</th>
                                        <th scope="col">opsi</th>
                                        <!-- Kolom untuk ikon edit dan delete -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

    $no = 0;
    // Check if there are rows to fetch
    if (mysqli_num_rows($stokBarang ) > 0) {
        while ($row = mysqli_fetch_array($stokBarang )) {
            $no++;
            echo "<tr>";
            echo "<th scope='row'>" . $no . "</th>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>" . $row['kode_barang'] . "</td>";
            echo "<td>" . $row['total_barang'] . "</td>";
 echo "<td><a href='" . $row['image'] . "' target='_blank'>Unduh</a></td>";
            // Kolom aksi dengan ikon edit dan delete
            echo "<td class='text-center '>";
                                        echo "<a class='btn btn-warning btn-sm edit-btn' data-bs-toggle='modal' data-bs-target='#smallModal" . $no . "'>
                                        <i class='bi bi-pencil-fill'>edit</i>
                                        </a>";
            echo "<a href='#' class='btn btn-danger btn-sm delete-btn ml-2' data-bs-toggle='modal' data-bs-target='#deleteModal' title='Delete'>
                    <i class='bi bi-trash-fill'>delete</i>
                </a>";
            echo "</td>";
  // Modal Edit untuk setiap data
  echo "<div class='modal fade' id='smallModal" . $no . "' tabindex='-1'>";
  echo "<div class='modal-dialog modal-sm'>";
  echo "<div class='modal-content'>";
  echo "<div class='modal-header'>";
  echo "<h5 class='modal-title'>Edit Pelanggan</h5>";
  echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
  echo "</div>";

  // Ambil data pengguna berdasarkan ID
  $id_pelanggan = $row['id_pelanggan'];
  $result = mysqli_query($db_connect, "SELECT * FROM pelanggan WHERE id_pelanggan = $id_pelanggan");

  if ($result) {
      $pelanggan = mysqli_fetch_assoc($result);

      // Formulir Edit
      echo "<div class='modal-body'>";
      echo "<form action='../backend/edit_pengguna.php' method='POST'>";
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
            echo "</tr>";
            
  }
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

            <!-- End Ngoding Disini -->

        </div>
    </section>

</main><!-- End #main -->

<?php
require_once( " {
    $base_dir}
    pages {
        $ds}
        core {
            $ds}
            footer.php" );
            ?>