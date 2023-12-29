<?php

// delete.php

include '../../core/connection.php';

class DataDeleter
{
    protected $db_connect;

    public function __construct($db_connect)
    {
        $this->db_connect = $db_connect;
    }

    public function deletePelanggan($id_pelanggan)
    {
        $result = mysqli_query($this->db_connect, "DELETE FROM pelanggan WHERE id_pelanggan = $id_pelanggan");

        return $result;
    }

    public function deleteJenisLaundry($id_jenis_laundry)
    {
        $result = mysqli_query($this->db_connect, "DELETE FROM jenis_laundry WHERE id_jenis_laundry = $id_jenis_laundry");

        return $result;
    }

    public function deleteStokBarang($id_stok_barang)
    {
        $result = mysqli_query($this->db_connect, "DELETE FROM stok_barang WHERE id_stok_barang = $id_stok_barang");

        return $result;
    }
    public function deleteorder_pesanan($id_order)
    {
        $result = mysqli_query($this->db_connect, "DELETE FROM `order` WHERE id_order = $id_order");

        return $result;
    }
}

// Usage
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_pelanggan'])) {
    $id_pelanggan = $_GET['id_pelanggan'];

    $dataDeleter = new DataDeleter($db_connect);
    $result = $dataDeleter->deletePelanggan($id_pelanggan);

    if ($result) {
        header("Location: ../admin/pelanggan.php?hapus=berhasil_dihapus");
    } else {
        header('Location: ../../../pages-error-404.html');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_jenis_laundry'])) {
    $id_jenis_laundry = $_GET['id_jenis_laundry'];

    $dataDeleter = new DataDeleter($db_connect);
    $result = $dataDeleter->deleteJenisLaundry($id_jenis_laundry);

    if ($result) {
        header("Location: ../admin/jenis_laundry.php?hapus=berhasil_dihapus");
    } else {
        header('Location: ../../../pages-error-404.html');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_stok_barang'])) {
    $id_stok_barang = $_GET['id_stok_barang'];

    $dataDeleter = new DataDeleter($db_connect);
    $result = $dataDeleter->deleteStokBarang($id_stok_barang);

    if ($result) {
        header("Location: ../admin/stok_barang.php?hapus=berhasil_dihapus");
    } else {
        header('Location: ../../../pages-error-404.html');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];

    $dataDeleter = new DataDeleter($db_connect);
    $result = $dataDeleter->deleteorder_pesanan($id_order);

    if ($result) {
        header("Location: ../admin/data_pesanan?hapus=berhasil_dihapus");
    } else {
        header('Location: ../../../pages-error-404.html');
    }
} else {
    echo "Invalid request.";
}
