
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kiểm tra và lấy token từ cookie hoặc localStorage
$token = isset($_COOKIE['jwtToken']) ? $_COOKIE['jwtToken'] : '';

$url = 'http://localhost:8000/api/get-category-by-id'; // URL của API backend

// Tạo body của yêu cầu với id = "ALL"
$data = json_encode(['id' => 'ALL']);

// Khởi tạo context để gửi yêu cầu HTTP
$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => "Authorization: Bearer $token\r\n" . // Thêm token vào header Authorization
                    "Content-Type: application/json\r\n", // Đặt kiểu nội dung là JSON
        'content' => $data, // Thêm dữ liệu vào body của yêu cầu
        'ignore_errors' => true, // Bắt mọi lỗi, không chỉ lỗi không thể kết nối
    ]
]);

// Gửi yêu cầu POST đến backend và nhận nội dung phản hồi
$response = @file_get_contents($url, false, $context);

// Kiểm tra nếu có lỗi khi lấy dữ liệu từ backend
if ($response === FALSE) {
    // Lấy thông tin chi tiết về lỗi
    $error = error_get_last();
    die('Lỗi khi lấy dữ liệu từ backend: ' . $error['message']);
}

// Chuyển đổi JSON thành mảng dữ liệu trong PHP
$data = json_decode($response, true);

// Kiểm tra nếu có lỗi khi chuyển đổi JSON

if ($data === null) {
    die('Lỗi khi chuyển đổi JSON: ' . json_last_error_msg());
}

// In ra dữ liệu để kiểm tra (debugging)
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
                <a class="navbar-brand" href="../index.html"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Thanh chức năng</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Tài khoản</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user"></i><a href="manage-user.php">Quản lý tài khoản</a></li>
                            <li><i class="fa fa-plus"></i><a href="add-user.html">Thêm tài khoản</a></li>
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

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <span id="span-avatar">Hi, John </span>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Đăng kí </a>
                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Đăng nhập </a>
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
                        <h1>Danh mục</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="manage-category.php">Danh mục</a></li>
                            <li class="active">Quản lý Danh mục</li>
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
                                <strong class="card-title">Bảng danh mục <strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên danh mục</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
            // Kiểm tra nếu dữ liệu có chứa key 'data'
            if (isset($data['data'])) {
                // Lặp qua dữ liệu và hiển thị trong bảng
                foreach ($data['data'] as $category) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($category['category']); ?></td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm" onclick="editCat('<?php echo htmlspecialchars($category['id']); ?>')">
                                <i class="fa fa-eraser"></i> Sửa
                            </button>
                            <button type="button" class="btn btn-danger btn-sm"  onclick="deleteCategory('<?php echo htmlspecialchars($category['id']); ?>', '<?php echo htmlspecialchars($category['category']); ?>')">
                                <i class="fa fa-ban"></i> Xoá
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="4">Không có dữ liệu</td></tr>';
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
    const editCat = async (id) => {
try {
    // Chuyển đến trang HTML khác với query parameter id
    window.location.href = `edit-category.html?id=${id}`;
} catch (error) {
    console.error('Error occurred:', error);
}
    }
</script>
<script>
    function logout()
    {
        localStorage.removeItem('userData')
        localStorage.removeItem('jwtToken')
    }

    const deleteCategory = async (id,name) => {
try {
    // Lấy giá trị ID từ thuộc tính data-id của phần tử
    // Hiển thị hộp thoại xác nhận
    const userConfirmed = confirm(`Bạn có chắc là muốn xoá danh mục ${name} ?`);
    if (!userConfirmed) {
        // Người dùng chọn không xóa
        return;
    }

    
    let userId={
        id:id
    }

    const xhr = new XMLHttpRequest();
    xhr.open('DELETE', `http://localhost:8000/api/delete-category`, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    const token = localStorage.getItem('jwtToken');
    xhr.setRequestHeader('Authorization', `Bearer ${token}`);

    // Định nghĩa hàm callback khi yêu cầu thay đổi trạng thái
    xhr.onload = function() {
        document.getElementById('loadingOverlay').style.display = 'none';
            try {
                var responseData = JSON.parse(xhr.responseText);
                if (xhr.status === 200 && responseData.errCode === 0) { // Kiểm tra nếu mã trạng thái là 201 (Created)
                    alert('Xoá thành công')
                    window.location.href = "manage-category.php";
            } else {
                alert(responseData.errMessage)
            }
            } catch (error) {
                console.log(error)
                alert('Lỗi sever');
            }
        };
        xhr.onerror = function () {
            console.error('Request failed');
            alert('Có lỗi xảy ra khi gửi yêu cầu. Vui lòng thử lại sau.');
            document.getElementById('loadingOverlay').style.display = 'none';
               };
        document.getElementById('loadingOverlay').style.display = 'flex';
    // Gửi yêu cầu
    xhr.send(JSON.stringify(userId));
} catch (error) {
    console.error('An error occurred while trying to delete the user:', error);
}
};
</script>

</html>
