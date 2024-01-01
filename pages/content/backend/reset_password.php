<?php

// process_reset_password.php
include '../../core/connection.php';
require '../backend/assets/phpmailer/PHPMailer.php';
require '../backend/assets/phpmailer/SMTP.php';
require '../backend/assets/phpmailer/Exception.php';

// PHPMailer/src/PHPMailer.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function generateRandomCode($length = 6)
{
    return bin2hex(random_bytes($length / 2));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email tidak valid");
    }

    // Cek keberadaan email di database
    $query = "SELECT * FROM `register` WHERE `email` = '$email'";
    $result = mysqli_query($db_connect, $query);

    // Jika query berhasil dieksekusi
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Jika email ditemukan
        if ($row) {

            // Buat token reset password
            $token = bin2hex(random_bytes(32));

            // Set waktu kadaluwarsa (misalnya, 1 hari dari sekarang)
            $expiryTime = date('Y-m-d H:i:s', strtotime('+1 day'));

            // Simpan kode verifikasi dan waktu kadaluwarsa di database
            $verificationCode = generateRandomCode(6);
            $updateQuery = "UPDATE register SET verification_code = '$verificationCode', code_expiry = '$expiryTime' WHERE `email` = '$email'";
            mysqli_query($db_connect, $updateQuery);

            // Kirim email reset password ke pengguna menggunakan PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Konfigurasi SMTP untuk Gmail
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'salmanfauzi0512@gmail.com'; // Ganti dengan alamat email Anda
                $mail->Password = 'wqqm inbf vjwb hkzk'; // Ganti dengan kata sandi email Anda
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Pengaturan email
                $mail->setFrom('salmanfauzi0512@gmail.com', 'DEUnguLaundry'); // Ganti dengan alamat email Anda
                $mail->addAddress($email);
                $mail->Subject = 'Reset Password';
                $mail->Body = 'Anda telah mengajukan reset password. Silakan masukkan kode berikut untuk verifikasi: ' . $verificationCode . PHP_EOL .
                PHP_EOL .

                    'Kode verifikasi ini memiliki jangka waktu kadaluwarsa selama 1 hari sejak saat pembuatan.';

                // Kirim email
                $mail->send();
                echo "<script>window.location.href = '../../../new_password.php?berhasil=add_berhasil';</script>";
            } catch (Exception $e) {
                echo "Gagal mengirim email. Pesan error: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>window.location.href = '../../../lupa_password.php?gagal=add_gagal';</script>";
        }
    } else {
        // Handle kesalahan eksekusi query
        echo "Error: " . mysqli_error($db_connect);
    }
}