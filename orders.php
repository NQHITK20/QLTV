<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <title>Book Library</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/transitions.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">
	<style>
	/* Cart table column sizing for better layout */
	.table.cart-table td, .table.cart-table th{vertical-align:middle;white-space:normal}
	.table.cart-table td img{width:70px;height:auto;display:block}
	/* Columns: 1=STT, 2=Ảnh, 3=Tên sách, 4=Giá, 5=Số lượng, 6=Thành tiền, 7=Hành động */
	.table.cart-table th:nth-child(1), .table.cart-table td:nth-child(1){width:5%}
	.table.cart-table th:nth-child(2), .table.cart-table td:nth-child(2){width:18%}
	.table.cart-table th:nth-child(3), .table.cart-table td:nth-child(3){width:35%}
	.table.cart-table th:nth-child(4), .table.cart-table td:nth-child(4){width:12%}
	.table.cart-table th:nth-child(5), .table.cart-table td:nth-child(5){width:8%}
	.table.cart-table th:nth-child(6), .table.cart-table td:nth-child(6){width:15%}
	.table.cart-table th:nth-child(7), .table.cart-table td:nth-child(7){width:7%}
	@media (max-width: 767px){
		.table.cart-table thead{display:none}
		.table.cart-table tr{display:block;margin-bottom:10px}
		.table.cart-table td{display:block;text-align:left}
	}
	</style>
	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<?php
require_once __DIR__ . '/config.php';

// Compute frontend absolute base (e.g. http://localhost/QLTV-ChatboxAi/frontend)
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$siteBase = rtrim($scheme . $host, '/') . '/QLTV-ChatboxAi/frontend';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = rtrim(BACKEND_URL, '/') . '/api/get-category-by-id'; // URL của API backend

// Dữ liệu gửi đi
$datacat = array('id' => 'CatAndCount');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData = json_encode($datacat);

// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curlToken = isset($_COOKIE['token']) ? $_COOKIE['token'] : '';
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer ' . $curlToken
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Thực hiện yêu cầu POST và nhận phản hồi
$response2 = curl_exec($ch);

// Kiểm tra nếu có lỗi khi gửi yêu cầu
if ($response2 === FALSE) {
    die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
}

// Đóng cURL
curl_close($ch);

// Chuyển đổi JSON thành mảng dữ liệu trong PHP
$data2 = json_decode($response2, true);

// Kiểm tra nếu có lỗi khi chuyển đổi JSON
if ($data2 === null) {
    die('Lỗi khi chuyển đổi JSON');
}


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = rtrim(BACKEND_URL, '/') . '/api/get-news'; // URL của API backend

// Dữ liệu gửi đi
$datanew = array('id' => 'F7');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData = json_encode($datanew);

// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curlToken = isset($_COOKIE['token']) ? $_COOKIE['token'] : '';
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer ' . $curlToken
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Thực hiện yêu cầu POST và nhận phản hồi
$response3 = curl_exec($ch);

// Kiểm tra nếu có lỗi khi gửi yêu cầu
if ($response3 === FALSE) {
    die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
}

// Đóng cURL
curl_close($ch);

// Chuyển đổi JSON thành mảng dữ liệu trong PHP
$data3 = json_decode($response3, true);

// Kiểm tra nếu có lỗi khi chuyển đổi JSON
if ($data3 === null) {
    die('Lỗi khi chuyển đổi JSON');
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = rtrim(BACKEND_URL, '/') . '/api/get-fvbook'; // URL của API backend

// Lấy dữ liệu từ cookies
$idusername = $_COOKIE['idusername'] ?? null;

if ($idusername) {
    // Dữ liệu để gửi
    $datanew4 = array('idusername' => $idusername);

    // Chuyển đổi mảng dữ liệu thành JSON
    $jsonData4 = json_encode($datanew4);

    // Cấu hình cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curlToken = isset($_COOKIE['token']) ? $_COOKIE['token'] : '';
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: ' . 'Bearer ' . $curlToken
	));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData4);

    // Thực hiện yêu cầu POST và nhận phản hồi
    $response4 = curl_exec($ch);

    // Kiểm tra nếu có lỗi khi gửi yêu cầu
    if ($response4 === FALSE) {
        die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
    }

    // Đóng cURL
    curl_close($ch);

    // Chuyển đổi JSON thành mảng dữ liệu trong PHP
    $data4 = json_decode($response4, true);

    // Kiểm tra nếu có lỗi khi chuyển đổi JSON
    if ($data4 === null) {
        die('Lỗi khi chuyển đổi JSON');
    }
}

?>

<body>
	<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
		<!--************************************
				Header Start
		*************************************-->
		<header id="tg-header" class="tg-header tg-headervtwo tg-haslayout">
			<div class="tg-topbar">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="tg-addnav">
								<li>
									<a href="javascript:void(0);">
										<i class="icon-envelope"></i>
										<em>Liên hệ</em>
									</a>
								</li>
								<li>
									<a href="javascript:void(0);">
										<i class="icon-user"></i>
										<em>Về chúng tôi</em>
									</a>
								</li>
							</ul>
							<div class="tg-userlogin">
								<figure><a href="javascript:void(0);"><img src="<?php echo htmlspecialchars($siteBase . '/images/users/img-01.jpg'); ?>" alt="image description"></a></figure>
								<span onclick="profileBar()" class="dropbtn">Hi, John</span>
								<div id="myDropdown" class="dropdown-content">								
									<a href="#about"><i class="icon-exit" ></i> Đăng xuất</a>
								  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tg-middlecontainer">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<strong class="tg-logo"><a href="index.html"><img src="<?php echo htmlspecialchars($siteBase . '/images/logo.png'); ?>" alt="company name here"></a></strong>
							<div class="tg-searchbox">
								<form class="tg-formtheme tg-formsearch" id="searchForm">
									<fieldset>
										<input type="text" name="search" class="typeahead form-control" placeholder="Sách hay..." >
										<button type="submit" class="tg-btn">Search</button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tg-navigationarea">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="tg-navigationholder">
								<nav id="tg-nav" class="tg-nav">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>
									<div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
										<ul>
										<li class="menu-item-has-children menu-item-has-mega-menu">
											<a href="javascript:void(0);">Danh mục</a>
											<div class="mega-menu">
												<ul class="tg-themetabnav" role="tablist">
													<li role="presentation" class="active">
														<a href="#artandphotography" aria-controls="artandphotography" role="tab" data-toggle="tab">Art &amp; Photography</a>
													</li>
													<li role="presentation">
														<a href="#biography" aria-controls="biography" role="tab" data-toggle="tab">Biography</a>
													</li>
													<li role="presentation">
														<a href="#childrensbook" aria-controls="childrensbook" role="tab" data-toggle="tab">Children’s Book</a>
													</li>
													<li role="presentation">
														<a href="#craftandhobbies" aria-controls="craftandhobbies" role="tab" data-toggle="tab">Craft &amp; Hobbies</a>
													</li>
													<li role="presentation">
														<a href="#crimethriller" aria-controls="crimethriller" role="tab" data-toggle="tab">Crime &amp; Thriller</a>
													</li>
													<li role="presentation">
														<a href="#fantasyhorror" aria-controls="fantasyhorror" role="tab" data-toggle="tab">Fantasy &amp; Horror</a>
													</li>
													<li role="presentation">
														<a href="#fiction" aria-controls="fiction" role="tab" data-toggle="tab">Fiction</a>
													</li>
													<li role="presentation">
														<a href="#fooddrink" aria-controls="fooddrink" role="tab" data-toggle="tab">Food &amp; Drink</a>
													</li><li role="presentation">
														<a href="#graphicanimemanga" aria-controls="graphicanimemanga" role="tab" data-toggle="tab">Graphic, Anime &amp; Manga</a>
													</li>
													<li role="presentation">
														<a href="#sciencefiction" aria-controls="sciencefiction" role="tab" data-toggle="tab">Science Fiction</a>
													</li>
												</ul>
												<div class="tab-content tg-themetabcontent">
													<div role="tabpanel" class="tab-pane active" id="artandphotography">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
													<div role="tabpanel" class="tab-pane" id="biography">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
													<div role="tabpanel" class="tab-pane" id="childrensbook">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
													<div role="tabpanel" class="tab-pane" id="craftandhobbies">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
													<div role="tabpanel" class="tab-pane" id="crimethriller">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
													<div role="tabpanel" class="tab-pane" id="fantasyhorror">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
													<div role="tabpanel" class="tab-pane" id="fiction">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
													<div role="tabpanel" class="tab-pane" id="fooddrink">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
													<div role="tabpanel" class="tab-pane" id="graphicanimemanga">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
													<div role="tabpanel" class="tab-pane" id="sciencefiction">
														<ul>
															<li>
																<div class="tg-linkstitle">
																	<h2>History</h2>
																</div>
																<ul>
																	<li><a href="products.php">Veniam quis nostrud</a></li>
																	<li><a href="products.php">Exercitation</a></li>
																	<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																	<li><a href="products.php">Commodo conseat</a></li>
																	<li><a href="products.php">Duis aute irure</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Architecture</h2>
																</div>
																<ul>
																	<li><a href="products.php">Tough As Nails</a></li>
																	<li><a href="products.php">Pro Grease Monkey</a></li>
																	<li><a href="products.php">Building Memories</a></li>
																	<li><a href="products.php">Bulldozer Boyz</a></li>
																	<li><a href="products.php">Build Or Leave On Us</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
															<li>
																<div class="tg-linkstitle">
																	<h2>Art Forms</h2>
																</div>
																<ul>
																	<li><a href="products.php">Consectetur adipisicing</a></li>
																	<li><a href="products.php">Aelit sed do eiusmod</a></li>
																	<li><a href="products.php">Tempor incididunt labore</a></li>
																	<li><a href="products.php">Dolore magna aliqua</a></li>
																	<li><a href="products.php">Ut enim ad minim</a></li>
																</ul>
																<a class="tg-btnviewall" href="products.php">View All</a>
															</li>
														</ul>
														<ul>
															<li>
																<figure><img src="<?php echo htmlspecialchars($siteBase . '/images/img-01.png'); ?>" alt="image description"></figure>
																<div class="tg-textbox">
																	<h3>More Than<span>12,0657,53</span>Books Collection</h3>
																	<div class="tg-description">
																		<p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
																	</div>
																	<a class="tg-btn" href="products.php">view all</a>
																</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</li>
										<li class="menu-item-has-children">
											<a href="javascript:void(0);">Home</a>
										</li>
										<li class="menu-item-has-children">
											<a href="javascript:void(0);">Sách hay</a>
										</li>
										<li><a href="products.php">Tin tức</a></li>
									</div>
								</nav>
								<div class="tg-wishlistandcart">
									<div class="dropdown tg-themedropdown tg-wishlistdropdown">
										<a href="javascript:void(0);" id="tg-wishlisst" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="tg-themebadge">3</span>
											<i class="icon-heart"></i>
										</a>
										<div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-wishlisst">
											<div class="tg-description"><p>Chưa có sách yêu thích nào</p></div>
										</div>
									</div>
									<div class="dropdown tg-themedropdown tg-minicartdropdown">
										<a href="javascript:void(0);" id="tg-minicart" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="tg-themebadge">3</span>
											<i class="icon-books"></i>
										</a>
										<div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-minicart">
											<div class="tg-minicartbody">
												<div class="tg-minicarproduct">
													<figure>
														<img src="<?php echo htmlspecialchars($siteBase . '/images/products/img-01.jpg'); ?>" alt="image description">
														
													</figure>
													<div class="tg-minicarproductdata">
														<h5><a href="javascript:void(0);">Our State Fair Is A Great Function</a></h5>
														<h6><a href="javascript:void(0);">Tiểu thuyết</a></h6>
													</div>
												</div>
												<div class="tg-minicarproduct">
													<figure>
														<img src="<?php echo htmlspecialchars($siteBase . '/images/products/img-02.jpg'); ?>" alt="image description">
													</figure>
													<div class="tg-minicarproductdata">
														<h5><a href="javascript:void(0);">Bring Me To Light</a></h5>
														<h6><a href="javascript:void(0);">Tiểu thuyết</a></h6>
													</div>
												</div>
												<div class="tg-minicarproduct">
													<figure>
														<img src="<?php echo htmlspecialchars($siteBase . '/images/products/img-03.jpg'); ?>" alt="image description">
													</figure>
													<div class="tg-minicarproductdata">
														<h5><a href="javascript:void(0);">Have Faith In Your Soul</a></h5>
														<h6><a href="javascript:void(0);">Tiểu thuyết</a></h6>
													</div>
												</div>
											</div>
												<div class="tg-minicartfoot">
													<span class="tg-subtotal">Trong giỏ: <strong id="miniCartCount">0</strong></span>
													<div class="tg-btns">
														<a class="tg-btn" href="products.php">Xem giỏ</a>
														<a class="tg-btn" href="javascript:void(0);">Đóng</a>
													</div>
												</div>
										</div>
									</div>
									<div class="dropdown tg-themedropdown tg-wishlistdropdown">
										<a href="javascript:void(0);" id="tg-wishlisst" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="tg-themebadge">3</span>
											<i class="icon-bell"></i>
										</a>
										<div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-wishlisst">
											<div class="tg-description"><p>Không có thông báo nào</p></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header> 
		<!--************************************
				Header End
		*************************************-->
		<!--************************************
				Inner Banner Start
		*************************************-->
		<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?php echo htmlspecialchars($siteBase . '/images/parallax/bgparallax-07.jpg'); ?>">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="tg-innerbannercontent">
							<h1>Sách</h1>
							<ol class="tg-breadcrumb">
								<li><a href="javascript:void(0);">home</a></li>
								<li class="tg-active">Sách</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--************************************
				Inner Banner End
		*************************************-->
		<!--************************************
				Main Start
		*************************************-->
		<main id="tg-main" class="tg-main tg-haslayout">
			<!--************************************
					News Grid Start
			*************************************-->
			<div class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div id="tg-twocolumns" class="tg-twocolumns">
							<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 pull-right">
								<div id="tg-content" class="tg-content">
									<div class="tg-products">
											<div class="tg-sectionhead">
												<h2>Sách Đã Đặt</h2>
											</div>
										<div class="tg-productgrid">
											<div id="ordersRoot" class="container-fluid px-0">
												<?php if (empty($idusername)) { ?>
													<p class="empty-note">Vui lòng đăng nhập để xem đơn hàng của bạn.</p>
												<?php } else { ?>
													<div class="table-responsive" style="margin-top:12px;">
														<table class="table table-striped" id="ordersTableStatic">
															<thead>
																<tr>
																	<th>STT</th>
																	<th>Ảnh</th>
																	<th>Tên sách</th>
																	<th>Giá</th>
																	<th style="width:120px">Số lượng</th>
																	<th>Tổng</th>
																	<th>Trạng thái</th>
																</tr>
															</thead>
															<tbody id="ordersStaticBody">
																<tr>
																	<td colspan="7" style="text-align:center;color:#666;padding:28px 0;">Đang kiểm tra đơn hàng...</td>
																</tr>
															</tbody>
														</table>
														<script>
														(function(){
															function getCookie(name){
																const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
																return match ? decodeURIComponent(match[2]) : null;
															}
															function fmtMoney(n){ try { return (Number(n)||0).toLocaleString('en-US',{style:'currency',currency:'USD'}); } catch(e) { return String(n); } }
															const token = getCookie('token');
															const api = (function(){ try{ return window.BACKEND_URL || '<?php echo rtrim(BACKEND_URL, "/"); ?>'; }catch(e){ return '<?php echo rtrim(BACKEND_URL, "/"); ?>'; } })();
															const tbody = document.getElementById('ordersStaticBody');
															const table = document.getElementById('ordersTableStatic');
								
															fetch(api + '/api/orders/get-order', {
																method: 'POST',
																headers: Object.assign({ 'Content-Type': 'application/json' }, token ? { 'Authorization': 'Bearer ' + token } : {}),
																credentials: 'include',
																body: JSON.stringify({})
															}).then(function(r){ return r.json(); }).then(function(json){
																if (!json || json.errCode !== 0 || !Array.isArray(json.data) || json.data.length === 0){
																	tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:#666;padding:28px 0;">Bạn chưa có đơn hàng.</td></tr>';
																	table.style.display = '';
																	return;
																}
																// render rows (per-item). Use statusText (VN) when available
																let rows = '';
																let counter = 1;
																json.data.forEach(function(order){
																	const status = order.statusText || order.status || 'Chưa rõ';
																	(order.items||[]).forEach(function(it){
																		const img = it.image ? ('images/books/' + encodeURIComponent(it.image)) : 'images/books/no-image.png';
																		rows += '<tr>' +
																			'<td>' + (counter++) + '</td>' +
																			'<td><img src="' + img + '" style="max-width:80px;"/></td>' +
																			'<td>' + (it.bookname || '-') + '</td>' +
																			'<td>' + fmtMoney(it.unitPrice || it.price || 0) + '</td>' +
																			'<td>' + (it.quantity || 0) + '</td>' +
																			'<td>' + fmtMoney(it.subtotal || ((it.unitPrice||0)*(it.quantity||0))) + '</td>' +
																			'<td>' + status + '</td>' +
																		'</tr>';
																	});
																});
																tbody.innerHTML = rows || '<tr><td colspan="7" style="text-align:center;color:#666;padding:28px 0;">Bạn chưa có đơn hàng.</td></tr>';
																table.style.display = '';
															}).catch(function(err){
																console.error('orders fetch error', err);
																tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:#666;padding:28px 0;">Không thể tải đơn hàng.</td></tr>';
																table.style.display = '';
															});
														})();
														</script>
														</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 pull-left">
								<aside id="tg-sidebar" class="tg-sidebar">
									<div class="tg-widget tg-catagories">
										<div class="tg-widgettitle">
											<h3>Danh mục</h3>
										</div>
										<div class="tg-widgetcontent">
											<ul>
												<?php 
												foreach($data2['data'] as $cat) {?>
												<li><a href="<?php echo $cat['category'] ?>"><span> <?php echo $cat['category'] ?></span><em><?php echo $cat['booksCount'] ?></em></a></li>
												<?php }?>
											</ul>
										</div>
									</div>
									<div class="tg-widget tg-widgettrending">
										<div class="tg-widgettitle">
											<h3>Tin tức mới nhất</h3>
										</div>
										<div class="tg-widgetcontent">
											<ul>
												<?php foreach($data3['data'] as $new){?>
												<li>
													<article class="tg-post">
														<figure style="width:112px;"><a style="width:100px;" href="newsdetail.php?id=<?php echo $new['id']?>" alt="<?php echo htmlspecialchars($new['image']); ?>"><img src="<?php echo htmlspecialchars($siteBase . '/images/blog/' . rawurlencode($new['image'])); ?>" alt="<?php echo htmlspecialchars($new['image']); ?>"></a></figure>
														<div class="tg-postcontent">
															<div class="tg-posttitle">
																<h3><a href="newsdetail.php?id=<?php echo $new['id']?>"><?php echo $new['title']?></a></h3>
															</div>
															<span class="tg-bookwriter"> <a><?php echo $new['author'] ?></a></span>
														</div>
													</article>
												</li>
												<?php }?>
											</ul>
										</div>
									</div>
								</aside>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--************************************
					News Grid End
			*************************************-->
		</main>
		<!--************************************
				Main End
		*************************************-->
		<!--************************************
				Footer Start
		*************************************-->
		<footer id="tg-footer" class="tg-footer tg-haslayout">
			<div class="tg-footerarea">
				<div class="container">
					<div class="row">
						<div class="tg-threecolumns">
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<div class="tg-footercol">
									<strong class="tg-logo"><a href="javascript:void(0);"><img src="<?php echo htmlspecialchars($siteBase . '/images/flogo.png'); ?>" alt="image description"></a></strong>
									<ul class="tg-contactinfo">
										<li>
											<i class="icon-location"></i>
											<address>Suit # 07, Rose world Building, Street # 02, AT246T Manchester</address>
										</li>
										<li>
											<i class="icon-phone-handset"></i>
											<span>
												<em>0800 12345 - 678 - 89</em>
												<em>+4 1234 - 4567 - 67</em>
											</span>
										</li>
										<li>
											<i class="icon-clock"></i>
											<span>Serving 7 Days A Week From 9am - 5pm</span>
										</li>
										<li>
											<i class="icon-envelope"></i>
											<span>
												<em><a href="mailto:support@domain.com">support@domain.com</a></em>
												<em><a href="mailto:info@domain.com">info@domain.com</a></em>
											</span>
										</li>
									</ul>
									<ul class="tg-socialicons">
										<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
										<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
										<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
										<li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
										<li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<div class="tg-footercol tg-widget tg-widgetnavigation">
									<div class="tg-widgettitle">
										<h3>Thông tin thư viện</h3>
									</div>
									<div class="tg-widgetcontent">
										<ul>
											<li><a href="javascript:void(0);">Liên hệ</a></li>
											<li><a href="javascript:void(0);">Về chúng tôi</a></li>
										</ul>
										<ul>
											<li><a href="javascript:void(0);">Danh mục</a></li>
											<li><a href="javascript:void(0);">Sách hay</a></li>
											<li><a href="javascript:void(0);">Về chúng tôi</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="tg-footercol tg-widget tg-widgettopsellingauthors">
									<div class="tg-widgettitle">
										<h3>Địa chỉ thư viện</h3>
									</div>
									<div class="tg-widgetcontent">
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2638.664976961357!2d-69.06455608412711!3d44.21158417910234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ca0e5c836af9b19%3A0x86e1a4918bb4fa0!2sCamden%20Public%20Library!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus
" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tg-footerbar">
				<a id="tg-btnbacktotop" class="tg-btnbacktotop" href="javascript:void(0);"><i class="icon-chevron-up"></i></a>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<span class="tg-copyright">2017 All Rights Reserved By &copy; Book Library</span>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!--************************************
				Footer End
		*************************************-->
	</div>
	<!--************************************
			Wrapper End
	*************************************-->
	<script src="js/vendor/jquery-library.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=vi"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.vide.min.js"></script>
	<script src="js/countdown.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/parallax.js"></script>
	<script src="js/countTo.js"></script>
	<script src="js/appear.js"></script>
	<script src="js/gmap3.js"></script>
	<script src="js/main.js"></script>
	<?php $serverToken = isset($_COOKIE['token']) ? $_COOKIE['token'] : ''; ?>
	<script>
	window.APP_CONFIG = window.APP_CONFIG || {};
	window.APP_CONFIG.backendUrl = '<?php echo rtrim(BACKEND_URL, "/"); ?>';
	window.SERVER_TOKEN = '<?php echo htmlspecialchars($serverToken, ENT_QUOTES); ?>';
	// Inject server-side known user id (from cookie) so client can call get-saved-cart without a token
	window.SERVER_USERID = '<?php echo isset($idusername) ? htmlspecialchars($idusername, ENT_QUOTES) : ''; ?>';
	</script>

	<script>
		async function loadSavedCart() {
			const user = JSON.parse(localStorage.getItem('userData') || 'null');
			// Prefer localStorage token, fall back to injected server token (from cookie) or readable cookie
			let token = localStorage.getItem('jwtToken') || window.SERVER_TOKEN || null;
			const serverUserId = window.SERVER_USERID || null;
		if (!token) {
				// try to read cookie (only works if not HttpOnly)
				const match = document.cookie.match(new RegExp('(^| )token=([^;]+)'));
				if (match) token = match[2];
		}
		
		const cartBody = document.getElementById('cartBody');
		const cartCountEl = document.getElementById('cartCount');
		const cartTotalEl = document.getElementById('cartTotal');

				if (!user && !token && !serverUserId) {
					cartBody.innerHTML = '<tr><td colspan="7">Vui lòng đăng nhập để xem giỏ hàng.</td></tr>';
				cartCountEl.textContent = '0';
				cartTotalEl.textContent = formatCurrency(0);
				return;
			}

			const backendBase = (window.APP_CONFIG && window.APP_CONFIG.backendUrl) ? String(window.APP_CONFIG.backendUrl).replace(/\/$/, '') : 'http://localhost:8000';
			// Use relative frontend image path to match `index.php` (images/books/filename)
			const frontendBase = '';
			const url = `${backendBase}/api/get-saved-cart`;
			try {
				let resp;
				let result = null;
				let respErr = null;
				// Try token GET first (if token supplied), otherwise POST with userId
				if (token) {
					try {
						let respGet = await fetch(url, { method: 'GET', headers: { 'Authorization': 'Bearer ' + token } });
						if (respGet.ok) {
							result = await respGet.json();
						}
						// if GET returned non-ok, fallthrough to POST fallback below
					} catch (e) { respErr = e; }
				}
				// If we still don't have a successful result, try POST with serverUserId
				if (!result && serverUserId) {
					try {
						let respPost = await fetch(url, {
							method: 'POST',
							headers: { 'Content-Type': 'application/json' },
							body: JSON.stringify({ userId: serverUserId })
						});
						if (respPost.ok) result = await respPost.json();
					} catch (e) { respErr = respErr || e; }
				}
				if (!result) {
					console.error('loadSavedCart: fetch failed', respErr);
						cartBody.innerHTML = '<tr><td colspan="7">Lỗi khi tải giỏ hàng.</td></tr>';
					cartCountEl.textContent = '0';
					cartTotalEl.textContent = '0$';
					return;
				}

				if (result.errCode !== 0) {
						cartBody.innerHTML = `<tr><td colspan="7">Lỗi khi tải giỏ: ${escapeHtml(result.errMessage || result.message || 'Không xác định')}</td></tr>`;
					cartCountEl.textContent = '0';
					cartTotalEl.textContent = '0$';
					return;
				}

				const items = Array.isArray(result.data) ? result.data : (result.data && result.data.items) ? result.data.items : [];
				if (items.length === 0) {
					cartBody.innerHTML = '<tr><td colspan="7">Giỏ hàng trống.</td></tr>';
				cartCountEl.textContent = '0';
				cartTotalEl.textContent = '0$';
				return;
			}

			let html = '';
			let total = 0;
			let totalCount = 0;
				items.forEach((it, idx) => {
				const img = it.image ? `images/books/${escapeHtml(it.image)}` : `images/books/no-image.png`;
						const name = escapeHtml(it.bookname || it.bookName || it.bookname || 'Không tên');
						const qty = Number(it.quantity || it.qty || 1);
						const price = Number(it.price || 0);
						const subtotal = (price * qty) || Number(it.subtotal || 0) || 0;
				total += subtotal;
				totalCount += qty;
						html += `<tr data-cartitemid="${escapeHtml(it.id || it.bookId || '')}">` +
							`<td>${idx + 1}</td>` +
							`<td><img src="${img}" alt=""/></td>` +
							`<td>${name}</td>` +
							`<td>${formatCurrency(price)}</td>` +
							`<td><input type="number" class="form-control qty-input" value="${qty}" min="1" style="width:80px;"></td>` +
							`<td>${formatCurrency(subtotal)}</td>` +
							`<td><button class="btn btn-sm btn-danger btn-remove">X</button></td>` +
						`</tr>`;
			});

			cartBody.innerHTML = html;
			cartCountEl.textContent = totalCount;
			cartTotalEl.textContent = formatCurrency(total);

			// Attach simple handlers: qty change (local only) and remove (local only)
			document.querySelectorAll('#cartBody .qty-input').forEach((input, i) => {
				input.addEventListener('change', (e) => {
					let v = parseInt(e.target.value) || 1;
					if (v < 1) v = 1;
					e.target.value = v;
					// Recompute subtotal and total locally
					const row = e.target.closest('tr');
					// Price text is formatted like "$1,234.56". Remove currency symbol and
					// thousands separators, then parse as float so cents are preserved.
					const rawPrice = (row.children[3].textContent || '').replace(/[^0-9.\-]+/g, '') || '0';
					const price = parseFloat(rawPrice) || 0;
					const newSubtotal = price * v;
					row.children[5].textContent = formatCurrency(newSubtotal);

					// Recalculate summary (total amount and total item count)
					recalcCartSummary();
				});
			});

			// Setup remove button to call backend delete API
			document.querySelectorAll('#cartBody .btn-remove').forEach(btn => {
				btn.addEventListener('click', async (e) => {
					const row = e.target.closest('tr');
					const cartItemId = row && (row.dataset.cartitemid || row.getAttribute('data-cartitemid'));
					if (!cartItemId) {
						alert('Không xác định được id của mục giỏ.');
						return;
					}
					if (!confirm('Bạn có chắc muốn xóa mục này không?')) return;
					try {
						const token = localStorage.getItem('jwtToken') || window.SERVER_TOKEN || (document.cookie.match(/(^| )token=([^;]+)/) || [])[2] || '';
						const backendBase = (window.APP_CONFIG && window.APP_CONFIG.backendUrl) ? String(window.APP_CONFIG.backendUrl).replace(/\/$/, '') : 'http://localhost:8000';
						// determine userId to send: prefer localStorage userData, then injected SERVER_USERID
						const userObj = JSON.parse(localStorage.getItem('userData') || 'null');
						const userIdToSend = (userObj && userObj.id) ? userObj.id : (window.SERVER_USERID || '');
						const resp = await fetch(`${backendBase}/api/delete-cartitem`, {
							method: 'POST',
							headers: Object.assign({'Content-Type': 'application/json'}, token ? { 'Authorization': 'Bearer ' + token } : {}),
							body: JSON.stringify({ cartItemId: cartItemId, userId: userIdToSend })
						});
						const result = await resp.json();
						if (result && result.errCode === 0) {
							// remove row and recalc totals
							row.parentNode.removeChild(row);
							recalcCartSummary();
							// update header/cart badge(s)
							const badges = document.querySelectorAll('.tg-wishlistdropdown .tg-themebadge');
							badges.forEach(b => b.textContent = result.itemCount || 0);
							return;
						} else {
							alert('Xóa thất bại: ' + (result.errMessage || result.message || 'Không xác định'));
						}
					} catch (err) {
						console.error('deleteCartItem error', err);
						alert('Lỗi khi xóa mục. Vui lòng thử lại.');
					}
				});
			});

			// Clear all button
			const btnClear = document.getElementById('btnClear');
			if (btnClear) {
				btnClear.addEventListener('click', async function () {
					if (!confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng không?')) return;
					try {
						const token = localStorage.getItem('jwtToken') || window.SERVER_TOKEN || (document.cookie.match(/(^| )token=([^;]+)/) || [])[2] || '';
						const backendBase = (window.APP_CONFIG && window.APP_CONFIG.backendUrl) ? String(window.APP_CONFIG.backendUrl).replace(/\/$/, '') : 'http://localhost:8000';
						const userObj = JSON.parse(localStorage.getItem('userData') || 'null');
						const userIdToSend = (userObj && userObj.id) ? userObj.id : (window.SERVER_USERID || '');
						const resp = await fetch(`${backendBase}/api/delete-cartitem`, {
							method: 'POST',
							headers: Object.assign({'Content-Type': 'application/json'}, token ? { 'Authorization': 'Bearer ' + token } : {}),
							body: JSON.stringify({ cartItemId: 'ALL', userId: userIdToSend })
						});
						const result = await resp.json();
						if (result && result.errCode === 0) {
							// Clear table and update summary
							document.getElementById('cartBody').innerHTML = '<tr><td colspan="7">Giỏ hàng trống.</td></tr>';
							document.getElementById('cartCount').textContent = '0';
							document.getElementById('cartTotal').textContent = formatCurrency(0);
							const badges = document.querySelectorAll('.tg-wishlistdropdown .tg-themebadge');
							badges.forEach(b => b.textContent = '0');
							return;
						} else {
							alert('Xóa tất cả thất bại: ' + (result.errMessage || result.message || 'Không xác định'));
						}
					} catch (err) {
						console.error('clear cart error', err);
						alert('Lỗi khi xóa giỏ hàng. Vui lòng thử lại.');
					}
				});
			}

			function recalcCartSummary() {
				const cartBody = document.getElementById('cartBody');
				const rows = Array.from(cartBody.querySelectorAll('tr'));
				let total = 0;
				let count = 0;
				rows.forEach(r => {
					const qtyInput = r.querySelector('.qty-input');
					const qty = qtyInput ? (parseInt(qtyInput.value, 10) || 0) : 1;
					const subtotalText = r.children[5] ? r.children[5].textContent : '';
					const subtotal = parseFloat((subtotalText || '').replace(/[^0-9.\-]+/g, '')) || 0;
					total += subtotal;
					count += qty;
				});
				document.getElementById('cartCount').textContent = count;
				document.getElementById('cartTotal').textContent = (total ? formatCurrency(total) : formatCurrency(0));
			}

		} catch (err) {
			console.error('loadSavedCart error', err);
				cartBody.innerHTML = '<tr><td colspan="7">Lỗi khi tải giỏ hàng.</td></tr>';
		}
	}

	function formatCurrency(n) {
		if (!n && n !== 0) return '';
		return (Number(n) || 0).toLocaleString('en-US', { style: 'currency', currency: 'USD' });
	}

	function escapeHtml(s) { if (!s) return ''; return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;'); }

	document.addEventListener('DOMContentLoaded', function() {
		loadSavedCart();
		// btnCheckout behavior
		document.getElementById('btnCheckout').addEventListener('click', function() {
			try {
				const rows = Array.from(document.querySelectorAll('#cartBody tr'));
				const items = [];
				rows.forEach(r => {
					// skip placeholder rows
					if (!r.querySelector('.qty-input')) return;
					const cartItemId = r.dataset.cartitemid || r.getAttribute('data-cartitemid') || '';
					const name = (r.children[2] && r.children[2].textContent.trim()) || '';
					const rawPrice = (r.children[3] && r.children[3].textContent) ? r.children[3].textContent.replace(/[^0-9.\-]+/g,'') : '0';
					const unitPrice = parseFloat(rawPrice) || 0;
					const qtyInput = r.querySelector('.qty-input');
					const qty = qtyInput ? (parseInt(qtyInput.value, 10) || 1) : 1;
					const subtotal = unitPrice * qty;
					const imgEl = r.children[1] && r.children[1].querySelector('img');
					const image = imgEl ? imgEl.getAttribute('src') : '';
					items.push({ id: cartItemId, name, quantity: qty, unitPrice, subtotal, image });
				});
				if (items.length === 0) { alert('Giỏ hàng rỗng.'); return; }
				localStorage.setItem('checkoutCart', JSON.stringify({ items: items, savedAt: Date.now() }));
				window.location.href = 'checkout.html';
			} catch (err) {
				console.error('checkout redirect error', err);
				alert('Lỗi chuẩn bị đơn hàng. Vui lòng thử lại.');
			}
		});
	});
	</script>
	<script>
		/* When the user clicks on the button, 
		toggle between hiding and showing the dropdown content */
		function profileBar() {
		  document.getElementById("myDropdown").classList.toggle("show");
		}
		
		// Close the dropdown if the user clicks outside of it
		window.onclick = function(event) {
		  if (!event.target.matches('.dropbtn')) {
			let dropdowns = document.getElementsByClassName("dropdown-content");
			let i;
			for (i = 0; i < dropdowns.length; i++) {
			  let openDropdown = dropdowns[i];
			  if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			  }
			}
		  }
		}

		function setCookie(name, value, days) {
	var expires = "";
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = "; expires=" + date.toUTCString();
	}
	document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

		document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn hành động gửi biểu mẫu mặc định

        let searchQuery = document.querySelector('input[name="search"]').value;
		setCookie('tukhoa', searchQuery, 30);
        let url = `/QuanLyThuVien/findingbook.php?tukhoa=${encodeURIComponent(searchQuery)}`;
        
        // Điều hướng đến URL mới với từ khóa tìm kiếm
        window.location.href = url;
});
let targetDiv = document.getElementById('tg-main');
    if (targetDiv) {
        targetDiv.scrollIntoView({ behavior: 'smooth' });
    }
function setCookiesBook(category,bookId)
{
	setCookie('categoryBook', category, 30);
	setCookie('bookId', bookId, 30);
}

// Quick debug: log cookies and idusername for manual verification
(function(){
	function getCookie(name){
		const m = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
		return m ? m[2] : null;
	}
	console.log('DEBUG document.cookie ->', document.cookie);
	console.log('DEBUG idusername ->', getCookie('idusername'));
	if (!getCookie('idusername')) {
		console.warn('DEBUG: cookie "idusername" not found or is HttpOnly (not readable by JS)');
	}
})();

</body>
</html>