<?php
//riset_code.php

session_start();

// Setelah verifikasi berhasil, atur variabel sesi
if (isset($_GET['berhasil'])) {
    $berhasil = $_GET['berhasil'];
    if ($berhasil === 'add_berhasil') {
        $_SESSION['verification_completed'] = true;
        showAlert('success', 'Berhasil', ' Instruksi reset password telah dikirim ke email Anda.');
    }
}

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

// mengecek di tambahkan
if (isset($_GET['gagal'])) {
    $berhasil = $_GET['gagal'];
    if ($berhasil === 'add_gagal') {
        showAlert('error', 'Gagal', ' verification code tidak cocok dalam database');
    }
}
if (isset($_GET['gagal'])) {
    $berhasil = $_GET['gagal'];
    if ($berhasil === 'kadaluarsa') {
        showAlert('error', 'Gagal', ' Token Kadaluarsa');
    }
}

?>
<!-- Rest of your HTML code remains unchanged -->

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
                                            Riset Code
                                        </h5>
                                        <p class="text-center small">
                                            Masukkan verification code untuk memvalidasi akun
                                        </p>
                                    </div>

                                    <form action="./pages/content/backend/cek_code.php" method="post">
                                        <div class=" form-group">
                                            <div class="col-12">
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input type="text" name="verification_code" class="form-control"
                                                        placeholder="Enter Code" required />
                                                    <div class="invalid-feedback">
                                                        Silakan masukkan kode verifikasi Anda.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            </section>
        </div>
    </main>

</body>

</html>