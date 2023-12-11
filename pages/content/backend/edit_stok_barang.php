<?php
// update.php

include '../../core/connection.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' && isset( $_POST[ 'id_stok_barang' ] ) ) {
    global $db_connect;

    $id_stok_barang = $_POST[ 'id_stok_barang' ];
    $nama_barang = $_POST[ 'nama_barang' ];
    $total_barang = $_POST[ 'total_barang' ];

    $uploadDir = __DIR__ . '/../upload/';

    if ( !is_dir( $uploadDir ) ) {
        mkdir( $uploadDir, 0755, true );
    }

    $randomFilename = time() . '-' . md5( rand() ) . '-';

    if ( $_FILES[ 'image' ][ 'size' ] > 0 ) {
        $image = $_FILES[ 'image' ][ 'name' ];
        $tempImage = $_FILES[ 'image' ][ 'tmp_name' ];

        $randomFilename .= $image;

        $uploadPath = $uploadDir . $randomFilename;

        $upload = move_uploaded_file( $tempImage, $uploadPath );

        if ( $upload ) {
            $oldImageQuery = mysqli_query( $db_connect, "SELECT image FROM stok_barang WHERE id_stok_barang= $id_stok_barang" );
            $oldImagePath = mysqli_fetch_assoc( $oldImageQuery )[ 'image' ];

            mysqli_query( $db_connect, "UPDATE stok_barang SET nama_barang = '$nama_barang', total_barang = '$total_barang', image = 'upload/$randomFilename' WHERE id_stok_barang = $id_stok_barang" );

            // Redirect back to index.php with success parameter
            header( 'Location: ../admin/stok_barang.php?sukses=update_success' );
            exit();
            // Ensure the script stops here to prevent further execution
        } else {
            // Redirect back to index.php with an error message
            header( 'Location: ../admin/stok_barang.php?error=upload_failed' );
            exit();
        }
    } else {
        mysqli_query( $db_connect, "UPDATE stok_barang SET nama_barang = '$nama_barang', total_barang = '$total_barang' WHERE id_stok_barang = $id_stok_barang" );

        // Redirect back to index.php with success parameter
        header( 'Location: ../admin/stok_barang.php?sukses=edit_berhasil' );
        exit();
        // Ensure the script stops here to prevent further execution
    }
} else {
    // Redirect back to index.php with an error message for invalid request
    header( 'Location: ../admin/stok_barang.php?error=invalid_request' );
    exit();
}
?>