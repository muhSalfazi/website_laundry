<?php
// delete.php

include '../../core/connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_pelanggan'])) {
    $pelanggan = $_GET['id_pelanggan'];


    $result = mysqli_query($db_connect, "DELETE FROM pelanggan WHERE id_pelanggan = $pelangan");

    if ($result) {
        header("Location: ../admin/pengguna.php?hapus=berhasi_dihapus");
       
    } else {
        header("Location: ../admin/pengguna.php?gagal=hapus_gagal");
    }
} else {
    echo "Invalid request.";
}