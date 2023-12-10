<?php
include '../../core/connection.php';
//data total_pelanggan
$query = 'SELECT COUNT(id_pelanggan) AS total_pelanggan FROM pelanggan';
$result = mysqli_query( $db_connect, $query );
$data_pelanggan = mysqli_fetch_assoc( $result );
///
// Format data sebagai JSON
$response = [
    'total_pelanggan' => $data_pelanggan[ 'total_pelanggan' ],
];

// Keluarkan sebagai JSON
echo json_encode( $response );
?>