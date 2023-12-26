<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location:../../../');
    exit();
}

function getDashboardData($filter = 'today')
{
    global $db_connect;

    $query = "SELECT 
                SUM(jumlah_bayar) AS pendapatan,
                COUNT(id_order) AS sales
              FROM `order`
              WHERE DATE(created_at) = CURDATE();";

    $query2 = "SELECT COUNT(DISTINCT id_pelanggan) AS pelanggan FROM pelanggan   WHERE DATE(created_at) = CURDATE();";

    if ($filter === 'this_month') {
        $query = "SELECT 
                    SUM(jumlah_bayar) AS pendapatan,
                    COUNT(id_order) AS sales
                  FROM `order`
                  WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW());";

        $query2 = "SELECT COUNT(DISTINCT id_pelanggan) AS pelanggan FROM pelanggan";
    } elseif ($filter === 'this_year') {
        $query = "SELECT 
                    SUM(jumlah_bayar) AS pendapatan,
                    COUNT(id_order) AS sales
                  FROM `order`
                  WHERE YEAR(created_at) = YEAR(NOW());";

        $query2 = "SELECT COUNT(DISTINCT id_pelanggan) AS pelanggan FROM pelanggan";
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

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");
include("{$base_dir}pages{$ds}content{$ds}backend{$ds}proses.php");
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'today';
$dashboardData = getDashboardData($filter);
?>



<main id='main' class='main'>

    <div class='pagetitle'>
        <h1>Dashboard</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='dashboard.php'>Home</a></li>
                <li class='breadcrumb-item active'>Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section dashboard'>



        <section class='section dashboard'>
            <div class='row'>
                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="dashboard-admin.php?filter=today">Today</a></li>
                                <li><a class="dropdown-item" href="dashboard-admin.php?filter=this_month">This Month</a>
                                </li>
                                <li><a class="dropdown-item" href="dashboard-admin.php?filter=this_year">This Year</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Pesanan Order<span> | <?php echo ucfirst($filter); ?></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo $dashboardData['sales']; ?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="dashboard-admin.php?filter=today">Today</a></li>
                                <li><a class="dropdown-item" href="dashboard-admin.php?filter=this_month">This
                                        Month</a>
                                </li>
                                <li><a class="dropdown-item" href="dashboard-admin.php?filter=this_year">This
                                        Year</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Pendapatan<span> | <?php echo ucfirst($filter); ?></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>$<?php echo $dashboardData['pendapatan']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Revenue Card -->
                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="dashboard-admin.php?filter=today">Today</a></li>
                                <li><a class="dropdown-item" href="dashboard-admin.php?filter=this_month">This
                                        Month</a>
                                </li>
                                <li><a class="dropdown-item" href="dashboard-admin.php?filter=this_year">This
                                        Year</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Customers <span> | <?php echo ucfirst($filter); ?></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo $dashboardData['pelanggan']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- End Customers Card -->


            </div>

            <!-- End Ngoding Disini -->

            </div>
        </section>


</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>