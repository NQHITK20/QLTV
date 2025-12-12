<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trả về - Xác nhận đơn hàng</title>
    <link rel="stylesheet" href="admin-ui/vendors/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="admin-ui/assets/css/style.css" />
    <style>
        body { background:#f8f9fa; }
        .notice { max-width:760px; margin:48px auto; }
    </style>
</head>
<body>
    <div class="container notice">
        <div class="card p-4">
            <div class="text-center mb-3">
                <a href="index.php"><img src="admin-ui/images/logo.png" alt="Logo" style="max-height:56px;"></a>
            </div>
            <h3 class="mb-3">Đơn hàng đã được lưu</h3>
            <p class="lead">Đơn hàng của bạn đã được lưu và đang chờ xác nhận.</p>
            <p>Vui lòng kiểm tra email để nhận thông tin đơn hàng nếu đơn được duyệt. Nếu không thấy email trong hộp thư chính, vui lòng kiểm tra thư mục Spam hoặc Junk.</p>
            <?php
                $orderId = '';
                if (!empty($_GET['orderId'])) {
                    $orderId = htmlspecialchars($_GET['orderId'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                }
            ?>
            <?php if($orderId): ?>
                <div class="alert alert-info">Mã đơn hàng: <strong><?php echo "COD - " . $orderId; ?></strong></div>
            <?php endif; ?>

            <div class="mt-3">
                <a href="index.php" class="btn btn-primary">Về trang chủ</a>
                <a href="orders.php" class="btn btn-outline-secondary">Xem đơn hàng của tôi</a>
            </div>
        </div>
    </div>

    <script src="admin-ui/vendors/jquery/dist/jquery.min.js"></script>
    <script src="admin-ui/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="admin-ui/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
