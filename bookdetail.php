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
require_once __DIR__ . '/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Compute site frontend base (used for image URLs) to avoid relative-path 404s
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$siteBase = rtrim($scheme . $host, '/') . '/QLTV-ChatboxAi/frontend';

$url = rtrim(BACKEND_URL, '/') . '/api/get-all-book'; // URL của API backend

// Dữ liệu gửi đi
$databook = array('id' => 'ALLSHOW');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData10 = json_encode($databook);

// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer' // Thêm token vào header Authorization
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData10);

// Thực hiện yêu cầu POST và nhận phản hồi
$response = curl_exec($ch);

// Kiểm tra nếu có lỗi khi gửi yêu cầu
if ($response === FALSE) {
	die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
}

// Đóng cURL
curl_close($ch);

// Chuyển đổi JSON thành mảng dữ liệu trong PHP
$data = json_decode($response, true);

// Kiểm tra nếu có lỗi khi chuyển đổi JSON
if ($data === null) {
	die('Lỗi khi chuyển đổi JSON');
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = rtrim(BACKEND_URL, '/') . '/api/get-all-book'; // URL của API backend

// Dữ liệu gửi đi
$databook = array('id' => 'F10');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData = json_encode($databook);


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
$response9 = curl_exec($ch);

// Kiểm tra nếu có lỗi khi gửi yêu cầu
if ($response9 === FALSE) {
	die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
}

// Đóng cURL
curl_close($ch);

// Chuyển đổi JSON thành mảng dữ liệu trong PHP
$data9 = json_decode($response9, true);

// Kiểm tra nếu có lỗi khi chuyển đổi JSON
if ($data9 === null) {
	die('Lỗi khi chuyển đổi JSON');
}

$url = rtrim(BACKEND_URL, '/') . '/api/get-category-by-id'; // URL của API backend

// Dữ liệu gửi đi
$datacat = array('id' => 'F10');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData = json_encode($datacat);


// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer'
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

// Normalize category response shapes to expected keys: 'categories', 'data', 'result'
if (!is_array($data2)) {
	$data2 = ['categories' => [], 'data' => [], 'result' => []];
} else {
	if (isset($data2['categories']) && is_array($data2['categories'])) {
		// ok
	} elseif (isset($data2['data']) && is_array($data2['data'])) {
		$data2['categories'] = $data2['data'];
	} elseif (isset($data2['results']) && is_array($data2['results'])) {
		$data2['categories'] = $data2['results'];
	} else {
		$data2['categories'] = [];
	}

	if (isset($data2['data']) && is_array($data2['data'])) {
		// ok
	} else {
		$data2['data'] = $data2['categories'];
	}

	if (isset($data2['result']) && is_array($data2['result'])) {
		// ok
	} elseif (isset($data2['results']) && is_array($data2['results'])) {
		$data2['result'] = $data2['results'];
	} else {
		$data2['result'] = [];
	}
}



// Populate booksCount for sidebar: derive counts from grouped `result` if backend didn't provide counts
$countsById = [];
$countsByName = [];
if (isset($data2['result']) && is_array($data2['result'])) {
	foreach ($data2['result'] as $catdata) {
		$cid = isset($catdata['catId']) ? (string)$catdata['catId'] : (isset($catdata['id']) ? (string)$catdata['id'] : '');
		$cname = isset($catdata['category']) ? (string)$catdata['category'] : (isset($catdata['name']) ? (string)$catdata['name'] : '');
		$count = 0;
		if (isset($catdata['books']) && is_array($catdata['books'])) {
			$count = count($catdata['books']);
		} elseif (isset($catdata['newbooks']) && is_array($catdata['newbooks'])) {
			$count = count($catdata['newbooks']);
		}
		if ($cid !== '') $countsById[$cid] = $count;
		if ($cname !== '') $countsByName[$cname] = $count;
	}
}

// Apply counts to categories/data arrays so sidebar shows numbers
if (isset($data2['data']) && is_array($data2['data'])) {
	foreach ($data2['data'] as &$cat) {
		$catId = isset($cat['id']) ? (string)$cat['id'] : '';
		$catName = isset($cat['category']) ? (string)$cat['category'] : (isset($cat['name']) ? (string)$cat['name'] : '');
		$booksCount = 0;
		if ($catId !== '' && isset($countsById[$catId])) $booksCount = $countsById[$catId];
		elseif ($catName !== '' && isset($countsByName[$catName])) $booksCount = $countsByName[$catName];
		$cat['booksCount'] = $booksCount;
	}
	unset($cat);
}

// Mirror into categories for templates that iterate categories
if (isset($data2['categories']) && is_array($data2['categories'])) {
	foreach ($data2['categories'] as &$cat) {
		$catId = isset($cat['id']) ? (string)$cat['id'] : '';
		$catName = isset($cat['category']) ? (string)$cat['category'] : (isset($cat['name']) ? (string)$cat['name'] : '');
		$booksCount = 0;
		if ($catId !== '' && isset($countsById[$catId])) $booksCount = $countsById[$catId];
		elseif ($catName !== '' && isset($countsByName[$catName])) $booksCount = $countsByName[$catName];
		$cat['booksCount'] = $booksCount;
	}
	unset($cat);
}

$url = rtrim(BACKEND_URL, '/') . '/api/get-news'; // URL của API backend

// Dữ liệu gửi đi
$datanew = array('id' => 'F7');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData = json_encode($datanew);

// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer YOUR_TOKEN_HERE' // Thay YOUR_TOKEN_HERE bằng token thực tế của bạn
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Thực hiện yêu cầu POST và nhận phản hồi
$response3 = curl_exec($ch);

// Kiểm tra và xử lý lỗi khi gửi yêu cầu
if ($response3 === false) {
	die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
}

// Kiểm tra mã HTTP response
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($http_status !== 200) {
	die('Lỗi HTTP: ' . $http_status);
}

// Đóng cURL
curl_close($ch);

// Chuyển đổi JSON thành mảng dữ liệu trong PHP
$data3 = json_decode($response3, true);

// Kiểm tra và xử lý lỗi khi chuyển đổi JSON
if ($data3 === null) {
	die('Lỗi khi chuyển đổi JSON');
}


$url = rtrim(BACKEND_URL, '/') . '/api/get-news'; // URL của API backend

// Dữ liệu gửi đi
$datanew2 = array('id' => 'ALLSHOW');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData11 = json_encode($datanew2);

// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer YOUR_TOKEN_HERE' // Thay YOUR_TOKEN_HERE bằng token thực tế của bạn
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData11);

// Thực hiện yêu cầu POST và nhận phản hồi
$response33 = curl_exec($ch);

// Kiểm tra và xử lý lỗi khi gửi yêu cầu
if ($response33 === false) {
	die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
}

// Kiểm tra mã HTTP response
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($http_status !== 200) {
	die('Lỗi HTTP: ' . $http_status);
}

// Đóng cURL
curl_close($ch);

// Chuyển đổi JSON thành mảng dữ liệu trong PHP
$data33 = json_decode($response33, true);

// Kiểm tra và xử lý lỗi khi chuyển đổi JSON
if ($data33 === null) {
	die('Lỗi khi chuyển đổi JSON');
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = rtrim(BACKEND_URL, '/') . '/api/get-fv3'; // URL của API backend

// Lấy dữ liệu từ cookies
$idusername = $_COOKIE['idusername'] ?? -1;

if ($idusername) {
	// Dữ liệu để gửi
	$datanew5 = array('idusername' => $idusername);

	// Chuyển đổi mảng dữ liệu thành JSON
	$jsonData5 = json_encode($datanew5);

	// Cấu hình cURL
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: ' . 'Bearer' // Thêm token vào header Authorization
	));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData5);

	// Thực hiện yêu cầu POST và nhận phản hồi
	$response5 = curl_exec($ch);

	// Kiểm tra nếu có lỗi khi gửi yêu cầu
	if ($response5 === FALSE) {
		die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
	}

	// Đóng cURL
	curl_close($ch);

	// Chuyển đổi JSON thành mảng dữ liệu trong PHP
	$data5 = json_decode($response5, true);

	// Kiểm tra nếu có lỗi khi chuyển đổi JSON
	if ($data5 === null) {
		die('Lỗi khi chuyển đổi JSON');
	}

	// Normalize / deduplicate favorites results so UI can't show duplicates
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
			if ($idKey === null) {
				// fallback: use serialized content as key
				$key = md5(json_encode($entry));
			} else {
				$key = (string)$idKey;
			}
			if (!isset($unique[$key])) {
				$unique[$key] = $entry;
			}
		}
		$data5['results'] = array_values($unique);
		// ensure bookCount reflects unique items
		$data5['bookCount'] = count($data5['results']);
	} else {
		// ensure structure exists
		$data5['results'] = [];
		$data5['bookCount'] = 0;
	}

	echo '<script>console.log(' . json_encode($data5) . ');</script>';
}

// === Lấy top 3 items của giỏ hàng giống phần yêu thích ===
$url = rtrim(BACKEND_URL, '/') . '/api/get-cart3'; // URL của API backend

$dataCart = null;
$idusername = $_COOKIE['idusername'] ?? -1;

if ($idusername) {
	// Send both 'idusername' (legacy) and 'userId' so backend controllers accept either key
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
	if ($responseCart === FALSE) {
		// ignore silently, keep $dataCart null
	} else {
		$dataCart = json_decode($responseCart, true);
	}
	curl_close($ch);
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = rtrim(BACKEND_URL, '/') . '/api/get-all-book'; // URL của API backend

// Dữ liệu gửi đi
$databook12 = array('id' => 'L12');

// Chuyển đổi mảng dữ liệu thành JSON
$jsonData12 = json_encode($databook12);


// Cấu hình cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer' // Thêm token vào header Authorization
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData12);

// Thực hiện yêu cầu POST và nhận phản hồi
$response12 = curl_exec($ch);

// Kiểm tra nếu có lỗi khi gửi yêu cầu
if ($response12 === FALSE) {
	die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
}

// Đóng cURL
curl_close($ch);

// Chuyển đổi JSON thành mảng dữ liệu trong PHP
$data12 = json_decode($response12, true);

// Kiểm tra nếu có lỗi khi chuyển đổi JSON
if ($data12 === null) {
	die('Lỗi khi chuyển đổi JSON');
}

// Debug: Kiểm tra cấu trúc dữ liệu
if (!is_array($data12)) {
	die('Dữ liệu không phải là mảng');
}

// Đảm bảo $data12 có cấu trúc đúng
if (isset($data12['data'])) {
	$data12 = $data12['data'];
} elseif (isset($data12['results'])) {
	$data12 = $data12['results'];
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
									<a href="index.php">
										<i class="icon-home"></i>
										<em>Trang chủ</em>
									</a>
								</li>
								<li>
									<a href="contactus.php">
										<i class="icon-envelope"></i>
										<em>Liên hệ</em>
									</a>
								</li>
								<li>
									<a href="aboutus.php">
										<i class="icon-user"></i>
										<em>Về chúng tôi</em>
									</a>
								</li>
							</ul>
							<div class="tg-userlogin">
								<figure><a><img src="images/blank-avatar.jpg" alt="image description"></a></figure>
								<span onclick="profileBar()" class="dropbtn"></span>
								<div id="myDropdown" class="dropdown-content">
									<a class="dropdown-1" href="admin-ui/page-login.html" onclick="logout()"></i> Đăng xuất</a>
									<a class="dropdown-3" href="orders.php">Đơn sách</a>
									<a class="dropdown-2" href="admin-ui/page-register.html"></i> Đăng ký</a>
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
							<strong class="tg-logo"><a href="index.php"><img src="images/flogo.png" alt="company name here"></a></strong>
							<div class="tg-searchbox">
								<form class="tg-formtheme tg-formsearch" id="searchForm">
									<fieldset>
										<input type="text" name="search" class="typeahead form-control" placeholder="Sách hay">
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
													<?php
													// Kiểm tra nếu $data2 chứa các danh mục
													if (isset($data2['categories']) && is_array($data2['categories'])) {
													 foreach ($data2['categories'] as $category) {
													// Giả sử mỗi mục danh mục có thuộc tính 'category'
													if (isset($category['category'])) {
													echo '<li role="presentation">';
													echo '<a href="#' . htmlspecialchars($category['id']) . '" aria-controls="' . htmlspecialchars($category['id']) . '" role="tab" data-toggle="tab">' . htmlspecialchars($category['category']) . '</a>';
													echo '</li>';
																	  }
															 }
													} else {
														echo 'Không có danh mục nào để hiển thị.';
														}
													?>
													</ul>
													<div class="tab-content tg-themetabcontent">
													<?php foreach ($data2['result'] as $catdata): ?>
														<div role="tabpanel" class="tab-pane active" id="<?= htmlspecialchars($catdata['catId']) ?>">
															<ul>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
																	</div>
																	<ul>
																	<?php 
																	$count = 0;
																	$displayed_authors = [];
																	foreach ($catdata['books'] as $author): 
																	if ($count >= 5) break;
																	if (in_array($author['author'], $displayed_authors)) continue;
																	$displayed_authors[] = $author['author'];
																	?>
																	<li><a><?= htmlspecialchars($author['author']) ?></a></li>
																	<?php 
																	$count++;
																	endforeach; 
																	?>
																	</ul>
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Mới nhất</h2>
																	</div>
																	<ul>
																	<?php 
																	   $count = 0;
																	   $displayed_books = [];
																	   foreach ($catdata['newbooks'] as $newbook): 
																	   if ($count >= 5) break;
																	   if (in_array($newbook['bookName'], $displayed_books)) continue;
																	   $displayed_books[] = $newbook['bookName'];
																	   ?>
																	  <li><a><?= htmlspecialchars($newbook['bookName']) ?></a></li>
																	  <?php 
																	  $count++;
																	  endforeach; 
																	  ?>
																	</ul>
																</li>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Sách hay</h2>
																	</div>
																	<ul>
																	<?php 
																	  $count = 0;
																	  $displayed_books = [];
																	  foreach ($catdata['books'] as $book): 
																	  if ($count >= 5) break;
																	  if (in_array($book['bookName'], $displayed_books)) continue;
																	  $displayed_books[] = $book['bookName'];
																	  ?>
																	  <li><a><?= htmlspecialchars($book['bookName']) ?></a></li>
																	  <?php 
																	  $count++;
																	  endforeach; 
																	  ?>
																	</ul>
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png" alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá</h3>
																		<a class="tg-btn" href="products.php?pageIndex=1">Xem thêm</a>
																	</div>
																</li>
															</ul>
														</div>
													<?php endforeach; ?>
													</div>
												</div>
											</li>
											<li class="menu-item-has-children">
												<a>Sách</a>
												<ul class="sub-menu">
													<li><a href="">Sách mới nhất</a></li>
													<li><a href="">Sách hay</a></li>
												</ul>
											</li>
											<li class="menu-item-has-children">
											<a>Tin tức</a>
											<ul class="sub-menu" id="menu-tin-tuc">
												<li><a href="">Tin tức mới nhất</a></li>
												<li><a href="">tin tức nổi bật</a></li>
											</ul>
											</li>    
									</div>
								</nav>
								<div class="tg-wishlistandcart">
								<div class="dropdown tg-themedropdown tg-minicartdropdown">
										<a href="javascript:void(0);" id="tg-wishlisst" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="tg-themebadge"><?php echo $data5['bookCount'] ?></span>
											<i class="icon-heart"></i>
										</a>
										<div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-minicart">
											<div class="tg-minicartbody">
												<?php
												if (isset($data5['results']) && !empty($data5['results'])) {
												// Lặp qua dữ liệu và hiển thị trong các div item
												foreach ($data5['results'] as $book) {
													// Chỉ hiển thị sách nếu showing = 1
													if ($book['showing'] == 1) {
														?>
												<div class="tg-minicarproduct">
													<figure>
														<img src="images/books/<?php echo $book['image']; ?>" alt="image bug" style="width:65px">
                                                        
													</figure>
													<div class="tg-minicarproductdata">
														<h5><a><?php echo $book['bookName']; ?></a></h5>
														<h6><a><?php echo $book['category']; ?></a></h6>
													</div>
												</div>
												<?php
													}
												}
											} else {
												echo '<div class="tg-description"><p>Chưa có sách yêu thích nào</p></div>';
											}
											?>
											<div class="tg-minicartfoot">
												<div class="tg-btns">
													<a class="tg-btn" href="favoritebook.php">Xem thêm</a>
													<a class="tg-btn" href="javascript:void(0);">Đóng</a>
												</div>
												</div>
									   </div>
								</div>
                                
							</div>
							<div class="dropdown tg-themedropdown tg-wishlistdropdown">
										<a href="javascript:void(0);" id="tg-cartdrop" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="tg-themebadge"><?php echo isset($dataCart['itemCount']) ? htmlspecialchars($dataCart['itemCount']) : '0'; ?></span>
											<i class="icon-cart"></i>
										</a>
										<div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-minicart">
											<div class="tg-minicartbody">
											<?php
												if (isset($dataCart['results']) && !empty($dataCart['results'])) {
													foreach ($dataCart['results'] as $it) {
														// $it may be a Book object or a cartitem-like object
														$img = 'no-image.png';
														$title = '';
														$category = '';
														if (isset($it['image'])) {
															$img = htmlspecialchars($it['image']);
														} elseif (isset($it->image)) {
															$img = htmlspecialchars($it->image);
														}
														if (isset($it['bookName'])) $title = htmlspecialchars($it['bookName']);
														elseif (isset($it['bookname'])) $title = htmlspecialchars($it['bookname']);
														elseif (isset($it->bookName)) $title = htmlspecialchars($it->bookName);
														if (isset($it['category'])) $category = htmlspecialchars($it['category']);
														elseif (isset($it->category)) $category = htmlspecialchars($it->category);
														?>
														<div class="tg-minicarproduct">
															<figure>
																<img src="images/books/<?php echo $img; ?>" alt="image description" style="width:65px">
															</figure>
															<div class="tg-minicarproductdata">
																<h5><a href="cartbook.php"><?php echo $title ?: 'Sách'; ?></a></h5>
																<h6><a href="javascript:void(0);"><?php echo $category; ?></a></h6>
															</div>
														</div>
													<?php
													}
												} else {
													echo '<div class="tg-description"><p>Chưa có sách đặt</p></div>';
												}
											?>
											</div>
											<div class="tg-minicartfoot">
												<div class="tg-btns">
													<a class="tg-btn" href="cartbook.php">Xem thêm</a>
													<a class="tg-btn" href="javascript:void(0);">Đóng</a>
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
														<!-- Wishlist button - always show -->
														<a class="tg-btnaddtowishlist" id="wishlistBtn" onclick="toggleWishlist()" style="cursor:pointer;background:aqua;">
															<span id="wishlistText">Thêm vào yêu thích</span>
														</a>
														<!-- Quantity selector (improved) -->
														<div class="tg-quantityholder" style="margin-top: 15px;">
															<label style="display: block; margin-bottom: 5px; font-weight: bold; text-align: center;">Số lượng:</label>
															<div class="qty-control" style="display:flex;align-items:center;justify-content:center;">
																<button type="button" class="qty-btn qty-decrease" aria-label="Giảm số lượng" onclick="decreaseQuantity()">−</button>
																<input type="number" id="bookQuantity" class="qty-input" value="1" min="1" max="99" aria-label="Số lượng sách" />
																<button type="button" class="qty-btn qty-increase" aria-label="Tăng số lượng" onclick="increaseQuantity()">+</button>
															</div>
														</div>
														<!-- Cart button - add to cart functionality -->
														<a class="tg-btn tg-active tg-cartbtn" href="javascript:void(0);" onclick="addToCartDetail()" style="margin-top: 10px;">
															<i class="fa fa-shopping-cart"></i>
															<em>Thêm vào giỏ</em>
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
													<span class="tg-bookprice">
														<ins id="price"></ins>
													</span>
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
													<?php if (isset($data4['relatedbook']) && is_array($data4['relatedbook'])) {
														foreach($data4['relatedbook'] as $book){
															// normalize nested array shapes
															$book = is_array($book) && isset($book[0]) ? $book[0] : $book;
															$img = !empty($book['image']) ? htmlspecialchars($book['image']) : 'no-image.png';
															$category = $book['category'] ?? '';
															$id = $book['id'] ?? '';
															$categoryJson = htmlspecialchars(json_encode($category), ENT_QUOTES, 'UTF-8');
															$idJson = htmlspecialchars(json_encode($id), ENT_QUOTES, 'UTF-8');
															?>
															<div class="item">
																<div class="tg-postbook">
																	<figure class="tg-featureimg">
																		<div class="tg-bookimg">
																			<div class="tg-frontcover"><img src="images/books/<?php echo $img ?>" alt="<?php echo htmlspecialchars($book['bookName'] ?? 'book'); ?>"></div>
																			<div class="tg-backcover"><img src="images/books/<?php echo $img ?>" alt="<?php echo htmlspecialchars($book['bookName'] ?? 'book'); ?>"></div>
																		</div>
																		<a class="tg-btnaddtowishlist" href="bookdetail.php?id=<?php echo $idJson ?>" onClick="setCookiesBook(<?php echo $categoryJson ?>,<?php echo $idJson ?>)">
																			<span>Xem thêm</span>
																		</a>
																	</figure>
																	<div class="tg-postbookcontent">
																		<ul class="tg-bookscategories">
																			<li><a><?php echo htmlspecialchars($book['category'] ?? '') ?></a></li>
																		</ul>
																		<div class="tg-booktitle">
																			<h3><a href="bookdetail.php?id=<?php echo $idJson ?>" onClick="setCookiesBook(<?php echo $categoryJson ?>,<?php echo $idJson ?>)"><?php echo htmlspecialchars($book['bookName'] ?? '') ?></a></h3>
																		</div>
																		<span class="tg-bookwriter"> <a><?php echo htmlspecialchars($book['author'] ?? '') ?></a></span>
																		<span class="tg-bookprice">
																			<ins><?php echo '$' . number_format($book['price'] ?? 0, 2, '.', ','); ?></ins>
																		</span>
																	</div>
																</div>
															</div>
													<?php }
													} else {
														echo '<div class="item"><p>Không có sách liên quan</p></div>';
													}
													?>
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
												if (isset($data2['data']) && is_array($data2['data'])) {
													foreach($data2['data'] as $cat) { ?>
														<li><a href="<?php echo htmlspecialchars($cat['category'] ?? '') ?>"><span> <?php echo htmlspecialchars($cat['category'] ?? '') ?></span><em><?php echo htmlspecialchars($cat['booksCount'] ?? 0) ?></em></a></li>
													<?php }
												} else {
													echo '<li>Không có danh mục</li>';
												}
												?>
											</ul>
										</div>
									</div>
									<div class="tg-widget tg-widgettrending">
										<div class="tg-widgettitle">
											<h3>Tin tức mới nhất</h3>
										</div>
										<div class="tg-widgetcontent">
											<ul>
												<?php if (isset($data3['data']) && is_array($data3['data'])) {
													foreach($data3['data'] as $new){ ?>
														<li>
															<article class="tg-post">
																<figure style="width:112px;"><a style="width:100px;" href="newsdetail.php?id=<?php echo htmlspecialchars($new['id'] ?? '')?>" alt="<?php echo htmlspecialchars($new['image'] ?? '')?>"><img src="images/blog/<?php echo htmlspecialchars($new['image'] ?? 'no-image.png') ?>" alt="<?php echo htmlspecialchars($new['image'] ?? '') ?>"></a></figure>
																<div class="tg-postcontent">
																	<div class="tg-posttitle">
																		<h3><a href="newsdetail.php?id=<?php echo htmlspecialchars($new['id'] ?? '')?>"><?php echo htmlspecialchars($new['title'] ?? '')?></a></h3>
																	</div>
																	<span class="tg-bookwriter"> <a><?php echo htmlspecialchars($new['author'] ?? '') ?></a></span>
																</div>
															</article>
														</li>
													<?php }
												} else {
													echo '<li>Không có tin tức</li>';
												}
												?>
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
			var dropdowns = document.getElementsByClassName("dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
			  var openDropdown = dropdowns[i];
			  if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			  }
			}
		  }
		}
		//Sự kiện logout

	function deleteCookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    }
	function logout()
    {
        localStorage.removeItem('userData')
        localStorage.removeItem('jwtToken')
		deleteCookie('idusername');
        deleteCookie('token');
        deleteCookie('jwtToken');
    }
	let data = localStorage.getItem('userData');

if (data) {
    data = JSON.parse(data); // Parse the JSON string into an object
    document.querySelector('.dropbtn').innerHTML = 'Hi ' + data.lastName;
    document.querySelector('.dropdown-1').innerHTML = 'Đăng xuất';
    document.querySelector('.dropdown-2').style.display = 'none';
} else {
    document.querySelector('.dropbtn').innerHTML = 'Welcome';
    document.querySelector('.dropdown-1').innerHTML = 'Đăng nhập';
    document.querySelector('.dropdown-2').style.display = 'block';
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
        
	xhr.open("POST", window.APP_CONFIG.backendUrl + "/api/get-all-book", true);
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
			// normalize response shape
			let book = null;
			if (responseData.data) {
				book = responseData.data;
			} else if (Array.isArray(responseData) && responseData.length) {
				book = responseData[0];
			} else {
				book = responseData;
			}

			// ensure we have a plain object
			if (!book || typeof book !== 'object') book = {};

			// normalize image property names and ensure a filename exists
			const imageCandidates = [book.image, book.img, book.imageName, book.filename, book.picture];
			const imageName = imageCandidates.find(x => x && String(x).trim()) || 'no-image.png';
			book.image = imageName;

			window.currentBook = book; // keep for ordering
			document.getElementById("category").innerText = book.category || '';
			document.getElementById("bookName").innerText = book.bookName || '';
			document.getElementById("imageBook").src = "images/books/" + (book.image || 'no-image.png');
			document.getElementById("author").innerText = book.author || '';
			document.getElementById("description").innerText = book.description || '';
			function formatCurrency(n){ return (Number(n)||0).toLocaleString('en-US', { style: 'currency', currency: 'USD' }); }
			document.getElementById("price").innerText = formatCurrency(book.price || 0);
			// refresh cart badge if header present
			if (typeof refreshCart === 'function') refreshCart();
			// check wishlist status
			await checkWishlistStatus();
        } 
    } catch (error) {
        console.error(error);
    }
});

// Check if book is in wishlist and update button
async function checkWishlistStatus() {
	const user = JSON.parse(localStorage.getItem('userData') || 'null');
	if (!user || !user.id) {
		// Not logged in - show default "Add to wishlist" button
		return;
	}
	
	try {
		const urlParams = new URLSearchParams(window.location.search);
		const bookId = urlParams.get('id');
		const response = await fetch(window.APP_CONFIG.backendUrl + '/api/check-fvbook', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'Authorization': 'Bearer'
			},
			body: JSON.stringify({ idusername: user.id, bookId: bookId })
		});
		
		if (response.ok) {
			const data = await response.json();
			const wishlistBtn = document.getElementById('wishlistBtn');
			const wishlistText = document.getElementById('wishlistText');
			
			if (data.check === 1) {
				// Book is in wishlist
				wishlistBtn.style.background = '#ff4444';
				wishlistText.textContent = 'Xoá khỏi yêu thích';
				wishlistBtn.dataset.inWishlist = 'true';
			} else {
				// Book not in wishlist
				wishlistBtn.style.background = 'aqua';
				wishlistText.textContent = 'Thêm vào yêu thích';
				wishlistBtn.dataset.inWishlist = 'false';
			}
		}
	} catch (error) {
		console.error('Check wishlist error:', error);
	}
}

// Toggle wishlist (add or remove)
async function toggleWishlist() {
	const user = JSON.parse(localStorage.getItem('userData') || 'null');
	if (!user || !user.id) {
		alert('Vui lòng đăng nhập để sử dụng chức năng yêu thích.');
		window.location.href = 'admin-ui/page-login.html';
		return;
	}
	
	const wishlistBtn = document.getElementById('wishlistBtn');
	const isInWishlist = wishlistBtn.dataset.inWishlist === 'true';
	
	if (isInWishlist) {
		await XoaKhoiYeuthich();
	} else {
		await themVaoYeuthich();
	}
}

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

function themVaoYeuthich()
{
    return new Promise(function(resolve, reject) {
        let xhr = new XMLHttpRequest();
		let urlParams = new URLSearchParams(window.location.search);
        let bookId = urlParams.get('id');
		let data = JSON.parse(localStorage.getItem('userData'));
		if (!data) {
			alert('Vui lòng đăng nhập để có thể thêm sách vào danh sách yêu thích.')
			return ;
		}else{
	        const token = localStorage.getItem('jwtToken');
	        if (!token) {
	            alert('Phiên đăng nhập hết hạn. Vui lòng đăng nhập lại.');
	            window.location.href = 'admin-ui/page-login.html';
	            return;
	        }
	        document.getElementById('loadingOverlay').style.display = 'flex';
			let bookData = {
            idusername: data.id,
			fvIdBook:bookId
        }

	xhr.open("POST", window.APP_CONFIG.backendUrl + "/api/create-fvbook", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let responseData = JSON.parse(xhr.responseText);
                alert(responseData.errMessage)
                document.getElementById('loadingOverlay').style.display = 'none';
	            // Update button UI
	            const wishlistBtn = document.getElementById('wishlistBtn');
	            const wishlistText = document.getElementById('wishlistText');
	            wishlistBtn.style.background = '#ff4444';
	            wishlistText.textContent = 'Xoá khỏi yêu thích';
	            wishlistBtn.dataset.inWishlist = 'true';
            }
        };
        xhr.send(JSON.stringify(bookData));
		}	
    });
}

function XoaKhoiYeuthich()
{
    return new Promise(function(resolve, reject) {
        let xhr = new XMLHttpRequest();
		let urlParams = new URLSearchParams(window.location.search);
        let bookId = urlParams.get('id');
		let data = JSON.parse(localStorage.getItem('userData'));
		if (!data) {
			alert('Vui lòng đăng nhập để có thể xoá sách khỏi danh sách yêu thích.')
			return ;
		}else{
	        const token = localStorage.getItem('jwtToken');
	        if (!token) {
	            alert('Phiên đăng nhập hết hạn. Vui lòng đăng nhập lại.');
	            window.location.href = 'admin-ui/page-login.html';
	            return;
	        }
	        document.getElementById('loadingOverlay').style.display = 'flex';
			let bookData = {
            idusername: data.id,
			bookId:bookId
        }
	xhr.open("POST", window.APP_CONFIG.backendUrl + "/api/delete-fvbook", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let responseData = JSON.parse(xhr.responseText);
				alert(responseData.errMessage)
                document.getElementById('loadingOverlay').style.display = 'none';
	            // Update button UI
	            const wishlistBtn = document.getElementById('wishlistBtn');
	            const wishlistText = document.getElementById('wishlistText');
	            wishlistBtn.style.background = 'aqua';
	            wishlistText.textContent = 'Thêm vào yêu thích';
	            wishlistBtn.dataset.inWishlist = 'false';
            }
        };
        xhr.send(JSON.stringify(bookData));
		}	
    });
}

// Quantity control functions
function increaseQuantity() {
	const input = document.getElementById('bookQuantity');
	let currentValue = parseInt(input.value) || 1;
	if (currentValue < 99) {
		input.value = currentValue + 1;
	}
}

function decreaseQuantity() {
	const input = document.getElementById('bookQuantity');
	let currentValue = parseInt(input.value) || 1;
	if (currentValue > 1) {
		input.value = currentValue - 1;
	}
}

// Add to cart function
async function addToCartDetail() {
	try {
		const user = JSON.parse(localStorage.getItem('userData') || 'null');
		if (!user || !user.id) {
			if (confirm('Bạn chưa đăng nhập. Bạn muốn tạo tài khoản bây giờ?')) {
				window.location.href = 'admin-ui/page-register.html';
			}
			return;
		}

		const token = localStorage.getItem('jwtToken');
		if (!token) {
			alert('Phiên đăng nhập hết hạn. Vui lòng đăng nhập lại.');
			window.location.href = 'admin-ui/page-login.html';
			return;
		}
		console.log('checking token', localStorage.getItem('jwtToken'));

		const book = window.currentBook || {};
		const urlParams = new URLSearchParams(window.location.search);
		const bookId = book.id || urlParams.get('id');
		const bookcode = book.bookcode || 'BOOK' + String(bookId).padStart(3, '0');
		const bookname = book.bookName || document.getElementById('bookName')?.textContent || '';
		const price = book.price || 0;
		
		// Get selected quantity
		const quantityInput = document.getElementById('bookQuantity');
		const quantity = parseInt(quantityInput?.value) || 1;

		if (!bookId || !bookname) {
			alert('Thiếu thông tin sách. Vui lòng thử lại.');
			return;
		}

		if (quantity < 1 || quantity > 99) {
			alert('Số lượng không hợp lệ. Vui lòng chọn từ 1-99.');
			return;
		}

		const backendBase = (window.APP_CONFIG && window.APP_CONFIG.backendUrl) 
			? String(window.APP_CONFIG.backendUrl).replace(/\/$/, '') 
			: 'http://localhost:8000';
		
		const apiUrl = `${backendBase}/api/save-cart`;
		// Build payload compatible with backend expectations.
		// Include top-level `userId` and single-item fields (bookId, qty, bookName, category, image)
		// while also keeping an `items` array for backward compatibility.
		function extractFilenameFromSrc(src) {
			try {
				const parts = String(src).split('/');
				return parts[parts.length - 1] || null;
			} catch (e) { return null; }
		}

		// Ensure we send a plain filename for the image (not full URL)
		let imageFilename = null;
		if (window.currentBook && window.currentBook.image) {
			imageFilename = extractFilenameFromSrc(window.currentBook.image) || String(window.currentBook.image);
		}
		if (!imageFilename) {
			imageFilename = extractFilenameFromSrc(document.getElementById('imageBook').src) || 'no-image.png';
		}

		const payload = {
			userId: user.id,
			bookId: parseInt(bookId),
			qty: quantity,
			bookName: bookname,
			category: (window.currentBook && window.currentBook.category) ? window.currentBook.category : null,
			image: imageFilename,
			items: [{
				bookId: parseInt(bookId),
				bookcode: bookcode,
				bookname: bookname,
				quantity: quantity,
				price: parseFloat(price) || 0,
				image: imageFilename
			}]
		};


		const resp = await fetch(apiUrl, {
			method: 'POST',
			headers: {
				'Authorization': 'Bearer ' + token,
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(payload)
		});

		const result = await resp.json();

		if (result.errCode === 0) {
			// Prefer numeric server total if provided, otherwise compute locally
			let serverTotal = Number(result.data && result.data.total);
			let displayTotal;
			if (Number.isFinite(serverTotal) && serverTotal > 0) {
				displayTotal = serverTotal;
			} else {
				// Fallback: compute from known price * quantity
				displayTotal = (Number(price) || 0) * Number(quantity);
			}
			alert('✓ Đã thêm ' + quantity + ' cuốn "' + bookname + '" vào giỏ hàng!');
			if (quantityInput) quantityInput.value = 1;
				try {
					await refreshCart();
				} catch (e) {
					console.warn('refreshCart failed before redirect', e);
				}
				// Redirect user to cart page after successful add
				window.location.href = 'cartbook.php';
		} else {
			alert('❌ Lỗi: ' + (result.errMessage || result.message || 'Không thể thêm vào giỏ hàng'));
			console.error('addToCartDetail failed:', result);
		}
	} catch (err) {
		console.error('addToCartDetail error:', err);
		alert('Lỗi kết nối. Vui lòng thử lại.');
	}
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
	/* Center the order button and keep the book card layout stable */
	.tg-postbook {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.tg-postbook .tg-postbookcontent {
		width: 100%;
		text-align: center;
	}

	.tg-orderbtn {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		margin-top: 12px;
		padding: 10px 18px;
		border-radius: 4px;
		background: transparent; /* default: no fill, like original */
		color: #2a7bd6; /* blue text/outline */
		border: 1px solid #2a7bd6;
		text-decoration: none;
		transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease;
	}

	.tg-orderbtn:hover {
		background: #2a7bd6; /* blue on hover */
		color: #fff;
		border-color: #2a7bd6;
	}

	.tg-orderbtn i { margin-right: 8px; }
</style>
		
</body>
</html>