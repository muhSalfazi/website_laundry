<?php
include '../../core/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = mysqli_real_escape_string($db_connect, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($db_connect, $_POST['confirm_password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Validasi apakah password cocok
    if ($password !== $confirmPassword) {
        // echo showAlert('error', 'Gagal', 'Konfirmasi password tidak cocok');
        echo "<script>window.location.href = '../../../new_password.php?gagal=tidak_cocok';</script>";
        exit();
    }

    // Perbarui password tanpa menggunakan verification_code
    $query = "UPDATE register SET password = '$hashedPassword' WHERE verification_code = '$verificationCode'";
    $result = mysqli_query($db_connect, $query);

    if ($result) {
        if (mysqli_affected_rows($db_connect) > 0) {
            // Setelah berhasil, tampilkan pesan sukses pada halaman ini
            // $message = showAlert('success', 'Berhasil', 'Password berhasil direset.');
            echo "<script>window.location.href = '../../../?berhasil=add_password';</script>";
        } else {
            // Jika tidak ada baris terpengaruh, tampilkan pesan kegagalan
            // $message = showAlert('error', 'Gagal', 'Gagal mereset password.');
            echo "<script>window.location.href = '../../../new_password.php?gagal=password_gagal';</script>";
        }
    } else {
        // Jika query gagal
        header('Location: ../../../pages-error-404.html');
        exit();
    }
}