<?php
// Jika pengguna sudah login, arahkan ke halaman dashboard atau halaman lainnya
if ( isset( $_SESSION[ 'id_register' ] ) ) {
    if ( $_SESSION[ 'role' ] == 'admin' || $_SESSION[ 'role' ] == 'pelanggan' ) {
        header( 'Location: ../dashboard/dashboard' );
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>

    <title>De'Ungu Laundry</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->

    <link href="../../../assets/img/logo-icon.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Template Main CSS File -->
    <link href="../../../assets/css/style.css" rel="stylesheet">




    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <!-- Tambahkan fungsi JavaScript di bagian head -->

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="../../content/dashboard/dashboard" class="logo d-flex align-items-center">
                <img src="../../../assets/img/logo.jpg" alt="" rel="icon" class="rounded-circle">
                <span class="d-none d-lg-block" style='color:darkslateblue;
'>De'ungu laundry</span>
            </a>
            <i class='bi bi-list toggle-sidebar-btn'></i>
        </div><!-- End Logo -->

        <nav class='header-nav ms-auto'>
            <ul class='d-flex align-items-center'>

                <li class='nav-item dropdown pe-3'>
                    <?php
require 'connection.php';

// Mulai sesi jika belum dimulai
if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
}

// Periksa apakah pengguna telah login
if ( isset( $_SESSION[ 'username' ] ) && isset( $_SESSION[ 'role' ] ) && isset( $_SESSION[ 'nama_lengkap' ] ) ) {
    $username = $_SESSION[ 'username' ];
    $nama_lengkap = $_SESSION[ 'nama_lengkap' ];

    // Tampilkan data di dalam HTML
    ?>
                    <div class='flex-row-reverse'>
                <li class='nav-item dropdown'>
                    <a class='nav-link nav-profile d-flex align-items-center pe-0 show' href=''
                        data-bs-toggle='dropdown'>
                        <img src='../../../assets/img/user.jpg' alt='' rel='icon' class='rounded-circle'>
                        <span class='d-none d-md-block dropdown-toggle ps-2 show' ::after>
                            <?php echo $username . PHP_EOL;
    ?>
                        </span>
                    </a>
                    <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow profile'
                        data-popper-placement='bottom-end'
                        style='position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-16px, 38px, 0px);'>
                        <li class='dropdown-header'>
                            <h6>
                                <?php echo $nama_lengkap;
    ?>
                            </h6>
                            <span>
                                <?php echo $_SESSION[ 'role' ];
    ?>
                            </span>
                        </li>
                        <li>
                            <hr class='dropdown-divider'>
                        </li>
                        <li id='logoutButton' class='dropdown-item d-flex align-items-center'>
                            <i class='bi bi-box-arrow-right'></i>
                            <span>Logout</span>
                        </li>
                    </ul>
                </li>
                </div>
                <?php } else {
        header( 'Location:../../../index' );
        exit( session_destroy() );
    }
    ;
    ?>

                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <?php include 'sidebar.php';
    ?>
</body>

</html>