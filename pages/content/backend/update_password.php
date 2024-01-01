<?php
include '../../core/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $verificationCode = $_POST['verification_code'];
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Validasi apakah password cocok
    if ($password !== $confirmPassword) {
        echo "<script>window.location.href = '../../../new_password.php?gagal=tidak_cocok';</script>";
        exit();
    }

    // Validasi panjang minimal password
    if (strlen($password) < 8) {
        echo "<script>window.location.href = '../../../new_password.php?gagal=password_pendek';</script>";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = $db_connect->prepare("SELECT * FROM register WHERE verification_code = ?");
    $query->bind_param("s", $verificationCode);
    $query->execute();
    $result = $query->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $expiryTime = $row['code_expiry'];
            $update_password = $row['update_password'];
            $currentTime = date('Y-m-d H:i:s');

            if ($expiryTime >= $currentTime) {
                $expiryTime = date('Y-m-d H:i:s', strtotime('+1 hour'));

                $updateQuery = $db_connect->prepare("UPDATE register SET password = ? WHERE verification_code = ?");
                $updateQuery->bind_param("ss", $hashedPassword, $verificationCode);
                $updateQuery->execute();

                echo "<script>window.location.href = '../../../?berhasil=ubah_password';</script>";
                exit();
            } else {
                echo "<script>window.location.href = '../../../new_password.php?gagal=kadaluarsa';</script>";
            }
        } else {
            echo "<script>window.location.href = '../../../new_password.php?gagal=add_gagal';</script>";
        }
    } else {
        die("Query error: " . mysqli_error($db_connect));
    }
}