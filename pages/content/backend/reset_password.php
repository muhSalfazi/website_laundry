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

            // Simpan token di database (tambahkan ke tabel yang sesuai)

            // Simpan kode verifikasi di database (tambahkan ke tabel yang sesuai)
            $verificationCode = generateRandomCode(6);
            $updateQuery = "UPDATE `register` SET `verification_code` = '$verificationCode' WHERE `email` = '$email'";
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
                $mail->Body = "
                Anda telah menagajukan reset password 
                silahkan masukan kode berikut
                untuk verifikasi: $verificationCode";

                // Kirim email
                $mail->send();

                echo "Instruksi reset password telah dikirim ke email Anda.";
            } catch (Exception $e) {
                echo "Gagal mengirim email. Pesan error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Email tidak ditemukan dalam database.";
        }
    } else {
        // Handle kesalahan eksekusi query
        echo "Error: " . mysqli_error($connection);
    }
}
?>