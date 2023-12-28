<?php
session_start();
require __DIR__ . DIRECTORY_SEPARATOR . '../../core/connection.php';

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

    public function addLaundryProduct()
    {
        if (isset($_POST['submit'])) {
            $nama_jenis = isset($_POST['nama_jenis_laundry']) ? $this->filter($_POST['nama_jenis_laundry']) : '';
            $nama_produk = isset($_POST['nama_produk']) ? $this->filter($_POST['nama_produk']) : '';
            $harga = isset($_POST['harga_perkilo']) ? $this->filter($_POST['harga_perkilo']) : '';
            $jenis_layanan = isset($_POST['jenis_layanan']) ? $this->filter($_POST['jenis_layanan']) : '';

            $created_at = date('Y-m-d H:i:s', time());

            $tambah = 'INSERT INTO jenis_laundry (nama_jenis_laundry,jenis_layanan, nama_produk, harga_perkilo, created_at) VALUES (?, ?, ?, ?, ?)';
            $stmt = mysqli_prepare($this->db_connect, $tambah);

            if (is_numeric($harga)) {
                mysqli_stmt_bind_param($stmt, 'ssdss', $nama_jenis, $jenis_layanan, $nama_produk, $harga,  $created_at);
                $jenis = mysqli_stmt_execute($stmt);


                if ($jenis) {
                    echo "<script>window.location.href = '../admin/jenis_laundry.php?add=tambah_berhasil';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan jenis produk');</script>";
                }
            } else {
                echo "<script>alert('Harga harus berupa angka');</script>";
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
$laundryProduct->addLaundryProduct();
