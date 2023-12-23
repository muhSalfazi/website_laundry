<?php
include '../../core/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_jenis_laundry'])) {
    // Ambil data yang dikirimkan dari formulir pengeditan
    $id_jenis_laundry = $_POST['id_jenis_laundry'];
    $nama_jenis_laundry = $_POST['nama_jenis_laundry'];
    $nama_produk = $_POST['nama_produk'];
    $harga_perkilo = $_POST['harga_perkilo'];
    echo
        // Update data pelanggan di database
        $query = "UPDATE jenis_laundry SET nama_jenis_laundry = '$nama_jenis_laundry ', nama_produk = '$nama_produk', harga_perkilo = '$harga_perkilo',edit_at = NOW() WHERE id_jenis_laundry = $id_jenis_laundry";

    if (mysqli_query($db_connect, $query)) {
        // Redirect ke halaman data pelanggan dengan pesan berhasil
        header('Location: ../admin/jenis_laundry.php?berhasil=update_berhasil');
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo 'Error updating record: ' . mysqli_error($db_connect);
    }
} else {
    header( 'Location: ../../../pages-error-404.html' );
    exit();
}