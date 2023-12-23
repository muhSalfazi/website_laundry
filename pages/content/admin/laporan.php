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
        <h1>Laporan</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='../../content/dashboard/dashboard'>Home</a></li>
                <li class=' breadcrumb-item active'>Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>
        <div class='row'>

            <!-- Start Ngoding Disini -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pelanggan & Pesanan</h5>

                        <!-- Doughnut Chart -->
                        <canvas id="doughnutChart" style="max-height: 400px;"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            // Fungsi untuk mendapatkan data dari PHP
                            async function fetchData() {
                                const response = await fetch('../backend/data_laporan.php');
                                const data = await response.json();

                                // Update data pada grafik
                                chart.data.datasets[0].data = [data.total_pelanggan, data.total_pesanan];

                                // Mengupdate grafik
                                chart.update();
                            }

                            // Inisialisasi Chart.js
                            const chart = new Chart(document.querySelector('#doughnutChart'), {
                                type: 'doughnut',
                                data: {
                                    labels: ['Pelanggan', 'Pesanan'],
                                    datasets: [{
                                        data: [0, 0], // Data akan diisi oleh fetchData()
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)'
                                        ],
                                        hoverOffset: 4
                                    }]
                                }
                            });

                            // Panggil fetchData() untuk mengisi data awal
                            fetchData();

                            // Atur interval untuk mengupdate data setiap bulan
                            setInterval(() => {
                                fetchData();
                            }, 30 * 24 * 60 * 60 * 1000); // 30 hari
                        });
                        </script>

                        <!-- End Doughnut CHart -->

                    </div>
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