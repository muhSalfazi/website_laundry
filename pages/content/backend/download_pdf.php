<?php
session_start();

// Cek apakah pengguna memiliki hak akses admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../../../pages-error-404.html');
    exit();
}

// Memuat konfigurasi dan vendor/autoload
require_once '../../core/config.php';
require __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';

// Memuat koneksi database
include '../../core/connection.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Mengambil data stok barang
$query = "SELECT * FROM stok_barang";
$result = mysqli_query($db_connect, $query);

if ($result) {
    // Setup DOMPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    //mengatur image
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    // HTML content untuk PDF
    $html = '
        <html>
        <head>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }
            </style>
        </head>
        <body>
            <h2>Data Stok Inventaris</h2>
            <table>
                <thead>
                    <tr >
                        <th  class="text-center">Nama Barang</th>
                        <th  class="text-center">Kode Barang</th>
                        <th  class="text-center">Gambar Produk</th>
                        <th  class="text-center">Jumlah barang</th>
                    </tr>
                </thead>
                <tbody>';

    // Menambahkan data stok barang ke HTML
    while ($row = mysqli_fetch_assoc($result)) {
        // Menghasilkan path gambar secara dinamis
        $imagePath = BASEURL . '/coding_web/project_smstr3/pages/content/' . $row['image'];

        $html .= '<tr>';
        $html .= '<td  class="text-center">' . $row['nama_barang'] . '</td>';
        $html .= '<td  class="text-center">' . $row['kode_barang'] . '</td>';
        $html .= '<td  class="text-center"><img src="' . $imagePath . '" alt="Gambar" style="max-width: 100px; height: auto;"></td>';
        $html .= '<td  class="text-center">' . $row['total_barang'] . '</td>';
        $html .= '</tr>';
    }

    // Menutup HTML
    $html .= '</tbody>
            </table>
        </body>
        </html>';

    // Memuat HTML ke DOMPDF
    $dompdf->loadHtml($html);

    // Mengatur ukuran dan orientasi halaman
    $dompdf->setPaper('A4', 'landscape');

    // Proses rendering PDF (menghasilkan file)
    $dompdf->render();

    // Mengirimkan hasil ke browser untuk di-download
    $dompdf->stream('stok_barang.pdf', array('Attachment' => 0));

    // Menutup koneksi database
    mysqli_close($db_connect);

    exit();
} else {
    header('Location: ../../../pages-error-404.html');
    exit();
}
