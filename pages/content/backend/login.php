<?php
session_start();

include '../../core/connection.php';

if (isset($_POST['submit'])) {
    global $db_connect;

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = mysqli_prepare($db_connect, 'SELECT * FROM register WHERE username = ?');
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);

        if ($userData && password_verify($password, $userData['password'])) {
            $_SESSION['username'] = $userData['username'];
            $_SESSION['role'] = $userData['role'];
            $_SESSION['nama_lengkap'] = $userData['nama_lengkap'];
            $_SESSION['alamat'] = $userData['alamat'];
            $_SESSION['no_telp'] = $userData['no_telp'];

            // Periksa role setelah login
            if ($_SESSION['role'] == 'admin') {
                echo "<script>
                window.location.replace(' ../dashboard/dashboard-admin.php');
            </script>";
                exit();
            } else if ($_SESSION['role'] == 'pelanggan') {
                // Tambahkan logika tambahan untuk pelanggan di sini jika diperlukan

                echo "<script>
                window.location.replace(' ../dashboard/dashboard.php');
            </script>";
            }
        } else {
            // Tampilkan pesan kesalahan jika password tidak sesuai
            header('Location: ../../../?gagal=gagal_login');

            exit();
        }
    } else {
        // Tampilkan pesan kesalahan jika terjadi kesalahan selama eksekusi pernyataan SQL
        header('Location: ../../../pages-error-404.html');
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($db_connect);
}
