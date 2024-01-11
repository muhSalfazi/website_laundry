<?php

// Filter logic
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

switch ($filter) {
    case 'today':
        $viewName = 'pelanggan_view_today';
        break;
    case 'month':
        $viewName = 'pelanggan_view_month';
        break;
    case 'year':
        $viewName = 'pelanggan_view_year';
        break;
    default:
        $viewName = 'pelanggan_view_all';
        break;
}

$sql = "SELECT * FROM `$viewName`";
$data_pelanggan = mysqli_query($db_connect, $sql);