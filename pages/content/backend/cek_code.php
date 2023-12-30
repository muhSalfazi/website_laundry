<?php
// Import file koneksi ke database
include '../../core/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan verification code dari form
    $verificationCode = $_POST['verification_code'];

    // Query untuk mencari verification code di database
    $query = "SELECT * FROM register WHERE verification_code = '$verificationCode'";
    $result = mysqli_query($db_connect, $query);

    if ($result) {
        // Jika verification code cocok dalam database
        if (mysqli_num_rows($result) > 0) {
            // Ambil waktu kadaluwarsa dari database
            $row = mysqli_fetch_assoc($result);
            $expiryTime = $row['code_expiry'];

            // Bandingkan dengan waktu saat ini
            $currentTime = date('Y-m-d H:i:s');
            if ($expiryTime >= $currentTime) {
                // Token masih berlaku
                echo "<script>window.location.href = '../../../new_password.php?berhasil=add_berhasil';</script>";
                exit();
            } else {
                // Token kadaluwarsa
                echo "<script>window.location.href = '../../../riset_code.php?gagal=kadaluarsa';</script>";
            }
        } else {
            // Jika verification code tidak cocok dalam database
            echo "<script>window.location.href = '../../../riset_code.php?gagal=add_gagal';</script>";
        }
    } else {
        // Jika terjadi kesalahan dalam query
        header('Location: ../../../pages-error-404.html');
        exit();
    }
}
