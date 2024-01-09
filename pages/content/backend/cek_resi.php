<?php

// Inisialisasi variabel $order
$order = array();


if (isset($_POST['cek_order'])) {
    $resi_pesanan = $_POST['resi_pesanan'];

    $query = "SELECT * FROM `order` WHERE resi_pesanan = ?";
    $stmt = $db_connect->prepare($query);
    $stmt->bind_param('s', $resi_pesanan);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {

        $order = $result->fetch_all(MYSQLI_ASSOC);
    } else {

        $error_message = "Resi Pesanan tidak terdaftar.";
    }
}