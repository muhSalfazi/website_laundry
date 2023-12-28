<?php

include '../../core/connection.php';

function filter($text)
{
    $text = addslashes($text);
    return htmlspecialchars($text);
}

class DataFetcher
{
    private $db_connect;

    public function __construct($db_connect)
    {
        $this->db_connect = $db_connect;
    }

    public function getListUser()
    {
        $queryGetListUser = mysqli_query($this->db_connect, 'SELECT id_pelanggan,nama_lengkap, no_telp, alamat FROM pelanggan');

        if (!$queryGetListUser) {
            $message = 'Kesalahan Terjadi Pada Proses Pengambilan Data User';
            echo '<body>' . $message . '</body>';
        }

        return $queryGetListUser;
    }

    public function getJenisLaundry()
    {
        $jenisLaundry = mysqli_query($this->db_connect, 'SELECT id_jenis_laundry, nama_jenis_laundry, nama_produk, harga_perkilo, created_at,jenis_layanan FROM jenis_laundry');

        if (!$jenisLaundry) {
            header('Location: ../../../pages-error-404.html');
        }

        return $jenisLaundry;
    }

    public function getStokBarang()
    {
        $stokBarang = mysqli_query($this->db_connect, 'SELECT id_stok_barang, nama_barang, kode_barang, total_barang, image FROM stok_barang');

        if (!$stokBarang) {
            header('Location: ../../../pages-error-404.html');
        }

        return $stokBarang;
    }

    public function getpesananlaundry()
    {
        $order = mysqli_query($this->db_connect, 'SELECT id_order, nama_pelanggan, jenis_layanan,jenis_laundry,stasus_pembayaran,resi_pesanan, proses_laundry, total_harga ,jumlah_kilo,alamat,layanan_antar FROM `order`');

        if (!$order) {
            die('Location: ../../../pages-error-404.html ' . mysqli_error($this->db_connect));
        }

        return $order;
    }
}

//proses
$dataFetcher = new DataFetcher($db_connect);

// Get List User
$listUser = $dataFetcher->getListUser();

// Get Jenis Laundry
$jenisLaundry = $dataFetcher->getJenisLaundry();

// Get Stok Barang
$stokBarang = $dataFetcher->getStokBarang();

$order = $dataFetcher->getpesananlaundry();
