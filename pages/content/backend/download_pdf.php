<?php
session_start();
require __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';
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
                img {
                    max-width: 100px; /* Sesuaikan ukuran gambar */
                    height: auto;
                }
            </style>
        </head>
        <body>
            <h2>Data Stok Barang</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Total Barang</th>
                       
                    </tr>
                </thead>
                <tbody>';

    // Menambahkan data stok barang ke HTML
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['nama_barang'] . '</td>';
        $html .= '<td>' . $row['kode_barang'] . '</td>';
        $html .= '<td>' . $row['total_barang'] . '</td>';
        // Menambahkan tag img untuk menampilkan gambar
       
        $html .= '</tr>';
    }

    // Menutup HTML
    $html .= '</tbody></table></body></html>';

    // Memuat HTML ke DOMPDF
    $dompdf->loadHtml($html);

    // Mengatur ukuran dan orientasi halaman
    $dompdf->setPaper('A4', 'landscape');

    // Proses rendering PDF (menghasilkan file)
    $dompdf->render();

    // Mengirimkan hasil ke browser untuk di-download
    $dompdf->stream('stok_barang.pdf', array('Attachment' => 0));

    exit();
} else {
    echo "Error mengambil data stok barang.";
}