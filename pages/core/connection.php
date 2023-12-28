<?php

date_default_timezone_set('Asia/Jakarta');

$DBHOST = 'localhost';
$DBUSER = 'root';
$DBPASSWORD = '';
$DBNAME = 'db_laundry';

$db_connect = mysqli_connect($DBHOST, $DBUSER, $DBPASSWORD, $DBNAME);

if (!$db_connect) {
    // Menggunakan mysqli_connect_errno() untuk mendapatkan kode kesalahan koneksi
    $error_code = mysqli_connect_errno();
    // Menggunakan mysqli_connect_error() untuk mendapatkan pesan kesalahan koneksi
    $error_message = mysqli_connect_error();

    header('Location: ../../../pages-error-404.html');
    exit();
}
