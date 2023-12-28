<?php
session_start();
require __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';
include '../../core/connection.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class LaundryProduct
{
    private $db_connect;

    public function __construct($db_connect)
    {
        $this->db_connect = $db_connect;
    }

    private function filter($teks)
    {
        $teks = addslashes($teks);
        return htmlspecialchars($teks);
    }

    private function generateResiNumber()
    {


        $tanda2 = '.';
        $randomnoresi = chr(mt_rand(65, 90)) . chr(mt_rand(65, 90));
        $timestamp = time();

        $resiNumber = $randomnoresi . $tanda2 . $timestamp;

        return $resiNumber;
    }

    private function generateReceipt($nama_pelanggan, $jenis_laundry, $nama_produk, $kode_produk, $jenis_layanan, $created_at)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isPhpEnabled', true);
        $pdfOptions->set('isFontSubsettingEnabled', true);

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($this->getReceiptHTML($nama_pelanggan, $jenis_laundry, $nama_produk, $kode_produk, $jenis_layanan, $created_at));

        // ( Optional ) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $outputFilename = __DIR__ . DIRECTORY_SEPARATOR . "path/to/save/Order_pesanan_De'UnguLaundry.pdf";
        // Adjust the path accordingly
        $dompdf->stream($outputFilename);
    }

    private function getReceiptHTML($nama_pelanggan, $jenis_laundry, $nama_produk, $kode_produk, $jenis_layanan, $created_at)
    {
        ob_start();
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>De'Ungu Laundry</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f0f0;
    }

    .receipt-container {
        width: 80%;
        margin: 20px auto;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    p {
        margin: 10px 0;
        color: #555;
    }

    strong {
        color: #333;
    }
    </style>
</head>

<body>
    <div class='receipt-container'>
        <p><strong>Tanggal Order</strong> <?php echo $created_at;
                                                    ?></p>
        <h1 style='color:darkorchid'>De'UnguLaundry</h1>

        <p class="tex-center align-center">
            <b>Terima kasih sudah menggunakan layanan ini</b>
        </p>
        <p><strong>Nama Pelanggan</strong> <?php echo $nama_pelanggan;
                                                    ?></p>
        <p><strong>Jenis Laundry</strong> <?php echo $jenis_laundry;
                                                    ?></p>
        <p><strong>Kategori Laundry</strong> <?php echo $nama_produk;
                                                        ?></p>
        <p><strong>Resi Pesanan:</strong> <?php echo $kode_produk;
                                                    ?></p>

        <p>jika anda menggunakan layanan antar mohon bersabar untuk staff kami menjemput cucian kotor anda
        </p>
        kami harap untuk di bawa kembali sebagai bukti anda sudah memesan
        di<b>DE'Ungu Laundry</b>
        <p></p>

    </div>
</body>

</html>
<?php
        return ob_get_clean();
    }

    public function addLaundrycuci_setrika()
    {
        if (isset($_POST['submit'])) {
            $nama_pelanggan = isset($_POST['nama_pelanggan']) ? $this->filter($_POST['nama_pelanggan']) : '';
            $jenis_laundry = isset($_POST['jenis_laundry']) ? $this->filter($_POST['jenis_laundry']) : '';
            $no_telp = isset($_POST['no_telp']) ? $this->filter($_POST['no_telp']) : '';

            $nama_produk = isset($_POST['nama_produk']) ? $this->filter($_POST['nama_produk']) : '';
            $jenis_layanan = isset($_POST['layanan_antar']) ? $this->filter($_POST['layanan_antar']) : '';
            $alamat = isset($_POST['alamat']) ? $this->filter($_POST['alamat']) : '';

            $kode_produk = $this->generateResiNumber();
            $created_at = date('Y-m-d H:i:s', time());

            $tambah = 'INSERT INTO cuci_setrika (nama_pelanggan, jenis_laundry,no_telp, nama_produk, resi_pesanan, layanan_antar, alamat, created_at) VALUES (?, ?, ?, ?, ?, ?, ?,?)';
            $stmt = mysqli_prepare($this->db_connect, $tambah);

            if (!$stmt) {
                // Periksa kesalahan persiapan pernyataan
                die('Error in prepare statement: ' . mysqli_error($this->db_connect));
            }

            mysqli_stmt_bind_param($stmt, 'ssssssss', $nama_pelanggan, $jenis_laundry,$no_telp, $nama_produk, $kode_produk, $jenis_layanan, $alamat, $created_at);
            $jenis = mysqli_stmt_execute($stmt);

            if ($jenis) {
                // Generate receipt
                $this->generateReceipt($nama_pelanggan, $jenis_laundry, $nama_produk, $kode_produk, $jenis_layanan, $created_at);

                echo "<script>window.location.href = '../admin/jenis_laundry.php?add=tambah_berhasil';</script>";
            } else {
                // Tampilkan kesalahan eksekusi
                die('Error in execute statement: ' . mysqli_error($this->db_connect));
            }

            mysqli_stmt_close($stmt);
            mysqli_close($this->db_connect);
        } else {
            header('Location: ../../../pages-error-404.html');
        }
    }
}

// Usage
$laundryProduct = new LaundryProduct($db_connect);
$laundryProduct->addLaundrycuci_setrika();
?>