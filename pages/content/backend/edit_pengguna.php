<?php
include'../../core/connection.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' && isset( $_POST[ 'id_pelanggan' ] ) ) {
    // Ambil data yang dikirimkan dari formulir pengeditan
    $id_pelanggan = $_POST[ 'id_pelanggan' ];
    $nama_lengkap = $_POST[ 'nama_lengkap' ];
    $no_telp = $_POST[ 'no_telp' ];
    $alamat = $_POST[ 'alamat' ];

    // Update data pelanggan di database
    $query = "UPDATE pelanggan SET nama_lengkap = '$nama_lengkap', no_telp = '$no_telp', alamat = '$alamat' WHERE id_pelanggan = $id_pelanggan";

    if ( mysqli_query( $db_connect, $query ) ) {
        // Redirect ke halaman data pelanggan dengan pesan berhasil
        header( 'Location: ../admin/Pengguna.php?berhasil=update_berhasil' );
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo 'Error updating record: ' . mysqli_error( $db_connect );
    }
} else {
    // Jika request bukan POST, kembalikan ke halaman sebelumnya
    header( 'Location:../admin/Pengguna.php' );
    exit();
}