<?php

// Check if the 'filter' parameter is set in the URL, otherwise default to 'today'
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'today';

function getDashboardData($filter = 'today')
{
    global $db_connect;

    $query = "SELECT
    SUM(jumlah_bayar) AS pendapatan,
    COUNT(id_order) AS sales
    FROM `order`
    WHERE DATE(created_at) = CURDATE();";

    if ($filter === 'this_month') {
        $query = "SELECT
        SUM(jumlah_bayar) AS pendapatan,
        COUNT(id_order) AS sales
        FROM `order`
        WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW());";
    } elseif ($filter === 'this_year') {
        $query = "SELECT
        SUM(jumlah_bayar) AS pendapatan,
        COUNT(id_order) AS sales
        FROM `order`
        WHERE YEAR(created_at) = YEAR(NOW());";
    }

    $query2 = "SELECT COUNT(DISTINCT id_pelanggan) AS pelanggan FROM pelanggan WHERE ";

    if ($filter === 'today') {
        $query2 .= "DATE(created_at) = CURDATE();";
    } elseif ($filter === 'this_month') {
        $query2 .= "MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW());";
    } elseif ($filter === 'this_year') {
        $query2 .= "YEAR(created_at) = YEAR(NOW());";
    }

    $result = mysqli_query($db_connect, $query);
    $result2 = mysqli_query($db_connect, $query2);

    if ($result && $result2) {
        $data = [
            'pendapatan' => 0,
            'sales' => 0,
            'pelanggan' => 0,
        ];

        while ($row = mysqli_fetch_assoc($result)) {
            $data['pendapatan'] = $row['pendapatan'];
            $data['sales'] = $row['sales'];
        }

        while ($row = mysqli_fetch_assoc($result2)) {
            $data['pelanggan'] = $row['pelanggan'];
        }

        return $data;
    } else {
        return false;
    }
}