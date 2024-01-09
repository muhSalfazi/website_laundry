<?php
include '../../core/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_order'])) {
    // Ambil data yang dikirimkan dari formulir pengeditan
    $id_order = $_POST['id_order'];
    $total_harga = $_POST['total_harga'];
    $proses_laundry = $_POST['proses_laundry'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    // Update data pesanan di database
    $query = "UPDATE `order` SET total_harga = '$total_harga', proses_laundry = '$proses_laundry', status_pembayaran = '$status_pembayaran', jumlah_bayar = '$jumlah_bayar' WHERE id_order = $id_order";

    if (mysqli_query($db_connect, $query)) {
        // Redirect ke halaman data pesanan dengan pesan berhasil
        header('Location: ../admin/data_pesanan.php?berhasil=update_berhasil');
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo 'Error updating record: ' . mysqli_error($db_connect);
    }
} else {
    header('Location: ../../../pages-error-404.html');
    exit();
}