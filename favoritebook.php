<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <title>Bookshop ai</title>
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

// ===== Danh mục + dữ liệu cho mega-menu & sidebar (giống bookdetail) =====
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

// Populate booksCount cho sidebar dựa trên grouped `result`
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

// Lấy danh sách sách yêu thích đầy đủ cho trang này
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
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: ' . 'Bearer' // Thêm token vào header Authorization
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
} else {
	$data4 = ['results' => []];
}

// ===== Yêu thích (badge header) & giỏ hàng giống các trang khác =====

// Yêu thích top 3 cho dropdown header
$url = rtrim(BACKEND_URL, '/') . '/api/get-fv3';

$idusername = $_COOKIE['idusername'] ?? -1;

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
	if ($response5 === FALSE) {
		die('Lỗi khi gửi yêu cầu: ' . curl_error($ch));
	}
	curl_close($ch);

	$data5 = json_decode($response5, true);
	if ($data5 === null) {
		die('Lỗi khi chuyển đổi JSON');
	}

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
				$key = md5(json_encode($entry));
			} else {
				$key = (string)$idKey;
			}
			if (!isset($unique[$key])) {
				$unique[$key] = $entry;
			}
		}
		$data5['results'] = array_values($unique);
		$data5['bookCount'] = count($data5['results']);
	} else {
		$data5['results'] = [];
		$data5['bookCount'] = 0;
	}
} else {
	$data5 = ['results' => [], 'bookCount' => 0];
}

// Giỏ hàng top 3
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
	if ($responseCart === FALSE) {
		// giữ $dataCart = null
	} else {
		$dataCart = json_decode($responseCart, true);
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
								<li>
									<a href="terms.php">
										<i class="icon-book"></i>
										<em>Điều khoản và Dịch Vụ</em>
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
													$catIdSafe = htmlspecialchars((string)($category['id'] ?? ''));
													$catNameSafe = htmlspecialchars((string)($category['category'] ?? ''));
													echo '<a href="#' . $catIdSafe . '" aria-controls="' . $catIdSafe . '" role="tab" data-toggle="tab">' . $catNameSafe . '</a>';
													echo '</li>';
																  }
														 }
													} else {
														echo 'Không có danh mục nào để hiển thị.';
														}
													?>
													</ul>
													<div class="tab-content tg-themetabcontent">
													<?php if (isset($data2['result']) && is_array($data2['result']) && count($data2['result'])>0): foreach ($data2['result'] as $catdata): ?>
														<?php $catPaneId = htmlspecialchars((string)($catdata['catId'] ?? ($catdata['id'] ?? ''))); ?>
														<div role="tabpanel" class="tab-pane active" id="<?= $catPaneId ?>">
															<ul>
																<li>
																	<div class="tg-linkstitle">
																		<h2>Tác giả</h2>
																	</div>
																	<ul>
																	<?php
																	$count = 0;
																	$displayed_authors = [];
																	if (isset($catdata['books']) && is_array($catdata['books'])) {
																		foreach ($catdata['books'] as $author) {
																			if ($count >= 5) break;
																			$authorName = (string)($author['author'] ?? '');
																			$authorNameEsc = htmlspecialchars($authorName);
																			if (in_array($authorNameEsc, $displayed_authors)) continue;
																			$displayed_authors[] = $authorNameEsc;
																			$authorUrl = 'findingbook.php?tukhoa=' . urlencode($authorName);
																			echo '<li><a href="' . $authorUrl . '" onclick="setCookie(\'tukhoa\', this.textContent.trim(), 30);">' . $authorNameEsc . '</a></li>';
																			$count++;
																		}
																	} else {
																		echo '<li><a>Không có tác giả</a></li>';
																	}
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
																	 if (isset($catdata['newbooks']) && is_array($catdata['newbooks'])) {
																	 	foreach ($catdata['newbooks'] as $newbook) {
																	 		if ($count >= 5) break;
																	 		$bookName = (string)($newbook['bookName'] ?? '');
																	 		if (in_array($bookName, $displayed_books)) continue;
																	 		$displayed_books[] = $bookName;																	 		$bookId = isset($newbook['id']) ? (string)$newbook['id'] : '';
																	 		$idAttr = htmlspecialchars($bookId);
																	 		$categoryJson = json_encode($catdata['category'] ?? '');
																	 		$idJson = json_encode($bookId);
																	 		echo '<li><a href="bookdetail.php?id=' . $idAttr . '" onClick="setCookiesBook(' . $categoryJson . ',' . $idJson . ')">' . htmlspecialchars($bookName) . '</a></li>';
																	 		$count++;
																	 	}
																	 }
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
																	  if (isset($catdata['books']) && is_array($catdata['books'])) {
																	  	foreach ($catdata['books'] as $book) {
																	  		if ($count >= 5) break;
																	  		$bookName = (string)($book['bookName'] ?? '');
																	  		if (in_array($bookName, $displayed_books)) continue;
																	  		$displayed_books[] = $bookName;
																	  		$bookId = isset($book['id']) ? (string)$book['id'] : '';
																	  		$idAttr = htmlspecialchars($bookId);
																	  		$categoryJson = json_encode($catdata['category'] ?? '');
																	  		$idJson = json_encode($bookId);
																	  		echo '<li><a href="bookdetail.php?id=' . $idAttr . '" onClick="setCookiesBook(' . $categoryJson . ',' . $idJson . ')">' . htmlspecialchars($bookName) . '</a></li>';
																	  		$count++;
																	  	}
																	  }
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
													<?php endif; ?>
													</div>
												</div>
											</li>
											<li class="menu-item-has-children">
												<a>Sách</a>
												<ul class="sub-menu">
													<li><a href="products.php?pageIndex=1">Sách mới nhất</a></li>
													<li><a href="products.php?pageIndex=1">Sách hay</a></li>
												</ul>
											</li>
											<li class="menu-item-has-children">
											<a>Tin tức</a>
											<ul class="sub-menu" id="menu-tin-tuc">
												<li><a href="newslist.php?pageIndex=1">Tin tức mới nhất</a></li>
												<li><a href="newslist.php?pageIndex=1">tin tức nổi bật</a></li>
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
									<div class="tg-products">
										<div class="tg-sectionhead">
											<h2>Sách yêu thích</h2>
										</div>
										<div class="tg-productgrid">
											<?php 
											if (isset($data4['results']) && !empty($data4['results'])) {
												// Lặp qua dữ liệu và hiển thị trong các div item
												foreach ($data4['results'] as $book) {
													// Chỉ hiển thị sách nếu showing = 1
													if ($book['showing'] == 1) {
														?>
														<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
																							<div class="tg-postbook">
																								<figure class="tg-featureimg">
																									<div class="tg-bookimg">
																										<div class="tg-frontcover"><img src="images/books/<?php echo htmlspecialchars($book['image']); ?>" alt="image description"></div>
																										<div class="tg-backcover"><img src="images/books/<?php echo htmlspecialchars($book['image']); ?>" alt="image description"></div>
																									</div>
																									<?php
																	$category = $book['category'];
																	$id = $book['id'];
																	// Sử dụng json_encode và htmlspecialchars để đảm bảo chuỗi an toàn cho JavaScript và HTML
																	$categoryJson = htmlspecialchars(json_encode($category), ENT_QUOTES, 'UTF-8');
																	$idJson = htmlspecialchars(json_encode($id), ENT_QUOTES, 'UTF-8');
																	?>
																									<a class="tg-btnaddtowishlist" href="bookdetail.php?id=<?php echo $idJson ?>" onClick="setCookiesBook(<?php echo $categoryJson ?>,<?php echo $idJson ?>)">
																										<span>Xem thêm</span>
																									</a>
																								</figure>
																								<div class="tg-postbookcontent">
																									<ul class="tg-bookscategories">
																										<li><a><?php echo htmlspecialchars($book['category']); ?></a></li>
																									</ul>
																									<div class="tg-booktitle">
																										<h3><a href="bookdetail.php?id=<?php echo $idJson ?>" onClick="setCookiesBook(<?php echo $categoryJson ?>,<?php echo $idJson ?>)"><?php echo htmlspecialchars($book['bookName']); ?></a></h3>
																									</div>
																									<span class="tg-bookwriter"> <a><?php echo htmlspecialchars($book['author']); ?></a></span>
																								</div>
																							</div>
																						</div>
																						<?php
													}
												}
											} else {
												echo '<h2>Hiện tại bạn chưa có sách yêu thích nào.</h2>';
											}
											?>
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
												foreach($data2['data'] as $cat) { 
												    $catName = isset($cat['category']) ? (string)$cat['category'] : (isset($cat['name']) ? (string)$cat['name'] : '');
												    $href = 'findingbook.php?tukhoa=' . urlencode($catName);
												?>
												<li>
												    <a href="<?php echo $href; ?>" onclick="setCookie('tukhoa', this.querySelector('span').textContent.trim(), 30);">
												        <span> <?php echo htmlspecialchars($catName); ?></span>
												        <em><?php echo htmlspecialchars($cat['booksCount']); ?></em>
												    </a>
												</li>
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
							<span class="tg-copyright">2017 All Rights Reserved By &copy; Bookshop ai</span>
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

		// Logout helper: clear local state and cookies
		function deleteCookie(name) {
			document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
		}
		function logout() {
			localStorage.removeItem('userData');
			localStorage.removeItem('jwtToken');
			deleteCookie('idusername');
			deleteCookie('token');
			deleteCookie('jwtToken');
		}

		// Show user name in header if logged in
		let data = localStorage.getItem('userData');
		if (data) {
			try {
				data = JSON.parse(data);
				if (document.querySelector('.dropbtn')) {
					document.querySelector('.dropbtn').innerHTML = 'Hi ' + (data.lastName || data.firstName || '');
				}
				const dd1 = document.querySelector('.dropdown-1');
				const dd2 = document.querySelector('.dropdown-2');
				if (dd1) dd1.innerHTML = 'Đăng xuất';
				if (dd2) dd2.style.display = 'none';
			} catch (e) {
				// fallback to anonymous state
				if (document.querySelector('.dropbtn')) document.querySelector('.dropbtn').innerHTML = 'Welcome';
			}
		} else {
			if (document.querySelector('.dropbtn')) document.querySelector('.dropbtn').innerHTML = 'Welcome';
			const dd1 = document.querySelector('.dropdown-1');
			const dd2 = document.querySelector('.dropdown-2');
			if (dd1) dd1.innerHTML = 'Đăng nhập';
			if (dd2) dd2.style.display = 'block';
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

		if (document.getElementById('searchForm')) {
			document.getElementById('searchForm').addEventListener('submit', function(event) {
				event.preventDefault(); // Ngăn chặn hành động gửi biểu mẫu mặc định

				let searchQuery = document.querySelector('input[name="search"]').value;
				setCookie('tukhoa', searchQuery, 30);
				let url = `findingbook.php?tukhoa=${encodeURIComponent(searchQuery)}`;
				
				// Điều hướng đến URL mới với từ khóa tìm kiếm
				window.location.href = url;
			});
		}
// Removed auto-scroll to main content to avoid unexpected page jumps
function setCookiesBook(category,bookId)
{
	setCookie('categoryBook', category, 30);
	setCookie('bookId', bookId, 30);
}
</script>		
</body>
</html>