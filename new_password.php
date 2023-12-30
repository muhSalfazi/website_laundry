<?php
// new_password.php
include './pages/core/connection.php';

// Mendapatkan email dari URL (Anda mungkin perlu mengamankan input ini)
$email = $_GET['email'];

// Query untuk memeriksa apakah email telah melakukan riset
$query = "SELECT * FROM register WHERE email = '$email' AND verification_code IS NOT NULL AND code_expiry >= NOW()";
$result = mysqli_query($db_connect, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Pengguna telah melakukan riset dan token masih berlaku
    // Tampilkan konten new_password.php
} else {
    // Pengguna belum melakukan riset atau token sudah kadaluwarsa
    // Redirect ke halaman lain atau tampilkan pesan sesuai kebijakan Anda

    echo "<script>window.location.href = 'lupa_password?gagal=kadaluarsa';</script>";
    exit();
}
?><?php
    //new_password
    function showAlert($icon, $title, $message, $redirect = null)
    {
        echo "
    <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                html: '<p class=\"p-popup\">$message</p>',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                " . ($redirect ? "window.location.href = '$redirect';" : '') . "
            });
        });
    </script>
    ";
    }
    ?>
<!--create-->

<?php

// mengecek di tambahkan

if (isset($_GET['berhasil'])) {
    $berhasil = $_GET['berhasil'];
    if ($berhasil === 'add_berhasil') {
        showAlert('success', 'Berhasil', ' Code Terverifikasi.');
    }
}

if (isset($_GET['gagal'])) {
    $berhasil = $_GET['gagal'];
    if ($berhasil === 'add_gagal') {
        showAlert('error', 'Gagal', ' Gagal mereset password.');
    }
}
if (isset($_GET['gagal'])) {
    $berhasil = $_GET['gagal'];
    if ($berhasil === 'tidak_cocok') {
        showAlert('error', 'Gagal', ' Konfirmasi password tidak cocok.');
    }
}
?>
<!DOCTYPE html>
<html lang="ind">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>De'UnguLaundry</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../../../assets/img/logo-icon.png" rel="icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  =
    * Template Name: NiceAdmin
    * Updated: Sep 18 2023 with Bootstrap v5.3.2
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  == -->
</head>

<body>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a class="logo d-flex align-items-center w-auto">
                                    <img class="d-none d-lg-block" src="assets/img/logo.jpg" alt="" />
                                    <span class="d-none d-lg-block" style="color: darkslateblue">De'ungu laundry</span>
                                </a>
                            </div>
                            <!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">
                                            Riset Password
                                        </h5>
                                        <p class="text-center small">
                                            Buat password Anda untuk login ke dalam website
                                        </p>
                                    </div>

                                    <form action="./pages/content/backend/update_password.php" method="post"
                                        id="validateForm">
                                        <!-- Field password -->
                                        <div class="form-group">
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password Baru</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input type="password" name="password" class="form-control"
                                                        required />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Field konfirmasi password -->
                                        <div class="col-12">
                                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="password" name="confirm_password" class="form-control"
                                                    required />
                                            </div>
                                        </div>

                                        <!-- Tombol submit -->
                                        <div class="col-12 mt-3">
                                            <button type="submit" id="kode" class="btn btn-primary w-100">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                    <div class="col-12 mt-3">
                                        <a href="./">Kembali ke halaman login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        </div>
    </main>
    <!-- End #main -->

    <?php echo $message; ?>

</body>

</html>