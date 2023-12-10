<?php
date_default_timezone_set( 'Asia/Jakarta' );
//Atur zona waktu di PHP

$DBHOST = 'localhost';
$DBUSER = 'root';
$DBPASSWORD = '';
$DBNAME = 'db_laundry';

$db_connect = mysqli_connect( $DBHOST, $DBUSER, $DBPASSWORD, $DBNAME );

if ( mysqli_connect_errno() ) {
    echo 'failed connect to mysql ' . mysqli_connect_error();
}
?>