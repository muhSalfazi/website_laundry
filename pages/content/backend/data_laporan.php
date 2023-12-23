<?php
include '../../core/connection.php';

// Data total_pelanggan
$queryPelanggan = 'SELECT COUNT(id_pelanggan) AS total_pelanggan FROM pelanggan';
$resultPelanggan = mysqli_query($db_connect, $queryPelanggan);
$dataPelanggan = mysqli_fetch_assoc($resultPelanggan);

// Data total_pesanan
$queryPesanan = 'SELECT COUNT(id_order) AS total_pesanan FROM `order`'; // Assuming your order table is named `order`
$resultPesanan = mysqli_query($db_connect, $queryPesanan);
$dataPesanan = mysqli_fetch_assoc($resultPesanan);

// Format data sebagai JSON
$response = [
    'total_pelanggan' => $dataPelanggan['total_pelanggan'],
    'total_pesanan' => $dataPesanan['total_pesanan'],
];

// Keluarkan sebagai JSON
echo json_encode($response);
