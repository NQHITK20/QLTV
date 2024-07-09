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
	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = 'http://localhost:8000/api/get-category-by-id'; // URL của API backend

// Dữ liệu gửi đi
$datacat = array('id' => 'CatAndCount');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData = json_encode($datacat);

// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer' // Thêm token vào header Authorization
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

$url = 'http://localhost:8000/api/get-news'; // URL của API backend

// Dữ liệu gửi đi
$datanew = array('id' => 'F7');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData = json_encode($datanew);

// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer' // Thêm token vào header Authorization
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

$url = 'http://localhost:8000/api/get-related-book'; // URL của API backend

if (isset($_COOKIE['categoryBook']) && isset($_COOKIE['bookId'])) {
    $categoryBook = $_COOKIE['categoryBook'];
    $bookId = $_COOKIE['bookId'];

    if ($categoryBook === null || $bookId === null) {
        // Xử lý lỗi giải mã JSON nếu cần
        echo "Lỗi: Không thể giải mã dữ liệu JSON từ cookie 'categoryBook' hoặc 'bookId'.";
    } else {
        // Sử dụng biến $categoryBook và $bookId
        $datanew4 = array('categoryBook' => $categoryBook, 'bookId' => $bookId);
        // Tiếp tục xử lý với mảng $datanew4
    }
} else {
    echo "Cookie 'categoryBook' hoặc 'bookId' không tồn tại.";
}

// Dữ liệu gửi đi

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData4 = json_encode($datanew4);

// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer' // Thêm token vào header Authorization
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

?>

<body>
<div class="overlay" id="loadingOverlay">
        <div class="spinner-border text-light" role="status">
            <span class="sr-only">Loading...</span>
        </div>
</div>
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
								<figure><a href="javascript:void(0);"><img src="images/users/img-01.jpg" alt="image description"></a></figure>
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
							<strong class="tg-logo"><a href="index.html"><img src="images/logo.png" alt="company name here"></a></strong>
							<div class="tg-searchbox">
								<form class="tg-formtheme tg-formsearch">
									<fieldset>
										<input type="text" name="search" class="typeahead form-control" placeholder="Tìm kiếm sách tốt . . .">
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
														<a href="#artandphotography" aria-controls="artandphotography" role="tab" data-toggle="tab">Art</a>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
																<figure><img src="images/img-01.png" alt="image description"></figure>
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
														<img src="images/products/img-01.jpg" alt="image description">
														
													</figure>
													<div class="tg-minicarproductdata">
														<h5><a href="javascript:void(0);">Our State Fair Is A Great Function</a></h5>
														<h6><a href="javascript:void(0);">Tiểu thuyết</a></h6>
													</div>
												</div>
												<div class="tg-minicarproduct">
													<figure>
														<img src="images/products/img-02.jpg" alt="image description">
													</figure>
													<div class="tg-minicarproductdata">
														<h5><a href="javascript:void(0);">Bring Me To Light</a></h5>
														<h6><a href="javascript:void(0);">Tiểu thuyết</a></h6>
													</div>
												</div>
												<div class="tg-minicarproduct">
													<figure>
														<img src="images/products/img-03.jpg" alt="image description">
													</figure>
													<div class="tg-minicarproductdata">
														<h5><a href="javascript:void(0);">Have Faith In Your Soul</a></h5>
														<h6><a href="javascript:void(0);">Tiểu thuyết</a></h6>
													</div>
												</div>
											</div>
											<div class="tg-minicartfoot">
												<span class="tg-subtotal">Đang mượn: <strong> 3</strong></span>
												<div class="tg-btns">
													<a class="tg-btn" href="javascript:void(0);">Xem thêm</a>
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
		<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
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
									<div class="tg-productdetail">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
												<div class="tg-postbook">
													<figure class="tg-featureimg"><img id="imageBook" alt="image description"></figure>
													<div class="tg-postbookcontent">
														<a class="tg-btnaddtowishlist" href="javascript:void(0);">
															<span>Thêm vào yêu thích</span>
														</a>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
												<div class="tg-productcontent">
													<ul class="tg-bookscategories">
														<li><a id="category"></a></li>
													</ul>
													<div class="tg-booktitle">
														<h3 id="bookName"></h3>
													</div>
													<span class="tg-bookwriter">Tác Giả: <a id="author"></a></span>
													
													<div class="tg-description">
														<p id="description"></p>
													</div>
												</div>
											</div>
											<div class="tg-relatedproducts">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<div class="tg-sectionhead">
														<h2><span>Sách liên quan</span>Bạn có thể quan tâm</h2>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<div id="tg-relatedproductslider" class="tg-relatedproductslider tg-relatedbooks owl-carousel">
													<?php foreach($data4['relatedbook'] as $book){
														
														?>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/<?php echo $book['image'] ?>" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/<?php echo $book['image'] ?>" alt="image description"></div>
																	</div>
																	<?php
						                                            $category = $book['category'];
						                                            $id = $book['id'];
						                                            // Sử dụng json_encode và htmlspecialchars để đảm bảo chuỗi an toàn cho JavaScript và HTML
						                                            $categoryJson = htmlspecialchars(json_encode($category), ENT_QUOTES, 'UTF-8');
						                                            $idJson = htmlspecialchars(json_encode($id), ENT_QUOTES, 'UTF-8');
						                                            ?>
																	<a class="tg-btnaddtowishlist" href="productdetail.php?id=<?php echo $idJson ?>" onClick="setCookiesBook(<?php echo $categoryJson ?>,<?php echo $idJson ?>)">
																		<span>Xem thêm</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a><?php echo $book['category'] ?></a></li>
																	</ul>
																	<div class="tg-booktitle">
																		<h3><a href="productdetail.php?id=<?php echo $idJson ?>" onClick="setCookiesBook(<?php echo $categoryJson ?>,<?php echo $idJson ?>)"><?php echo $book['bookName'] ?></a></h3>
																	</div>
																	<span class="tg-bookwriter"> <a><?php echo $book['author'] ?></a></span>																	
																</div>
															</div>
														</div>
														<?php }?>
													</div>
												</div>
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
														<figure style="width:112px;"><a style="width:100px;" href="newsdetail.php?id=<?php echo $new['id']?>" alt="<?php echo $new['image']?>"><img src="images/blog/<?php echo $new['image'] ?>" alt="<?php echo $new['image'] ?>"></a></figure>
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
									<strong class="tg-logo"><a href="javascript:void(0);"><img src="images/flogo.png" alt="image description"></a></strong>
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
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31128.146215294513!2d107.98092368277744!3d12.777324925658137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31720307f3b00899%3A0x7becd56a8bc51f81!2sQu%C3%A1n%20Chay%20Eabar!5e0!3m2!1svi!2s!4v1714987477736!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

function eraseCookie(name) {
	document.cookie = name + '=; Max-Age=-99999999;';
}

function fetchData() {
    document.getElementById('loadingOverlay').style.display = 'flex';
    return new Promise(function(resolve, reject) {
        let xhr = new XMLHttpRequest();
        let urlParams = new URLSearchParams(window.location.search);
        let bookId = urlParams.get('id');
        let bookData = {
            id:bookId
        }
        
        xhr.open("POST", "http://localhost:8000/api/get-all-book", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader('Authorization', 'Bearer');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                resolve(responseData);
             document.getElementById('loadingOverlay').style.display = 'none';
            }
        };
        xhr.send(JSON.stringify(bookData));
    });
}

document.addEventListener("DOMContentLoaded", async function() {
    try {
        const responseData = await fetchData();
        if (responseData) {
            document.getElementById("category").innerText = responseData.data.category;
            document.getElementById("bookName").innerText = responseData.data.bookName;
            document.getElementById("imageBook").src = "images/books/" + responseData.data.image;
            document.getElementById("author").innerText = responseData.data.author;
            document.getElementById("description").innerText = responseData.data.description;
        } 
    } catch (error) {
        console.error(error);
    }
});

function loadcookies(objJson,records_per_page) {
    let listing_data = [];
    for (let i = 0; i < records_per_page && i < objJson.data.length; i++) {
        listing_data.push(objJson.data[i]);
    }
	return listing_data;
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

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}


function eraseCookie(name) {
	document.cookie = name + '=; Max-Age=-99999999;';
}

function getCookieValue(cookieName) {
    let name = cookieName + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let cookieArray = decodedCookie.split(';');
    for(let i = 0; i < cookieArray.length; i++) {
        let cookie = cookieArray[i].trim();
        if (cookie.indexOf(name) === 0) {
            return cookie.substring(name.length, cookie.length);
        }
    }
    return null; // Cookie không tồn tại
}

function setCookiesBook(category,bookId)
{
	setCookie('categoryBook', category, 30);
	setCookie('bookId', bookId, 30);
}


</script>

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
		
</body>
</html>