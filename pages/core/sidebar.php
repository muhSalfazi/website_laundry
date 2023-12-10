<?php

?><aside id='sidebar' class='sidebar'>
    <ul class='sidebar-nav' id='sidebar-nav'>

        <li class='nav-item'>
            <a class='nav-link' href='../dashboard/dashboard'>
                <i class='bi bi-grid'></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class='nav-heading'>Pages</li>

        <?php
// Mulai sesi

// Periksa apakah pengguna memiliki peran 'admin'
$admin = isset( $_SESSION[ 'role' ] ) && $_SESSION[ 'role' ] == 'admin';

if ( $admin ) {
    // Menu hanya ditampilkan jika pengguna memiliki peran 'pemilik'
    echo '
            <li class=\'nav-item\'>
                <a class=\'nav-link collapsed\' href=\'../../content/admin/Pengguna\'>
                    <i class=\'bi bi-people\'></i>
                    <span>Data Pelanggan</span>
                </a>
            </li>';
    echo '
            <li class=\'nav-item\'>
                <a class=\'nav-link collapsed\' href=\'../../content/admin/stok_investaris\'>
                    <i class=\'bi bi-handbag\'></i>
                    <span>investaris</span>
                </a>
            </li>';

    echo '
            <li class=\'nav-item\'>
            <a class=\'nav-link collapsed\'href=\'../../content/admin/laporan\'>
                <i class=\'bi bi-clipboard-data-fill\'></i>
            <span>Laporan</span>
            </li>';

}
?>

        <?php
$pelanggan = isset ( $_SESSION[ 'role' ] ) && $_SESSION[ 'role' ] == 'pelanggan';

if ( $pelanggan ) {

    // Menu hanya ditampilkan jika pengguna memiliki peran 'pemilik'
    echo '
            <li class=\'nav-item\'>
                <a class=\'nav-link collapsed\' href=\'../../content/pelanggan/cek_order\'>
                    <i class=\'bi bi-check-circle\'></i>
                    <span>Cek Order</span>
                </a>
            </li>';
    echo '
            <li class=\'nav-item\'>
            <a class=\'nav-link collapsed\'href=\'../../content/pelanggan/order\'>
                <i class=\'bi bi-cart-fill\'></i>
            <span>Order</span>
            </li>';

}
?>

        <!-- End Profile Page Nav -->

    </ul>
</aside><!-- End Sidebar-->