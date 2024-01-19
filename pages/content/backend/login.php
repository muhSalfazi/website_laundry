<?php
session_start();

include '../../core/connection.php';

// Cek apakah pengguna sudah login

// Proses login jika formulir login disubmit
if (isset($_POST['submit'])) {
    global $db_connect;

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt = mysqli_prepare($db_connect, 'SELECT * FROM register WHERE username = ?');
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);

        if ($userData && password_verify($password, $userData['password'])) {
            // Setel variabel sesi
            $_SESSION['username'] = htmlspecialchars($userData['username']);
            $_SESSION['role'] = htmlspecialchars($userData['role']);
            $_SESSION['nama_lengkap'] = htmlspecialchars($userData['nama_lengkap']);
            $_SESSION['alamat'] = htmlspecialchars($userData['alamat']);
            $_SESSION['no_telp'] = htmlspecialchars($userData['no_telp']);

            // Redirect pengguna setelah login berhasil
            if ($_SESSION['role'] == 'admin') {
                header('Location: ../dashboard/dashboard-admin');
                exit();
            } else if ($_SESSION['role'] == 'pelanggan') {
                header('Location: ../dashboard/dashboard');
                exit();
            }
        } else {
            // Tampilkan pesan kesalahan jika kata sandi tidak sesuai
            header('Location: ../../../login?gagal=gagal_login');
            exit();
        }
    } else {
        // Tampilkan pesan kesalahan jika terjadi kesalahan selama eksekusi pernyataan SQL
        header('Location: ../../../pages-error-404.html');
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($db_connect);
} else {
    header('Location: ../../../pages-error-404.html');
    exit();
}
