<?php
include '../../core/connection.php';
require '../backend/assets/phpmailer/PHPMailer.php';
require '../backend/assets/phpmailer/SMTP.php';
require '../backend/assets/phpmailer/Exception.php';

// PHPMailer/src/PHPMailer.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    global $db_connect;

    function filter($text)
    {
        $text = addslashes($text);
        return htmlspecialchars($text);
    }

    $nama_lengkap = filter($_POST['nama_lengkap']);
    $email = filter($_POST['email']);
    $password = filter($_POST['password']);
    $username = filter($_POST['username']);
    $alamat = filter($_POST['alamat']);
    $No_telp = filter($_POST['no_telp']);
    // $role = filter( $_POST[ 'role' ] );
    // Hash password menggunakan fungsi password_hash
    $hashedPassword = filter(password_hash($password, PASSWORD_DEFAULT));
    //tanggal buat

    $created_at = filter(date('Y-m-d H:i:s', time()));
    // Mengecek apakah email sudah diinput atau belum
    $usedEmail = mysqli_query($db_connect, "SELECT email FROM pelanggan WHERE email = '$email'");
    $usedUsername = mysqli_query($db_connect, "SELECT username FROM pelanggan WHERE username = '$username'");

    if (mysqli_num_rows($usedEmail) > 0 || mysqli_num_rows($usedUsername) > 0) {
        echo "<script>window.location.href = '../admin/add_pelanggan.php?gagal=gagal_sudahada';</script>";
        die;
    }

    // Menyimpan data user ke tabel users
    $insertUserQuery = "INSERT INTO pelanggan (nama_lengkap, email, password, username, alamat, no_telp, created_at) VALUES ('$nama_lengkap', '$email', '$hashedPassword', '$username', '$alamat', '$No_telp', '$created_at')";

    $users = mysqli_query($db_connect, $insertUserQuery);

    if (!$users) {
        die('Error: ' . mysqli_error($db_connect));
    }

    // Mengirim email ketika registrasi berhasil
    $email_pengirim = 'salmanfauzi0512@gmail.com';
    $nama_pengirim = 'DeUngu_Laundry';
    $email_penerima = $email;
    $subjek = 'Registrasi Pengguna Baru DeUngu Laundry';
    $pesan = 'Selamat! Akun Anda berhasil ditambahkan. ID Pengguna Anda: ' . PHP_EOL .
        '<strong>' . $username . '</strong>' . PHP_EOL .
        'Password: <strong>' . $password . '</strong>' . PHP_EOL .
        '<br/>Silakan login ke sistem. Jika terjadi kesalahan, harap laporkan ke admin.';
      
    $phpMailer = new PHPMailer;
    $phpMailer->isSMTP();
    $phpMailer->Host = 'smtp.gmail.com';
    $phpMailer->Username = $email_pengirim;
    $phpMailer->Password = 'wqqm inbf vjwb hkzk'; // Ganti dengan password yang benar
    $phpMailer->Port = 465;
    $phpMailer->SMTPAuth = true;
    $phpMailer->SMTPSecure = 'ssl';
    $phpMailer->SMTPDebug = 2;

    $phpMailer->setFrom($email_pengirim, $nama_pengirim);
    $phpMailer->addAddress($email_penerima);
    $phpMailer->isHTML(true);
    $phpMailer->Subject = $subjek;
    $phpMailer->Body = $pesan;

    // Cek apakah email berhasil dikirim
    if ($phpMailer->send()) {
        // Email berhasil dikirim, tampilkan pesan sukses dengan input password asli
        echo "<script>window.location.href = '../admin/pelanggan.php?add=add_berhasil';</script>";
    } else {
        // Email tidak dapat dikirim, tampilkan pesan kesalahan dan hapus data dari database
        echo "<script>alert('Registrasi berhasil, tetapi email tidak dapat dikirim. Cek konfigurasi email.'); window.location.href = '../admin/pelanggan.php?add=add_berhasil';</script>";
        // Hapus data yang sudah dimasukkan ke database karena email tidak dapat dikirim
        mysqli_query($db_connect, "DELETE FROM pelanggan WHERE email = '$email'");
    }
} else {
    header('Location: ../../../pages-error-404.html');
    exit();
}