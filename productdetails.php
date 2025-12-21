<!doctype html>
<html class="no-js" lang="zxx">
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
require_once __DIR__ . '/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get-all-book ALLSHOW -> $data
$url = rtrim(BACKEND_URL, '/') . '/api/get-all-book';
$databook = array('id' => 'ALLSHOW');
$jsonData10 = json_encode($databook);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer'
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData10);
$response = curl_exec($ch);
if ($response === FALSE) {
	$data = ['data' => []];
} else {
	$data = json_decode($response, true) ?: ['data' => []];
}
curl_close($ch);

// get-category-by-id -> $data2
$url = rtrim(BACKEND_URL, '/') . '/api/get-category-by-id';
$datacat = array('id' => 'CatAndCount');
$jsonData = json_encode($datacat);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer'
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
$response2 = curl_exec($ch);
if ($response2 === FALSE) {
	$data2 = ['data' => []];
} else {
	$data2 = json_decode($response2, true) ?: ['data' => []];
}
curl_close($ch);

// get-news -> $data3
$url = rtrim(BACKEND_URL, '/') . '/api/get-news';
$datanew = array('id' => 'F7');
$jsonData = json_encode($datanew);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer'
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
$response3 = curl_exec($ch);
if ($response3 === FALSE) {
	$data3 = ['data' => []];
} else {
	$data3 = json_decode($response3, true) ?: ['data' => []];
}
curl_close($ch);

// get-fv3 -> $data5
$url = rtrim(BACKEND_URL, '/') . '/api/get-fv3';
$idusername = $_COOKIE['idusername'] ?? -1;
$data5 = ['results'=>[], 'bookCount'=>0];
if ($idusername) {
	$datanew5 = array('idusername' => $idusername);
	$jsonData5 = json_encode($datanew5);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: ' . 'Bearer'
	));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData5);
	$response5 = curl_exec($ch);
	if ($response5 !== FALSE) {
		$data5 = json_decode($response5, true) ?: ['results'=>[], 'bookCount'=>0];
		if (isset($data5['results']) && is_array($data5['results'])) {
			$unique = [];
			foreach ($data5['results'] as $entry) {
				$idKey = null;
				if (is_array($entry)) {
					if (isset($entry['id'])) $idKey = $entry['id'];
					elseif (isset($entry['bookId'])) $idKey = $entry['bookId'];
					elseif (isset($entry['idfvbook'])) $idKey = $entry['idfvbook'];
				} elseif (is_object($entry)) {
					if (isset($entry->id)) $idKey = $entry->id;
					elseif (isset($entry->bookId)) $idKey = $entry->bookId;
					elseif (isset($entry->idfvbook)) $idKey = $entry->idfvbook;
				}
				$key = $idKey === null ? md5(json_encode($entry)) : (string)$idKey;
				if (!isset($unique[$key])) $unique[$key] = $entry;
			}
			$data5['results'] = array_values($unique);
			$data5['bookCount'] = count($data5['results']);
		}
	}
	curl_close($ch);
}

// get-cart3 -> $dataCart
$url = rtrim(BACKEND_URL, '/') . '/api/get-cart3';
$dataCart = null;
$idusername = $_COOKIE['idusername'] ?? -1;
if ($idusername) {
	$datacart = array('idusername' => $idusername, 'userId' => intval($idusername));
	$jsonDataCart = json_encode($datacart);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: ' . 'Bearer'
	));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataCart);
	$responseCart = curl_exec($ch);
	if ($responseCart !== FALSE) {
		$dataCart = json_decode($responseCart, true) ?: null;
	}
	curl_close($ch);
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
										<i class="icon-home"></i>
										<em>Trang chủ</em>
									</a>
								</li>
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
								<figure><a href="javascript:void(0);"><img src="images/author/imag-10.jpg" alt="image description"></a></figure>
								<span onclick="profileBar()" class="dropbtn">Hi, John</span>
								<div id="myDropdown" class="dropdown-content">
									
									<a href="admin-ui/page-login.html"><b><i class="icon-exit" ></i> Đăng xuất</b></a>
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
							<strong class="tg-logo"><a href="index.html"><img src="images/flogo.png" alt="company name here"></a></strong>
							<div class="tg-searchbox">
								<form class="tg-formtheme tg-formsearch">
									<fieldset>
										<input type="text" name="search" class="typeahead form-control" placeholder="Tìm kiếm ...">
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
																		<h2>Tác giả</h2>
																	</div>
																	<ul>
																		<li><a href="products.php">Nguyễn Ngọc Ánh</a></li>
																		<li><a href="products.php">Nguyễn Ngọc Ánh</a></li>
																		<li><a href="products.php">Nguyễn Ngọc Ánh</a></li>
																		<li><a href="products.php">Nguyễn Ngọc Ánh</a></li>
																		<li><a href="products.php">Nguyễn Ngọc Ánh</a></li>
																	</ul>
																	
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Mới nhất</h2>
																	</div>
																	<ul>
																		<li><a href="products.php">Tôi thấy hoa vàng trên cỏ xanh</a></li>
																		<li><a href="products.php">Tôi thấy hoa vàng trên cỏ xanh</a></li>
																		<li><a href="products.php">Tôi thấy hoa vàng trên cỏ xanh</a></li>
																		<li><a href="products.php">Tôi thấy hoa vàng trên cỏ xanh</a></li>
																		<li><a href="products.php">Tôi thấy hoa vàng trên cỏ xanh</a></li>
																	</ul>
																	
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Sách hay</h2>
																	</div>
																	<ul>
																		<li><a href="products.php">Dế mèn phươu lưu ký</a></li>
																		<li><a href="products.php">Dế mèn phươu lưu ký</a></li>
																		<li><a href="products.php">Dế mèn phươu lưu ký</a></li>
																		<li><a href="products.php">Dế mèn phươu lưu ký</a></li>
																		<li><a href="products.php">Dế mèn phươu lưu ký</a></li>
																	</ul>
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
																	</div>
																</li>
															</ul>
														</div>
														<div role="tabpanel" class="tab-pane" id="biography">
															<ul>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
																	</div>
																	<ul>
																		<li><a href="products.php">Veniam quis nostrud</a></li>
																		<li><a href="products.php">Exercitation</a></li>
																		<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																		<li><a href="products.php">Commodo conseat</a></li>
																		<li><a href="products.php">Duis aute irure</a></li>
																	</ul>
																	
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Mới nhất</h2>
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
																		<h2>Sách hay</h2>
																	</div>
																	<ul>
																		<li><a href="products.php">Consectetur adipisicing</a></li>
																		<li><a href="products.php">Aelit sed do eiusmod</a></li>
																		<li><a href="products.php">Tempor incididunt labore</a></li>
																		<li><a href="products.php">Dolore magna aliqua</a></li>
																		<li><a href="products.php">Ut enim ad minim</a></li>
																	</ul>
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
																	</div>
																</li>
															</ul>
														</div>
														<div role="tabpanel" class="tab-pane" id="childrensbook">
															<ul>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
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
																		<h2>Mới nhất</h2>
																	</div>
																	<ul>
																		<li><a href="products.php">Consectetur adipisicing</a></li>
																		<li><a href="products.php">Aelit sed do eiusmod</a></li>
																		<li><a href="products.php">Tempor incididunt labore</a></li>
																		<li><a href="products.php">Dolore magna aliqua</a></li>
																		<li><a href="products.php">Ut enim ad minim</a></li>
																	</ul>
																	
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Sách hay</h2>
																	</div>
																	<ul>
																		<li><a href="products.php">Veniam quis nostrud</a></li>
																		<li><a href="products.php">Exercitation</a></li>
																		<li><a href="products.php">Laboris nisi ut aliuip</a></li>
																		<li><a href="products.php">Commodo conseat</a></li>
																		<li><a href="products.php">Duis aute irure</a></li>
																	</ul>
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
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
																	
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
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
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
																	</div>
																</li>
															</ul>
														</div>
														<div role="tabpanel" class="tab-pane" id="crimethriller">
															<ul>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
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
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
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
																	
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
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
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
																	</div>
																</li>
															</ul>
														</div>
														<div role="tabpanel" class="tab-pane" id="fiction">
															<ul>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
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
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
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
																	
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
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
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
																	</div>
																</li>
															</ul>
														</div>
														<div role="tabpanel" class="tab-pane" id="graphicanimemanga">
															<ul>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
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
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
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
																	
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
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
																	
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php">Xem thêm</a>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</li>
											<li class="menu-item-has-children">
												<a href="productdetail.html">Sách</a>
												<ul class="sub-menu">
													<li><a href="index-2.html">Sách mới nhất</a></li>
													<li><a href="indexv2.html">Sách hay</a></li>
												</ul>
											</li>
										    <li class="menu-item-has-children">
											<a href="newsgrid.html">Tin tức</a>
											<ul class="sub-menu" id="menu-tin-tuc">
												<li><a href="index-2.html">Tin tức mới nhất</a></li>
												<li><a href="indexv2.html">tin tức nổi bật</a></li>
											</ul>
										    </li>	
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
							<h1>Products</h1>
							<ol class="tg-breadcrumb">
								<li><a href="javascript:void(0);">home</a></li>
								<li><a href="javascript:void(0);">Products</a></li>
								<li class="tg-active">Product Title Here</li>
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
													<figure class="tg-featureimg"><img src="images/books/img-07.jpg" alt="image description"></figure>
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
														<li><a href="javascript:void(0);">Art &amp; Photography</a></li>
													</ul>
													<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
													<div class="tg-booktitle">
														<h3>Drive Safely, No Bumping</h3>
													</div>
													<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
													<span class="tg-stars"><span></span></span>
													<span class="tg-addreviews"><a href="javascript:void(0);">Add Your Review</a></span>
													<div class="tg-share">
														<span>Share:</span>
														<ul class="tg-socialicons">
															<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
															<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
															<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
															<li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
															<li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
														</ul>
													</div>
													<div class="tg-description">
														<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etdoloreat magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisi nisi ut aliquip ex ea commodo consequat aute.</p>
														<p>Arure dolor in reprehenderit in voluptate velit esse cillum dolore fugiat nulla aetur excepteur sint occaecat cupidatat non proident, sunt in culpa quistan officia serunt mollit anim id est laborum sed ut perspiciatis unde omnis iste natus... <a href="javascript:void(0);">More</a></p>
													</div>
													
													
												</div>
											</div>
											
											<div class="tg-relatedproducts">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<div class="tg-sectionhead">
														<h2><span>Related Products</span>You May Also Like</h2>
														<a class="tg-btn" href="javascript:void(0);">View All</a>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<div id="tg-relatedproductslider" class="tg-relatedproductslider tg-relatedbooks owl-carousel">
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-01.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-01.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>Thêm vào yêu thích</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Help Me Find My Stomach</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-02.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-02.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>Thêm vào yêu thích</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Drive Safely, No Bumping</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-03.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-03.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>Thêm vào yêu thích</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Let The Good Times Roll Up</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-04.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-04.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>Thêm vào yêu thích</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Our State Fair Is A Great State Fair</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-05.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-05.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>Thêm vào yêu thích</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Put The Petal To The Metal</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-06.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-06.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>Thêm vào yêu thích</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Help Me Find My Stomach</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-03.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-03.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>Thêm vào yêu thích</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Let The Good Times Roll Up</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	
																</div>
															</div>
														</div>
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
												<li><a href="javascript:void(0);"><span>Art &amp; Photography</span><em>28245</em></a></li>
												<li><a href="javascript:void(0);"><span>Biography</span><em>4856</em></a></li>
												<li><a href="javascript:void(0);"><span>Children’s Book</span><em>8654</em></a></li>
												<li><a href="javascript:void(0);"><span>Craft &amp; Hobbies</span><em>6247</em></a></li>
												<li><a href="javascript:void(0);"><span>Crime &amp; Thriller</span><em>888654</em></a></li>
												<li><a href="javascript:void(0);"><span>Fantasy &amp; Horror</span><em>873144</em></a></li>
												<li><a href="javascript:void(0);"><span>Fiction</span><em>18465</em></a></li>
												<li><a href="javascript:void(0);"><span>Fod &amp; Drink</span><em>3148</em></a></li>
												<li><a href="javascript:void(0);"><span>Graphic, Anime &amp; Manga</span><em>77531</em></a></li>
												<li><a href="javascript:void(0);"><span>Science Fiction</span><em>9247</em></a></li>
												<li><a href="javascript:void(0);"><span>View All</span></a></li>
											</ul>
										</div>
									</div>
									<div class="tg-widget tg-widgettrending">
										<div class="tg-widgettitle">
											<h3>Tin tức mới nhất</h3>
										</div>
										<div class="tg-widgetcontent">
											<ul>
												<li>
													<article class="tg-post">
														<figure><a href="javascript:void(0);"><img src="images/products/img-04.jpg" alt="image description"></a></figure>
														<div class="tg-postcontent">
															<div class="tg-posttitle">
																<h3><a href="javascript:void(0);">Where The Wild Things Are</a></h3>
															</div>
															<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
														</div>
													</article>
												</li>
												<li>
													<article class="tg-post">
														<figure><a href="javascript:void(0);"><img src="images/products/img-05.jpg" alt="image description"></a></figure>
														<div class="tg-postcontent">
															<div class="tg-posttitle">
																<h3><a href="javascript:void(0);">Where The Wild Things Are</a></h3>
															</div>
															<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
														</div>
													</article>
												</li>
												<li>
													<article class="tg-post">
														<figure><a href="javascript:void(0);"><img src="images/products/img-06.jpg" alt="image description"></a></figure>
														<div class="tg-postcontent">
															<div class="tg-posttitle">
																<h3><a href="javascript:void(0);">Where The Wild Things Are</a></h3>
															</div>
															<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
														</div>
													</article>
												</li>
												<li>
													<article class="tg-post">
														<figure><a href="javascript:void(0);"><img src="images/products/img-07.jpg" alt="image description"></a></figure>
														<div class="tg-postcontent">
															<div class="tg-posttitle">
																<h3><a href="javascript:void(0);">Where The Wild Things Are</a></h3>
															</div>
															<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
														</div>
													</article>
												</li>
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
											<li><a href="contactus.php">Liên hệ</a></li>
											<li><a href="aboutus.html">Về chúng tôi</a></li>
										</ul>
										<ul>
											<li><a href="products.php">Sách hay</a></li>
											<li><a href="aboutus.html">Về chúng tôi</a></li>
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
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
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
		// Header JS: dropdown, cookies, search, cart/wishlist helpers (copied from index.php)
		function profileBar() { document.getElementById("myDropdown").classList.toggle("show"); }
		window.onclick = function(event) {
		  if (!event.target.matches('.dropbtn')) {
			var dropdowns = document.getElementsByClassName("dropdown-content");
			for (var i = 0; i < dropdowns.length; i++) {
			  var openDropdown = dropdowns[i];
			  if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			  }
			}
		  }
		}
		function deleteCookie(name) { document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'; }
		function logout() { localStorage.removeItem('userData'); localStorage.removeItem('jwtToken'); deleteCookie('idusername'); deleteCookie('token'); deleteCookie('jwtToken'); }
		let dataLocal = localStorage.getItem('userData');
		if (dataLocal) { dataLocal = JSON.parse(dataLocal); var dbtn = document.querySelector('.dropbtn'); if (dbtn) dbtn.innerHTML = 'Hi ' + (dataLocal.lastName||''); var d1 = document.querySelector('.dropdown-1'); if(d1) d1.innerHTML='Đăng xuất'; var d2 = document.querySelector('.dropdown-2'); if(d2) d2.style.display='none'; } else { var dbtn = document.querySelector('.dropbtn'); if (dbtn) dbtn.innerHTML='Welcome'; var d1 = document.querySelector('.dropdown-1'); if(d1) d1.innerHTML='Đăng nhập'; var d2 = document.querySelector('.dropdown-2'); if(d2) d2.style.display='block'; }

		function setCookie(name, value, days) { var expires = ""; if (days){ var date = new Date(); date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); expires = "; expires=" + date.toUTCString(); } document.cookie = name + "=" + (value || "") + expires + "; path=/"; }
		function getCookie(name) { var nameEQ = name + "="; var ca = document.cookie.split(';'); for (var i = 0; i < ca.length; i++) { var c = ca[i]; while (c.charAt(0) == ' ') c = c.substring(1, c.length); if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length); } return null; }
		function eraseCookie(name) { document.cookie = name + '=; Max-Age=-99999999;'; }
		function setCookiesBook(category,bookId){ setCookie('categoryBook', category, 30); setCookie('bookId', bookId, 30); }

		document.getElementById && document.getElementById('searchForm') && document.getElementById('searchForm').addEventListener('submit', function(e){ e.preventDefault(); var q = document.querySelector('input[name="search"]').value; setCookie('tukhoa', q, 30); window.location.href = 'findingbook.php?tukhoa=' + encodeURIComponent(q); });

		// basic addToCart/order handlers copied (non-exhaustive)
		async function addToCart(bookId, bookcode, bookname, price = 0, image = null) {
			const user = JSON.parse(localStorage.getItem('userData') || 'null'); if (!user || !user.id) { if (confirm('Bạn chưa đăng nhập. Bạn muốn tạo tài khoản bây giờ?')) window.location.href='admin-ui/page-register.html'; return; }
			const token = localStorage.getItem('jwtToken'); if (!token){ alert('Phiên đăng nhập hết hạn. Vui lòng đăng nhập lại.'); window.location.href='admin-ui/page-login.html'; return; }
			const backendBase = (window.APP_CONFIG && window.APP_CONFIG.backendUrl) ? String(window.APP_CONFIG.backendUrl).replace(/\/$/, '') : 'http://localhost:8000';
			const apiUrl = `${backendBase}/api/save-cart`;
			const payload = { items: [{ bookId: parseInt(bookId), bookcode, bookname, quantity:1, price: parseFloat(price)||0, image: image||null }] };
			try { const resp = await fetch(apiUrl, { method:'POST', headers: {'Authorization': `Bearer ${token}`, 'Content-Type':'application/json'}, body: JSON.stringify(payload) }); const result = await resp.json(); if (resp.ok && result.errCode===0) { try{ if (typeof refreshCart==='function') await refreshCart(); }catch(e){} window.location.href='cartbook.php'; } else { alert('Lỗi: '+(result.message||result.errMessage||'Không thể thêm vào giỏ hàng')); } } catch(e){ console.error(e); alert('Lỗi kết nối'); }
		}

	</script>
	<script>
		function profileBar() {
		  document.getElementById("myDropdown").classList.toggle("show");
		}
	</script>
</body>

</html>