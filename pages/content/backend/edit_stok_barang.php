<?php

include '../../core/connection.php';

class StokBarangUpdater
{
    protected $db_connect;

    public function __construct($db_connect)
    {
        $this->db_connect = $db_connect;
    }

    protected function generateRandomFilename($image)
    {
        return time() . '-' . md5(rand()) . '-' . $image;
    }

    public function updateBarang($id_stok_barang, $nama_barang, $total_barang, $tempImage)
    {
        $uploadDir = __DIR__ . '/../upload/';
        $randomFilename = $this->generateRandomFilename($_FILES['image']['name']);

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if ($_FILES['image']['size'] > 0) {
            $uploadPath = $uploadDir . $randomFilename;

            if (move_uploaded_file($tempImage, $uploadPath)) {
                $oldImageQuery = mysqli_query($this->db_connect, "SELECT image FROM stok_barang WHERE id_stok_barang = $id_stok_barang");
                $oldImagePath = mysqli_fetch_assoc($oldImageQuery)['image'];

                // Hapus gambar lama setelah pembaruan berhasil
                if ($oldImagePath && file_exists(__DIR__ . "/../$oldImagePath")) {
                    unlink(__DIR__ . "/../$oldImagePath");
                }

                mysqli_query($this->db_connect, "UPDATE stok_barang SET nama_barang = '$nama_barang', total_barang = '$total_barang', image = 'upload/$randomFilename', edit_at = NOW() WHERE id_stok_barang = $id_stok_barang");

                header('Location: ../admin/stok_investaris.php?berhasil=edit_berhasil');
                exit();
            } else {
                header('Location: ../admin/stok_investaris.php?error=upload_gagal');
                exit();
            }
        } else {
            mysqli_query($this->db_connect, "UPDATE stok_barang SET nama_barang = '$nama_barang', total_barang = '$total_barang', edit_at = NOW() WHERE id_stok_barang = $id_stok_barang");

            header('Location: ../admin/stok_investaris.php?sukses=edit_berhasil');
            exit();
        }
    }
}

// Usage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_stok_barang'])) {
    $stokBarangUpdater = new StokBarangUpdater($db_connect);

    $id_stok_barang = mysqli_real_escape_string($db_connect, $_POST['id_stok_barang']);
    $nama_barang = mysqli_real_escape_string($db_connect, $_POST['nama_barang']);
    $total_barang = mysqli_real_escape_string($db_connect, $_POST['total_barang']);

    $stokBarangUpdater->updateBarang($id_stok_barang, $nama_barang, $total_barang, $_FILES['image']['tmp_name']);
} else {
    header('Location: ../../../pages-error-404.html');
    exit();
}