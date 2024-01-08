<?php
session_start();
require __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';
include '../../core/connection.php';

// Periksa apakah jenis layanan, jenis laundry, dan formulir telah diisi
if (!isset($_POST['jenis_layanan']) || !isset($_POST['jenis_laundry']) || !isset($_POST['nama_produk'])) {
    // echo "Mohon lengkapi jenis layanan, jenis laundry, dan formulir!";

    echo "<script>window.location.href = '../pelanggan/order?add=tambah_gagal';</script>";
    exit();
}

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

    private function generateReceipt($nama_pelanggan, $jenis_laundry, $nama_produk, $kode_produk, $jenis_layanan, $layanan_antar, $created_at,)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isPhpEnabled', true);
        $pdfOptions->set('isFontSubsettingEnabled', true);

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($this->getReceiptHTML($nama_pelanggan, $jenis_laundry, $nama_produk, $kode_produk, $jenis_layanan, $layanan_antar, $created_at,));

        // (Opsional) Atur ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render HTML sebagai PDF
        $dompdf->render();

        //Keluarkan PDF yang dihasilkan ke Browser
        $outputFilename = __DIR__ . DIRECTORY_SEPARATOR . "path/to/save/Order_pesanan_De'UnguLaundry.pdf";
        
        // Sesuaikan jalurnya
        $dompdf->stream($outputFilename);
    }

    private function getReceiptHTML($nama_pelanggan, $jenis_laundry, $nama_produk, $kode_produk, $jenis_layanan, $layanan_antar, $created_at)
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

    .timestamp {
        text-align: right;
        color: #555;
        font-size: 0.8em;
    }

    .center-text {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class='receipt-container'>

        <h1 style='color: darkorchid'>De'UnguLaundry</h1>
        <div class="timestamp">
            <p><?php echo $created_at; ?></p>
        </div>
        <p class="text-center align-center">
            <strong>Terima kasih sudah menggunakan layanan ini</strong>
        </p>
        <p><strong>Nama Pelanggan:</strong> <?php echo $nama_pelanggan; ?></p>
        <p><strong>Jenis Layanan :</strong> <?php echo $jenis_layanan; ?></p>

        <p><strong>Jenis Laundry :</strong> <?php echo $jenis_laundry; ?></p>

        <p><strong>Kategori Laundry:</strong> <?php echo $nama_produk; ?></p>
        <p><strong>Resi Pesanan:</strong> <?php echo $kode_produk; ?></p>
        <p><strong>Jenis antar :</strong> <?php echo  $layanan_antar; ?></p>
        <br>
        <p class="center-text">
            Jika Anda menggunakan layanan antar, mohon bersabar untuk staff kami menjemput cucian kotor Anda.
            Kami harap untuk dibawa kembali sebagai bukti Anda sudah memesan di de'ungu laundry.
        </p>
    </div>

</body>

</html>
<?php
        return ob_get_clean();
    }


    public function addLaundry()
    {
        if (isset($_POST['submit'])) {
            $nama_pelanggan = isset($_POST['nama_pelanggan']) ? $this->filter($_POST['nama_pelanggan']) : '';
            $jenis_laundry = isset($_POST['jenis_laundry']) ? $this->filter($_POST['jenis_laundry']) : '';
            $no_telp = isset($_POST['no_telp']) ? $this->filter($_POST['no_telp']) : '';

            $nama_produk = isset($_POST['nama_produk']) ? $this->filter($_POST['nama_produk']) : '';
            $jenis_layanan = isset($_POST['jenis_layanan']) ? $this->filter($_POST['jenis_layanan']) : '';
            $layanan_antar = isset($_POST['layanan_antar']) ? $this->filter($_POST['layanan_antar']) : '';
            $alamat = isset($_POST['alamat']) ? $this->filter($_POST['alamat']) : '';

            $kode_produk = $this->generateResiNumber();
            $created_at = date('Y-m-d H:i:s', time());

            $tambah = 'INSERT INTO `order` (nama_pelanggan, jenis_laundry, jenis_layanan,no_telp, nama_produk, resi_pesanan, layanan_antar, alamat, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

            $stmt = mysqli_prepare($this->db_connect, $tambah);

            if (!$stmt) {
                // Periksa kesalahan persiapan pernyataan
                die('Error in prepare statement: ' . mysqli_error($this->db_connect));
            }

            mysqli_stmt_bind_param($stmt, 'sssssssss', $nama_pelanggan, $jenis_laundry, $jenis_layanan, $no_telp, $nama_produk, $kode_produk, $layanan_antar, $alamat, $created_at);
            $jenis = mysqli_stmt_execute($stmt);

            if ($jenis) {
                // Hasilkan tanda terima
                $this->generateReceipt($nama_pelanggan, $jenis_laundry, $nama_produk, $kode_produk, $jenis_layanan, $layanan_antar, $created_at,);

                echo "<script>window.location.href = '../pelanggan/order?add=tambah_berhasil';</script>";
            } else {
                // Tampilkan kesalahan eksekusi
                header('Location: ../../../pages-error-404.html');
                exit();
            }

            mysqli_stmt_close($stmt);
            mysqli_close($this->db_connect);
        } else {
            header('Location: ../../../pages-error-404.html');
            exit();
        }
    }
}

// Usage
$laundryProduct = new LaundryProduct($db_connect);
$laundryProduct->addLaundry();
?>