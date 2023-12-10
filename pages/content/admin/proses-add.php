<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'Exception.php' );
include( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'PHPMailer.php' );
include( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'SMTP.php' );

session_start();
require __DIR__ . DIRECTORY_SEPARATOR . '../../core/connection.php';

if ( isset( $_POST[ 'submit' ] ) ) {
    global $db_connect;

    function filter( $text ) {
        $text = addslashes( $text );
        return htmlspecialchars( $text );
    }

    $nama_lengkap = filter( $_POST[ 'nama_lengkap' ] );
    $email = filter( $_POST[ 'email' ] );
    $password = filter( $_POST[ 'password' ] );
    $username = filter( $_POST[ 'username' ] );
    $alamat = filter( $_POST[ 'alamat' ] );
    $No_telp = filter( $_POST[ 'no_telp' ] );
    // $role = filter( $_POST[ 'role' ] );
    // Hash password menggunakan fungsi password_hash
    $hashedPassword = filter( password_hash( $password, PASSWORD_DEFAULT ) );
    //tanggal buat

    $created_at = filter( date( 'Y-m-d H:i:s', time() ) );
    // Mengecek apakah email sudah diinput atau belum
    $usedEmail = mysqli_query( $db_connect, "SELECT email FROM pelanggan WHERE email = '$email'" );

    if ( mysqli_num_rows( $usedEmail ) > 0 ) {
        echo 'Email sudah digunakan';
        die;
    }

    // Menyimpan data user ke tabel users
    $insertUserQuery = "INSERT INTO pelanggan (nama_lengkap, email, password, username, alamat, no_telp, created_at) VALUES ('$nama_lengkap', '$email', '$hashedPassword', '$username', '$alamat', '$No_telp', '$created_at')";

    $users = mysqli_query( $db_connect, $insertUserQuery );

    if ( !$users ) {
        die( 'Error: ' . mysqli_error( $db_connect ) );
    }

    // Mengambil data user untuk session
    $getuserdata = mysqli_query( $db_connect, "SELECT nama_lengkap FROM pelanggan WHERE email = '$email'" );

    if ( !$getuserdata ) {
        die( 'Error: ' . mysqli_error( $db_connect ) );
    }

    $sessionData = mysqli_fetch_assoc( $getuserdata );
    $_SESSION[ 'nama_lengkap' ] = $sessionData[ 'nama_lengkap' ];
    // $_SESSION[ 'role' ] = $sessionData[ 'role' ];

    // Mengirim email ketika registrasi berhasil
    $email_pengirim = 'salmanfauzi0512@gmail.com';
    $nama_pengirim = 'DeUngu_Laundry';
    $email_penerima = $email;
    $subjek = 'Registrasi NEW User DeUngu Laundry';
    $pesan = 'Selamat! Akun Anda berhasil ditambahkan ID User Anda: ' . PHP_EOL .
    '<strong>' . $username . '</strong>' . PHP_EOL .
    'password: <strong>' . $password . '</strong>' . PHP_EOL .
    '<br/>Silakan login pada sistem dan jika terjadi kesalahan, harap laporkan ke admin.';

    $email = new PHPMailer;
    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->Username = $email_pengirim;
    $email->Password = 'wqqm inbf vjwb hkzk';
    // Ganti dengan password yang benar
    $email->Port = 465;
    $email->SMTPAuth = true;
    $email->SMTPSecure = 'ssl';
    $email->SMTPDebug = 2;

    $email->setFrom( $email_pengirim, $nama_pengirim );
    $email->addAddress( $email_penerima );
    $email->isHTML( true );
    $email->Subject = $subjek;
    $email->Body = $pesan;

    if ( $email->send() ) {
        // Menampilkan pesan sukses dengan input password asli
        echo "<script>alert('Email berhasil dikirim. Data berhasil ditambahkan, dan email notifikasi terkirim'); window.location.href = 'pengguna.php?berhasil=update_berhasil';</script>";
    } else {
        echo "<h1>Email gagal dikirim</h1><br/><a href='add_pengguna'>Kembali ke form</a>";
    }
}
?>