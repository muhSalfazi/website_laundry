<?php
require '../../core/connection.php';

class Barang
 {
    protected $db_connect;

    public function __construct( $db_connect )
 {
        $this->db_connect = $db_connect;
    }

    protected function generateResiNumber()
 {
        $prefix = 'Barang_';
        $randomNumbers = mt_rand( 1000, 9999 );
        $titik = '.';
        $randomnoresi = chr( mt_rand( 65, 90 ) ) . chr( mt_rand( 65, 90 ) ) . chr( mt_rand( 65, 90 ) );
        $titik = '.';
        $timestamp = time();

        return $prefix . $randomNumbers . $titik . $randomnoresi . $titik . $timestamp;
    }
}

class StokBarang extends Barang
 {
    public function addBarang( $nama, $total, $image, $kode_barang )
 {
        $randomFilename = time() . '-' . md5( rand() ) . '-' . $image;
        $uploadDirectory = $_SERVER[ 'DOCUMENT_ROOT' ] . '/upload/';

        if ( !file_exists( $uploadDirectory ) ) {
            mkdir( $uploadDirectory, 0777, true );
        }

        $uploadPath = $uploadDirectory . $randomFilename;
        $tempImage = $_FILES[ 'image' ][ 'tmp_name' ];

        $upload = move_uploaded_file( $tempImage, $uploadPath );
        $created_at = date( 'Y-m-d H:i:s', time() );

        if ( $upload ) {
            $resiNumber = $this->generateResiNumber();

            mysqli_query( $this->db_connect, "INSERT INTO stok_barang (nama_barang, kode_barang, total_barang, image, created_at)
                VALUES ('$nama', '$resiNumber', '$total', '/upload/$randomFilename', '$created_at')" );

            echo "<script>alert('Jenis barang berhasil ditambahkan'); window.location.href = '../User/stok_barang.php?berhasil=update_berhasil';</script>";
        } else {
            header( 'Location: ../User/add_barang.php?berhasil=input_gagal' );
        }
    }
}

// Usage
$stokBarangObj = new StokBarang( $db_connect );

if ( isset( $_POST[ 'submit' ] ) ) {
    $nama = $_POST[ 'nama_barang' ];
    $total = $_POST[ 'total_barang' ];
    $image = $_FILES[ 'image' ][ 'name' ];
    $kode_barang = $_POST[ 'kode_barang' ];

    $stokBarangObj->addBarang( $nama, $total, $image, $kode_barang );
}
?>