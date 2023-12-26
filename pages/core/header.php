<?php
// Jika pengguna sudah login, arahkan ke halaman dashboard atau halaman lainnya
if (isset($_SESSION['id_register'])) {
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'pelanggan') {
        header('Location: ../dashboard/dashboard');
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;700&display=swap">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->


</head>
<style>
/* Loading Overlay */
.loading-overlay {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.3s ease-in-out;
    color: darkorchid;
    font-family: 'Roboto', sans-serif;

}

.loading-overlay.hidden {
    opacity: 0;
    pointer-events: none;
}

.loading-spinner {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin-bottom: 20px;
}

.loading-text {
    font-size: 18px;
    font-weight: bold;
    font-family: 'Pacifico', cursive;
    /* Ganti 'Pacifico' dengan font yang diinginkan */
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>





<body>
    <!-- Button spinners -->
    <div class="loading-overlay" id="loading-overlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">~ Loading De'Ungu Laundry ~</div>
    </div>


    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a class="logo d-flex align-items-center">
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
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Periksa apakah pengguna telah login
                    if (isset($_SESSION['username']) && isset($_SESSION['role']) && isset($_SESSION['nama_lengkap'])) {
                        $username = $_SESSION['username'];
                        $nama_lengkap = $_SESSION['nama_lengkap'];

                        // Tampilkan data di dalam HTML
                    ?>

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="../../../assets/img/user.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"> <?php echo $username . PHP_EOL;
                                                                                    ?></span>
                    </a>

                    <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow profile'>

                        <li class=' dropdown-header'>
                            <h6>
                                <?php echo $nama_lengkap;
                                    ?>
                            </h6>
                            <span>
                                <?php echo $_SESSION['role'];
                                    ?>
                            </span>
                        </li>
                        <li>
                            <hr class='dropdown-divider'>
                        </li>
                        <li>
                            <a id='logoutButton' class='dropdown-item d-flex align-items-center'>
                                <i class='bi bi-box-arrow-right'></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <?php } else {
                        header('Location:../../../index');
                        exit(session_destroy());
                    };
            ?>

                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <?php include 'sidebar.php';
    ?>
</body>

</html>