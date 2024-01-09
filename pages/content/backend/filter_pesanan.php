<?php



// Filter logic
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

switch ($filter) {
    case 'today':
        $viewName = 'order_view_today';
        break;
    case 'month':
        $viewName = 'order_view_month';
        break;
    case 'year':
        $viewName = 'order_view_year';
        break;
    default:
        $viewName = 'order_view_all';
        break;
}

$sql = "SELECT * FROM `$viewName`";
$order = mysqli_query($db_connect, $sql);