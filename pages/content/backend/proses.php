<?php

include '../../core/connection.php';

class DataFetcher {
    private $db_connect;

    public function __construct( $db_connect ) {
        $this->db_connect = $db_connect;
    }

    public function getListUser() {
        $queryGetListUser = mysqli_query( $this->db_connect, 'SELECT id_pelanggan,nama_lengkap, no_telp, alamat FROM pelanggan' );

        if ( !$queryGetListUser ) {
            $message = 'Kesalahan Terjadi Pada Proses Pengambilan Data User';
            echo '<body>' . $message . '</body>';
        }

        return $queryGetListUser;
    }

    public function getJenisLaundry() {
        $jenisLaundry = mysqli_query( $this->db_connect, 'SELECT nama_jenis_laundry, nama_produk, harga_perkilo, kode_produk, created_at FROM jenis_laundry' );

        if ( !$jenisLaundry ) {
            $message = 'Kesalahan Terjadi Pada Proses Pengambilan Data jenis laundry';
            echo '<body>' . $message . '</body>';
        }

        return $jenisLaundry;
    }

    public function getStokBarang() {
        $stokBarang = mysqli_query( $this->db_connect, 'SELECT nama_barang, kode_barang, total_barang, image FROM stok_barang' );

        if ( !$stokBarang ) {
            $message = 'Kesalahan Terjadi Pada Proses Pengambilan Data barang';
            echo '<body>' . $message . '</body>';
        }

        return $stokBarang;
    }
}

//proses
$dataFetcher = new DataFetcher( $db_connect );

// Get List User
$listUser = $dataFetcher->getListUser();

// Get Jenis Laundry
$jenisLaundry = $dataFetcher->getJenisLaundry();

// Get Stok Barang
$stokBarang = $dataFetcher->getStokBarang();