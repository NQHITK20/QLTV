<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <title>nhà sách sách</title>
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

	<!-- Temporary UI adjustments: hide Add-to-cart button and price without removing HTML -->
	<style>
		/* Ẩn nút 'Thêm vào giỏ' để không thay đổi cấu trúc DOM (an toàn cho JS) */
		.btn-add-cart { display: none !important; }
		/* Ẩn phần hiển thị giá nếu cần */
		.tg-bookprice { display: none !important; }
		/* Giữ khoảng trống và căn giữa nút còn lại (Đặt sách) nếu layout cần */
		.tg-postbookcontent { min-height: 56px; }
		.tg-postbookcontent .tg-btn { display: inline-block; margin: 6px auto 0; }
	</style>
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

<body class="tg-home tg-homevtwo">
	
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
									<a href="contactus.html">
										<i class="icon-envelope"></i>
										<em>Liên hệ</em>
									</a>
								</li>
								<li>
									<a href="aboutus.html">
										<i class="icon-user"></i>
										<em>Về chúng tôi</em>
									</a>
								</li>
							</ul>
							<div class="tg-userlogin">
								<figure><a><img src="images/blank-avatar.jpg" alt="image description"></a></figure>
								<span onclick="profileBar()" class="dropbtn"></span>
								<div id="myDropdown" class="dropdown-content">
									<a class="dropdown-1" href="admin-ui/page-login.html" onclick="logout()"></i></a>
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
		<!--logo -->

		<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-04.jpg">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="tg-innerbannercontent">
							<h1>Chào mừng bạn đến với nhà sách</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
			<!--logo -->
		<!--************************************
				Main Start
		*************************************-->
		<main id="tg-main" class="tg-main tg-haslayout">
			<!--************************************
					Best Selling Start
			*************************************-->
			<section class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="tg-sectionhead">
								<h2><span>Bộ sưu tập</span>Sách mới</h2>
								<a class="tg-btn" href="products.php?pageIndex=1">Xem thêm</a>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div id="tg-bestsellingbooksslider" class="tg-bestsellingbooksslider tg-bestsellingbooks owl-carousel">
<?php
// Kiểm tra nếu dữ liệu có chứa key 'data'
if (isset($data['data'])) {
    // Lặp qua dữ liệu và hiển thị trong các div item
    foreach ($data['data'] as $book) {
        // Chỉ hiển thị sách nếu showing = 1
        if ($book['showing'] == 1) {
            ?>
            <div class="item">
                <div class="tg-postbook">
                    <figure class="tg-featureimg">
                        <div class="tg-bookimg">
                            <div class="tg-frontcover"><img src="images/books/<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['bookName']); ?>"></div>
                            <div class="tg-backcover"><img src="images/books/<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['bookName']); ?>"></div>
                        </div>
                        <a class="tg-btnaddtowishlist"
						href="bookdetail.php?id=<?php echo htmlspecialchars($book['id']); ?>"
						<?php
						$category = $book['category'];
						$id = $book['id'];
						// Sử dụng json_encode và htmlspecialchars để đảm bảo chuỗi an toàn cho JavaScript và HTML
						$categoryJson = htmlspecialchars(json_encode($category), ENT_QUOTES, 'UTF-8');
						$idJson = htmlspecialchars(json_encode($id), ENT_QUOTES, 'UTF-8');
						?>
						onClick="setCookiesBook(<?php echo $categoryJson; ?>,<?php echo $idJson; ?>)">
                            <span>Xem thêm</span>
                        </a>
                    </figure>
                    <div class="tg-postbookcontent">
                        <ul class="tg-bookscategories">
                            <li><?php echo htmlspecialchars($book['category']); ?></li>
                        </ul>
                        <div class="tg-themetagbox"><span class="tg-themetag">mới</span></div>
                        <div class="tg-booktitle">
                            <h3><a href="bookdetail.php?id=<?php echo htmlspecialchars($book['id']); ?>" onClick="setCookiesBook(<?php echo $categoryJson; ?>,<?php echo $idJson; ?>))"><?php echo htmlspecialchars($book['bookName']); ?></a></h3>
                        </div>
                        <span class="tg-bookwriter">Tác giả : <?php echo htmlspecialchars($book['author']); ?></span>
						<span class="tg-bookprice">
							<ins><?php echo htmlspecialchars($book['price']); ?> nvđ</ins>
						</span>
                    </div>
                </div>
            </div>
            <?php
        }
    }
} else {
    echo '<p>Không có dữ liệu</p>';
}
?>

							</div>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					Best Selling End
			*************************************-->
			<!--************************************
					Picked By Author Start
			*************************************-->
			<section class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="tg-sectionhead">
								<h2><span>Bộ sưu tập</span>Sách đang hot</h2>
								<a class="tg-btn" href="javascript:void(0);">Xem tất cả</a>
							</div>
						</div>
						<div id="tg-pickedbyauthorslider" class="tg-pickedbyauthor tg-pickedbyauthorslider owl-carousel">
								<?php
                                // Sử dụng trực tiếp $data12 đã được chuẩn hóa
                                $hotBooks = [];
                                if (!empty($data12) && is_array($data12)) {
                                    $hotBooks = $data12;
                                }								// fallback to $data (main book list) if $hotBooks is empty
								if (empty($hotBooks) && isset($data['data']) && is_array($data['data'])) {
									$hotBooks = $data['data'];
								}
								if (!empty($hotBooks)) {
									$count = 0;
									foreach ($hotBooks as $item) {
										// Lấy đúng dữ liệu sách từ mảng lồng
										$book = is_array($item) && isset($item[0]) ? $item[0] : $item;
										if ($count >= 12) break;
										// Nếu có trường 'showing' thì kiểm tra, còn không thì vẫn hiển thị
										if (isset($book['showing']) && (string)$book['showing'] !== '1') continue;
										$category = $book['category'] ?? '';
										$id = $book['id'] ?? '';
										$bookName = $book['bookName'] ?? '';
										// Prepare values: URL-encoded id for href, JSON-encoded strings for JS calls
										$categoryJson = json_encode((string)$category);
										$idAttr = rawurlencode((string)$id);
										$idJs = json_encode((string)$id);
										$bookNameJson = json_encode((string)$bookName);
										?>
										<div class="item">
											<div class="tg-postbook">
												<figure class="tg-featureimg">
													<div class="tg-bookimg">
														<?php
														$imgFile = (!empty($book['image'])) ? htmlspecialchars($book['image']) : 'no-image.png';
														?>
														<div class="tg-frontcover"><img src="images/books/<?php echo $imgFile; ?>" alt="<?php echo htmlspecialchars($book['bookName'] ?? 'book'); ?>"></div>
													</div>
													<div class="tg-hovercontent">
														<div class="tg-description">
															<p><?php echo htmlspecialchars(mb_substr($book['description'] ?? '', 0, 120)); ?></p>
														</div>
														<strong class="tg-bookcategory">Danh mục: <?php echo htmlspecialchars($book['category'] ?? ''); ?></strong>
														<strong class="tg-bookprice">Giá: <?php echo htmlspecialchars($book['price'] ?? 0); ?> vnđ</strong>
													</div>
												</figure>
												<div class="tg-postbookcontent">
													<div class="tg-booktitle">
														<h3><a href="bookdetail.php?id=<?php echo $idAttr; ?>" onClick="setCookiesBook(<?php echo $categoryJson; ?>,<?php echo $idJs; ?>)"><?php echo htmlspecialchars($book['bookName'] ?? ''); ?></a></h3>
													</div>
													<span class="tg-bookwriter">Tác giả: <?php echo htmlspecialchars($book['author'] ?? ''); ?></span>
																	 <?php
																	 // Ensure book id is taken from the prepared $id variable
																	 $safeId = isset($id) ? (string)$id : '';
																	 $safeBookcode = isset($book['bookcode']) ? (string)$book['bookcode'] : 'BOOK' . str_pad($safeId, 3, '0', STR_PAD_LEFT);
																	 $safePrice = isset($book['price']) ? (string)$book['price'] : '0';
																	 ?>
																	 <a class="tg-btn tg-btnstyletwo btn-order" href="bookdetail.php?id=<?php echo $idAttr; ?>"
																		 data-bookid="<?php echo htmlspecialchars($safeId, ENT_QUOTES); ?>"
																		 data-category="<?php echo htmlspecialchars($category ?? '', ENT_QUOTES); ?>"
																		 data-bookname="<?php echo htmlspecialchars($bookName ?? '', ENT_QUOTES); ?>">
														<i class="fa fa-shopping-basket"></i>
														<em>Đặt sách</em>
													</a>
													  <a class="tg-btn tg-active btn-add-cart" href="javascript:void(0);"
														  data-bookid="<?php echo htmlspecialchars($safeId, ENT_QUOTES); ?>"
														  data-bookcode="<?php echo htmlspecialchars($safeBookcode, ENT_QUOTES); ?>"
														  data-bookname="<?php echo htmlspecialchars($bookName ?? '', ENT_QUOTES); ?>"
														  data-price="<?php echo htmlspecialchars($safePrice, ENT_QUOTES); ?>"
														  data-image="<?php echo $imgFile; ?>">
														<i class="fa fa-shopping-cart"></i>
														<em>Thêm vào giỏ</em>
													</a>
												</div>
											</div>
										</div>
										<?php
										$count++;
									}
								} else {
									echo '<div class="item"><p>Không có sách đang hot.</p></div>';
								}
								?>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					Picked By Author End
			*************************************-->

			<section class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="tg-sectionhead">
								<h2><span>Mới &amp; Đang hot</span>Tin tức mới nhất</h2>
								<a class="tg-btn" href="newslist.php?pageIndex=1">Xem thêm</a>
							</div>
						</div>
						<div id="tg-postslider" class="tg-postslider tg-blogpost owl-carousel">
						<?php
// Kiểm tra nếu dữ liệu có chứa key 'data'
if (isset($data3['data'])) {
    // Lặp qua dữ liệu và hiển thị trong các div item
    foreach ($data3['data'] as $new) {
        // Chỉ hiển thị sách nếu showing = 1
        if ($new['showing'] == 1) {

		   $dateString = $new['publicAt'];

           // Tạo một đối tượng DateTime từ chuỗi ngày giờ
           $datetime = new DateTime($dateString);

           // Định dạng lại ngày giờ theo định dạng mong muốn
           $formattedDatetime = $datetime->format('d/m/Y - H:i');
            ?>
            <article class="item tg-post">
                <figure><a href="newsdetail.php?id=<?php echo htmlspecialchars($new['id']);?>"><img src="images/blog/<?php echo htmlspecialchars($new['image']); ?>" alt="image description"></a></figure>
                <div class="tg-postcontent">
                    <ul class="tg-bookscategories">
                        <li><p><?php echo htmlspecialchars($formattedDatetime); ?></p></li>
                    </ul>
                    <div class="tg-themetagbox"><span class="tg-themetag">mới</span></div>
                    <div class="tg-posttitle">
                        <h3><a href="newsdetail.php?id=<?php echo htmlspecialchars($new['id']);?>"><?php echo htmlspecialchars($new['title']); ?></a></h3>
                    </div>
                    <span class="tg-bookwriter"><a><?php echo htmlspecialchars($new['author']); ?></a></span>

					
                </div>
            </article>
            <?php
        }
    }
} else {
    echo '<p>Không có dữ liệu</p>';
}
?>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					Latest News End
			*************************************-->

			<!--about -us-->
			<section class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="tg-aboutus">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="tg-aboutusshortcode">
									<div class="tg-sectionhead">
										<h2><span>Thông tin &amp; Liên hệ</span>Về nhà sách chúng tôi</h2>
									</div>
									<div class="tg-description">
										<p style="font-size: 17px;">Consectetur adipisicing elit sed do 
											eiusmod tempor incididunt labore toloregna aliqua. Ut en
											im ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo conse
											quat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla paria
											tur cepteur sint occaecat cupidatat.</p>
									</div>
									<div class="tg-btns">
										<a class="tg-btn" href="contactus.html">Liên hệ</a>
										<a class="tg-btn" href="aboutus.html">Tìm hiểu thêm</a>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<iframe width="560" height="330" src="https://www.youtube.com/embed/OKB1PuclFEo?si=9S8Ve2A-Hl_3Y6dd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--about -us-->
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
										<h3>Thông tin nhà sách</h3>
									</div>
									<div class="tg-widgetcontent">
										<ul>
											<li><a href="contactus.html">Liên hệ</a></li>
											<li><a href="aboutus.html">Về chúng tôi</a></li>
										</ul>
										<ul>
											<li><a href="products.php?pageIndex=1">Sách</a></li>
											<li><a href="aboutus.html">Tin tức</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="tg-footercol tg-widget tg-widgettopsellingauthors">
									<div class="tg-widgettitle">
										<h3>Địa chỉ nhà sách</h3>
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

function setCookiesBook(category,bookId)
{
	setCookie('categoryBook', category, 30);
	setCookie('bookId', bookId, 30);
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
let cookiesBook = getCookieValue('categoryBook')
eraseCookie(cookiesBook);

let databook = <?php echo json_encode($data) ?>;
let datanews = <?php echo json_encode($data33) ?>;

document.cookie = 'listing_book=' + JSON.stringify(loadcookies(databook,12)) + '; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/;';
document.cookie = 'page_index_book=' + 1 + '; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/;';
document.cookie = 'last_page_book=' + Math.ceil(databook.data.length / 12) + '; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/;';
document.cookie = 'listing_new=' + JSON.stringify(loadcookies(datanews,4)) + '; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/;';
document.cookie = 'page_index_new=' + 1 + '; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/;';
document.cookie = 'last_page_new=' + Math.ceil(datanews.data.length / 4) + '; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/;';

document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn hành động gửi biểu mẫu mặc định

        let searchQuery = document.querySelector('input[name="search"]').value;
		setCookie('tukhoa', searchQuery, 30);
        let url = `findingbook.php?tukhoa=${encodeURIComponent(searchQuery)}`;
        
        // Điều hướng đến URL mới với từ khóa tìm kiếm
        window.location.href = url;
});

let data2 = JSON.parse(localStorage.getItem('userData'));
let token = localStorage.getItem('jwtToken');

            // Kiểm tra nếu dữ liệu tồn tại
            if (data2 && token) {
                // Lưu vào cookies
                setCookie('idusername', data2.id, 30);
                setCookie('token', token, 30);
            } else {
                console.error('Thiếu dữ liệu người dùng hoặc token.');
            }

	</script>

	<script>
		// ----- Shopping cart frontend helpers -----
		async function addToCart(bookId, bookcode, bookname, price = 0, image = null) {
			// Check login first
			const user = JSON.parse(localStorage.getItem('userData') || 'null');
			if (!user || !user.id) {
				if (confirm('Bạn chưa đăng nhập. Bạn muốn tạo tài khoản bây giờ?')) {
					window.location.href = 'admin-ui/page-register.html';
				}
				return;
			}

			// Validate required data
			if (!bookId || !bookcode || !bookname) {
				alert('Thiếu thông tin sách. Vui lòng thử lại.');
				console.error('addToCart: missing data', { bookId, bookcode, bookname });
				return;
			}

			// Get JWT token for authentication
			const token = localStorage.getItem('jwtToken');
			console.log('addToCart token:', token);
			if (!token) {
				alert('Phiên đăng nhập hết hạn. Vui lòng đăng nhập lại.');
				window.location.href = 'admin-ui/page-login.html';
				return;
			}

			// Prepare API request
			const backendBase = (window.APP_CONFIG && window.APP_CONFIG.backendUrl) 
				? String(window.APP_CONFIG.backendUrl).replace(/\/$/, '') 
				: 'http://localhost:8001';
			
			const apiUrl = `${backendBase}/api/save-cart`;
			const payload = {
				items: [{
					bookId: parseInt(bookId),
					bookcode: bookcode,
					bookname: bookname,
					quantity: 1,
					price: parseFloat(price) || 0,
					image: image || null
				}]
			};

            

			try {
				const response = await fetch(apiUrl, {
					method: 'POST',
					headers: {
						'Authorization': `Bearer ${token}`,
						'Content-Type': 'application/json'
					},
					body: JSON.stringify(payload)
				});

				const result = await response.json();

				if (response.ok && result.errCode === 0) {
					// Optionally refresh cart in background then redirect user to cart page
					try {
						if (typeof refreshCart === 'function') {
							await refreshCart();
						}
					} catch (e) {
						console.warn('refreshCart failed before redirect', e);
					}
					// Redirect to the cart page after successful add
					window.location.href = 'cartbook.php';
				} else {
					const errorMsg = result.message || result.errors || 'Không thể thêm vào giỏ hàng';
					alert('Lỗi: ' + errorMsg);
					console.error('addToCart failed:', result);
				}
			} catch (error) {
				console.error('addToCart error:', error);
				alert('Lỗi kết nối. Vui lòng thử lại.');
			}
		}

		async function orderBook(bookId, category, bookName) {
			// When user clicks 'Đặt sách' on homepage: check login and redirect to product detail page.
			const user = JSON.parse(localStorage.getItem('userData') || 'null');
			if (!user || !user.id) {
				// not logged in -> prompt to register
				if (confirm('Bạn chưa đăng nhập. Bạn muốn tạo tài khoản bây giờ?')) {
					window.location.href = 'admin-ui/page-register.html';
					return;
				}
				// user cancelled -> do nothing
				return;
			}

			// Save selection cookies (maintain existing behavior)
			try {
				if (typeof setCookie === 'function') {
					if (category !== undefined) setCookie('categoryBook', category, 30);
					if (bookId !== undefined) setCookie('bookId', bookId, 30);
				}
			} catch (e) {
				console.warn('Could not set selection cookies', e);
			}

			// Determine final book id: prefer passed value, fall back to cookie
			let targetId = (bookId !== undefined && bookId !== null && String(bookId).trim() !== '') ? String(bookId) : null;
			if (!targetId && typeof getCookie === 'function') {
				const cookieVal = getCookie('bookId');
				if (cookieVal) targetId = cookieVal;
			}

			if (!targetId || String(targetId).trim() === '') {
				console.error('orderBook: missing bookId, cannot redirect to detail. bookId param:', bookId, 'cookie bookId:', getCookie && getCookie('bookId'));
				alert('Không xác định được mã sách. Vui lòng thử lại.');
				return;
			}

			// Redirect to the book detail page for the selected book
			const target = 'bookdetail.php?id=' + encodeURIComponent(targetId);
			window.location.href = target;
		}

		function escapeHtml(s) {
			if (!s) return '';
			return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
		}

		// refresh cart on page load
		document.addEventListener('DOMContentLoaded', function () {
			refreshCart();
		});

        

		// Delegated click handler for homepage 'Đặt sách' and 'Thêm vào giỏ' buttons.
		// Uses data-attributes to avoid inline JS quoting issues and to ensure bookId is available.
		document.addEventListener('click', function (e) {
			// Check for order button
			var orderBtn = e.target.closest && e.target.closest('.btn-order');
			if (orderBtn) {
				e.preventDefault();
				var bookId = orderBtn.getAttribute('data-bookid') || getCookie('bookId');
				var category = orderBtn.getAttribute('data-category') || '';
				var bookName = orderBtn.getAttribute('data-bookname') || '';
				if (typeof setCookie === 'function') {
					setCookie('categoryBook', category, 30);
					setCookie('bookId', bookId, 30);
				}
				if (!bookId) {
					console.error('order click: missing bookId', { passed: orderBtn.getAttribute('data-bookid'), cookie: getCookie('bookId') });
					alert('ID sách không xác định. Vui lòng thử lại.');
					return;
				}
                
				// call existing order handler (will check login and redirect to detail)
				orderBook(bookId, category, bookName);
				return;
			}

			// Check for add-to-cart button
			var cartBtn = e.target.closest && e.target.closest('.btn-add-cart');
			if (cartBtn) {
				e.preventDefault();
				var bookId = cartBtn.getAttribute('data-bookid');
				var bookcode = cartBtn.getAttribute('data-bookcode');
				var bookname = cartBtn.getAttribute('data-bookname');
				var price = cartBtn.getAttribute('data-price') || '0';
				// image attribute added to button; fallback: try to find nearest img in the item
				var image = cartBtn.getAttribute('data-image') || null;
				if (!image) {
					const frontImg = cartBtn.closest('.tg-postbook')?.querySelector('.tg-frontcover img');
					if (frontImg && frontImg.getAttribute('src')) {
						// extract filename from src if it's under images/books/
						const s = frontImg.getAttribute('src');
						const m = s.match(/images\/books\/(.+)$/);
						if (m) image = m[1];
					}
				}
				
				if (!bookId || !bookcode || !bookname) {
					console.error('cart click: missing data', { bookId, bookcode, bookname });
					alert('Thiếu thông tin sách. Vui lòng thử lại.');
					return;
				}
				
                
				addToCart(bookId, bookcode, bookname, price, image);
				return;
			}
		});
	</script>

</body>

</html>