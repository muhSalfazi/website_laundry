<!-- ======= Sidebar ======= -->
<?php
session_start();
if ( $_SESSION[ 'role' ] != 'pemilik' ) {
session_destroy();
header( 'Location:../../../index.php' );
}
?>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="../dashboard/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>


        <li class='nav-item'>
            <a class='nav-link collapsed' href='../User/Pengguna'>
                <i class='bi bi-people'></i>
                <span>Pengguna</span>
            </a>
        </li>
        <!-- End Profile Page Nav -->

    </ul>
</aside><!-- End Sidebar-->