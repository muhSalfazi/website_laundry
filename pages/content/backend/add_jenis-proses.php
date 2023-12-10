<?php
session_start();
require __DIR__ . DIRECTORY_SEPARATOR . '../../core/connection.php';

class LaundryProduct
 {
    private $db_connect;

    public function __construct( $db_connect )
 {
        $this->db_connect = $db_connect;
    }

    private function filter( $teks )
 {
        $teks = addslashes( $teks );
        return htmlspecialchars( $teks );
    }

    private function generateResiNumber()
 {
        $prefix = "De'Ungu_";
        $tanda2 = '_';
        $randomnoresi = chr( mt_rand( 65, 90 ) ) . chr( mt_rand( 65, 90 ) );
        $timestamp = time();

        $resiNumber = $prefix . $randomnoresi . $tanda2 . $timestamp;

        return $resiNumber;
    }

    public function addLaundryProduct()
 {
        if ( isset( $_POST[ 'submit' ] ) ) {
            $nama_jenis = isset( $_POST[ 'nama_jenis_laundry' ] ) ? $this->filter( $_POST[ 'nama_jenis_laundry' ] ) : '';
            $nama_produk = isset( $_POST[ 'nama_produk' ] ) ? $this->filter( $_POST[ 'nama_produk' ] ) : '';
            $harga = isset( $_POST[ 'harga_perkilo' ] ) ? $this->filter( $_POST[ 'harga_perkilo' ] ) : '';

            $kode_produk = $this->generateResiNumber();
            $created_at = date( 'Y-m-d H:i:s', time() );

            $tambah = 'INSERT INTO jenis_laundry (nama_jenis_laundry, nama_produk, harga_perkilo, kode_produk, created_at) VALUES (?, ?, ?, ?, ?)';
            $stmt = mysqli_prepare( $this->db_connect, $tambah );

            if ( is_numeric( $harga ) ) {
                mysqli_stmt_bind_param( $stmt, 'ssdss', $nama_jenis, $nama_produk, $harga, $kode_produk, $created_at );
                $jenis = mysqli_stmt_execute( $stmt );

                if ( $jenis ) {
                    echo "<script>alert('Jenis produk berhasil ditambahkan'); window.location.href = '../User/jenis_laundry.php?berhasil=update_berhasil';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan jenis produk');</script>";
                }
            } else {
                echo "<script>alert('Harga harus berupa angka');</script>";
            }

            mysqli_stmt_close( $stmt );
            mysqli_close( $this->db_connect );
        } else {
            echo "<h1>Data tidak valid</h1><br/><a href='add_pengguna'>Kembali ke form</a>";
        }
    }
}

// Usage
$laundryProduct = new LaundryProduct( $db_connect );
$laundryProduct->addLaundryProduct();
?>