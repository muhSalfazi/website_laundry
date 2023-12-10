<?php
session_start();

include '../../core/connection.php';

if ( isset( $_POST[ 'submit' ] ) ) {
    global $db_connect;

    $username = $_POST[ 'username' ];
    $password = $_POST[ 'password' ];
    

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = mysqli_prepare( $db_connect, 'SELECT * FROM register WHERE username = ?' );
    mysqli_stmt_bind_param( $stmt, 's', $username );
    mysqli_stmt_execute( $stmt );

    $result = mysqli_stmt_get_result( $stmt );

    if ( $result ) {
        $userData = mysqli_fetch_assoc( $result );

        if ( $userData && password_verify( $password, $userData[ 'password' ] ) ) {
            $_SESSION[ 'username' ] = $userData[ 'username' ];
            $_SESSION[ 'role' ] = $userData[ 'role' ];
            $_SESSION[ 'nama_lengkap' ] = $userData[ 'nama_lengkap' ];

            // Periksa role setelah login
            if ( $_SESSION[ 'role' ] == 'admin' ) {
                header( 'Location: ../dashboard/dashboard.php' );
                exit();
            } else if ( $_SESSION[ 'role' ] == 'pelanggan' ) {
                // Tambahkan logika tambahan untuk pelanggan di sini jika diperlukan
                header( 'Location: ../dashboard/dashboard.php' );
                exit();
            }
        } else {
            // Tampilkan pesan kesalahan jika password tidak sesuai
            echo 'Username atau password salah';
        }
    } else {
        // Tampilkan pesan kesalahan jika terjadi kesalahan selama eksekusi pernyataan SQL
        echo 'Terjadi kesalahan. Silakan coba lagi.';
    }

    mysqli_stmt_close( $stmt );
    mysqli_close( $db_connect );
}
?>