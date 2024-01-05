<?php
require '../../core/connection.php';


class Barang
{
    protected $db_connect;

    public function __construct($db_connect)
    {
        $this->db_connect = $db_connect;
    }

    protected function generateResiNumber()
    {
        $prefix = 'Barang_';
        $randomNumbers = mt_rand(1000, 9999);
        $titik = '.';
        $randomnoresi = chr(mt_rand(65, 90)) . chr(mt_rand(65, 90)) . chr(mt_rand(65, 90));
        $titik = '.';
        $timestamp = time();

        return $prefix . $randomNumbers . $titik . $randomnoresi . $titik . $timestamp;
    }
}

class StokBarang extends Barang
{
    protected function generateRandomFilename($image)
    {
        return time() . '-' . md5(rand()) . '-' . $image;
    }

    // Fungsi untuk memeriksa dan membuat direktori 'upload'
    protected function createUploadDirectory()
    {
        $uploadDirectory = __DIR__ . '/../upload/';

        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }
    }

    public function addBarang($nama, $total, $image, $kode_barang)
    {
        $randomFilename = $this->generateRandomFilename($image);
        $this->createUploadDirectory();
        // Memeriksa dan membuat direktori 'upload'
        $uploadDir = __DIR__ . '/../upload/';
        $uploadPath = $uploadDir . basename($randomFilename);
        $tempImage = $_FILES['image']['tmp_name'];
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $upload = move_uploaded_file($tempImage, $uploadPath);
        $created_at = date('Y-m-d H:i:s', time());
        if ($_FILES['image']['size'] > 0) {
            if ($upload) {
                $resiNumber = $this->generateResiNumber();

                mysqli_query($this->db_connect, "INSERT INTO stok_barang (nama_barang, kode_barang, total_barang, image, created_at)
            VALUES ('$nama', '$resiNumber', '$total', 'upload/$randomFilename', '$created_at')");

                echo "<script>window.location.href = '../admin/stok_investaris.php?berhasil=add_berhasil';</script>";
            } else {
                header('Location: ../../core/pages-error-404.html');
                exit();
            }
        }
    }
}

$stokBarangObj = new StokBarang($db_connect);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_barang'];
    $total = $_POST['total_barang'];
    $image = $_FILES['image']['name'];
    $kode_barang = $_POST['kode_barang'];

    $stokBarangObj->addBarang($nama, $total, $image, $kode_barang);
}