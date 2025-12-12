
<?php
require_once __DIR__ . '/../config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Lấy token từ cookie (đồng bộ với các trang manage khác)
$token = isset($_COOKIE['jwtToken']) ? $_COOKIE['jwtToken'] : '';

$url = rtrim(BACKEND_URL, '/') . '/api/orders/admin-list';

$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => "Authorization: Bearer $token\r\n" .
                    "Content-Type: application/json\r\n",
        'content' => json_encode(new stdClass()),
        'ignore_errors' => true,
    ]
]);

$response = @file_get_contents($url, false, $context);
if ($response === FALSE) {
    $error = error_get_last();
    die('Lỗi khi lấy dữ liệu từ backend: ' . ($error['message'] ?? 'unknown'));
}

$data = json_decode($response, true);
if ($data === null) {
    die('Lỗi khi chuyển đổi JSON: ' . json_last_error_msg());
}

?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
        .table.dataTable td{
            min-width: 150px;
        }
    </style>

</head>

<body>
    <div class="overlay" id="loadingOverlay">
        <div class="spinner-border text-light" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="../index.php"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Các mục chính</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown hidden-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Tài khoản</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user"></i><a href="manage-user.php">Quản lý tài khoản</a></li>
                            <li><i class="fa fa-plus"></i><a href="add-user.html">Thêm tài khoản</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown hidden-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa fa-file-text-o"></i>Bài viết</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-text-o"></i><a href="manage-content.php">Quản lý bài viết</a></li>
                            <li><i class="fa fa-plus"></i><a href="add-content.html">Thêm bài viết</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Sách</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-book"></i><a href="manage-book.php">Quản lý sách</a></li>
                            <li><i class="fa fa-plus"></i><a href="add-book.html">Thêm sách</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tags"></i>Danh mục sách</a>
                        <ul class="sub-menu children dropdown-menu">
                           <li><i class="fa fa-tags"></i><a href="manage-category.php">Quản lý danh mục</a></li>
                            <li><i class="fa fa-plus"></i><a href="add-category.html">Thêm danh mục</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7" >
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <span id="span-avatar"></span>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="page-login.html" onclick="logout()"><i class="fa fa-sign-out"></i> Đăng xuất </a>
                            <a class="nav-link" href="../index.php"><i class="fa fa-newspaper-o"></i> Về trang chủ </a>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Bài viết</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li>Đơn hàng</li>
                            <li class="active">Quản lý đơn hàng</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Bảng bài viết <strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Khách hàng</th>
                                            <th>mã đơn</th>
                                            <th>Ngày tạo đơn</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($data['data']) && is_array($data['data']) && count($data['data'])>0) {
                                        foreach ($data['data'] as $order) {
                                            $customer = htmlspecialchars($order['customer'] ?? '-');
                                            $orderCode = htmlspecialchars($order['orderCode'] ?? ('ORD-'.($order['id']??'')));
                                            $createdAt = htmlspecialchars($order['createdAt'] ?? '');
                                            $total = isset($order['total']) ? number_format((float)$order['total'],2) : '0.00';
                                            $status = htmlspecialchars($order['status'] ?? '-');
                                            $id = htmlspecialchars($order['id'] ?? '');
                                            ?>
                                            <tr>
                                                <td><?php echo $customer; ?></td>
                                                <td><?php echo $orderCode; ?></td>
                                                <td><?php echo $createdAt; ?></td>
                                                <td><?php echo $total; ?></td>
                                                <td><?php echo $status; ?></td>
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="order-detail.php?id=<?php echo $id; ?>">
                                                        Xem thêm
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">Bảng chưa có Data</td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
</body>

<script>

function logout()
    {
        localStorage.removeItem('userData')
        localStorage.removeItem('jwtToken')

    }
    document.getElementById('span-avatar').innerText = 'Hi ' + JSON.parse(localStorage.getItem('userData')).lastName
    if (JSON.parse(localStorage.getItem('userData')).roleId !== "3") {
    document.querySelectorAll('.hidden-user').forEach(element => {
        element.style.display = "none";
    });
}

</script>

</html>
