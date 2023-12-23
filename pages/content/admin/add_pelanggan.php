<?php
session_start();

if ( $_SESSION[ 'role' ] != 'admin' ) {
    header( 'Location:../../../index.php' );
    exit( session_destroy() );
}
?>
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath( dirname( __FILE__ ) . $ds . '../../../' ) . $ds;
require_once( "{$base_dir}pages{$ds}core{$ds}header.php" );
require_once( "{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php" );

?>
<?php

function showAlert( $icon, $title, $message, $redirect = null ) {
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
    " . ( $redirect ? "window.location.href = '$redirect';" : '' ) . "
});
});
</script>
";
}
?>

<?php

// mengecek di edit
if ( isset( $_GET[ 'gagal' ] ) ) {
    $berhasil = $_GET[ 'gagal' ];
    if ( $berhasil === 'gagal_sudahada' ) {
        showAlert( 'error', 'GAGAL', 'Email sudah di PAKAI.' );
    }
}
//berhasil di tambahkan
if ( isset( $_GET[ 'gagal' ] ) ) {
    $berhasil = $_GET[ 'gagal' ];
    if ( $berhasil === 'gagal_kirim' ) {
        showAlert( 'error', 'GAGAL', 'Email GAGAl di Kirim .' );
    }
}
?>

<main id = 'main' class = 'main'>

<div class = 'pagetitle'>
<h1>Add Pelanggan</h1>
<nav>
<ol class = 'breadcrumb'>
<li class = 'breadcrumb-item'><a href = '../../content/dashboard/dashboard'>Home</a></li>
<li class = 'breadcrumb-item'><a href = '../../content/admin/Pelanggan'>Data Pengguna</a></li>
<li class = ' breadcrumb-item active'>Add Pelanggan </li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class = 'section dashboard'>
<div class = 'row'>

<!-- Start Ngoding Disini -->

<div class = 'col-lg-12'>

<div class = 'card'>
<div class = 'card-body'>
<h5 class = 'card-title'>Form Register</h5>

<!-- Custom Styled Validation -->
<form action = '../backend/add-pelanggan.php' method = 'post' enctype = 'multipart/form-data'

class = 'row g-3 needs-validation' novalidate>
<div class = 'col-md-3'>
<label for = 'validationCustom02' class = 'form-label'>Nama Lengkap</label>
<input type = 'text' class = 'form-control' name = 'nama_lengkap' placeholder = 'silahkan isi'
required>
<div class = 'invalid-feedback'>
Harap berikan nama Lengkap yang valid.
</div>
</div>

<div class = 'col-md-3'>
<label for = 'validationCustom02' class = 'form-label'>Email</label>
<input type = 'text' class = 'form-control' name = 'email' placeholder = 'silahkan isi'
required>
<div class = 'invalid-feedback'>
Harap berikan Email yang valid.
</div>
</div>

<div class = 'col-md-3'>
<label for = 'validationCustomUsername' class = 'form-label'>Username</label>
<div class = 'input-group has-validation'>
<span class = 'input-group-text' id = 'inputGroupPrepend'>@</span>
<input type = 'text' class = 'form-control' name = 'username'
aria-describedby = 'inputGroupPrepend' required>
<div class = 'invalid-feedback'>
Silakan pilih nama pengguna.
</div>
</div>
</div>
<div class = 'col-md-3'>
<label for = 'validationCustom05' class = 'form-label'>Password</label>
<input type = 'password' class = 'form-control' name = 'password' required>
<div class = 'invalid-feedback'>
Harap berikan password yang valid.
</div>
</div>
<div class = 'col-md-6'>
<label for = 'validationCustom03' class = 'form-label'>Alamat</label>
<input type = 'text' class = 'form-control' name = 'alamat' required>
<div class = 'invalid-feedback'>
Harap berikan alamat yang valid.
</div>
</div>
<div class = 'col-md-6'>
<label for = 'validationCustom03' class = 'form-label'>No Handphone</label>
<input type = 'number' class = 'form-control' name = 'no_telp' required>
<div class = 'invalid-feedback'>
Harap berikan No Handphone yang valid.
</div>
</div>

<div class = 'col-12'>
<div class = 'form-check'>
<input class = 'form-check-input' type = 'checkbox' value = '' id = 'invalidCheck' required>
<label class = 'form-check-label' for = 'invalidCheck'>
Setuju dengan syarat dan ketentuan
</label>
<div class = 'invalid-feedback'>
Anda harus menyetujuinya sebelum mengirimkan.
</div>
</div>
</div>

<div class = 'col-12'>
<button class = 'btn btn-primary' name = 'submit' type = 'submit'>Submit
form</button>
</div>
</form><!-- End Custom Styled Validation -->

</div>
</div>

</div>
</div>

<!-- End Ngoding Disini -->

</section>

</main><!-- End #main -->

<?php
require_once( "{$base_dir}pages{$ds}core{$ds}footer.php" );
?>