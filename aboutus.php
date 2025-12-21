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

// Compute site frontend base (used for image URLs)
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$siteBase = rtrim($scheme . $host, '/') . '/QLTV-ChatboxAi/frontend';

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
	// keep page visible even if backend is down
	$data = ['data' => []];
} else {
	$data = json_decode($response, true) ?: ['data' => []];
}
curl_close($ch);

// get-all-book F10 -> $data9
$url = rtrim(BACKEND_URL, '/') . '/api/get-all-book';
$databook = array('id' => 'F10');
$jsonData = json_encode($databook);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer'
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
$response9 = curl_exec($ch);
if ($response9 === FALSE) {
	$data9 = ['data' => []];
} else {
	$data9 = json_decode($response9, true) ?: ['data' => []];
}
curl_close($ch);

// get-category-by-id -> $data2
$url = rtrim(BACKEND_URL, '/') . '/api/get-category-by-id';
$datacat = array('id' => 'F10');
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
	$data2 = ['result' => []];
} else {
	$data2 = json_decode($response2, true) ?: ['result' => []];
}
curl_close($ch);

// get-news F7 -> $data3
$url = rtrim(BACKEND_URL, '/') . '/api/get-news';
$datanew = array('id' => 'F7');
$jsonData = json_encode($datanew);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer YOUR_TOKEN_HERE'
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

// get-news ALLSHOW -> $data33
$url = rtrim(BACKEND_URL, '/') . '/api/get-news';
$datanew2 = array('id' => 'ALLSHOW');
$jsonData11 = json_encode($datanew2);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer YOUR_TOKEN_HERE'
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData11);
$response33 = curl_exec($ch);
if ($response33 === FALSE) {
	$data33 = ['data' => []];
} else {
	$data33 = json_decode($response33, true) ?: ['data' => []];
}
curl_close($ch);

// get-fv3 -> $data5 (favorites) with dedupe
$url = rtrim(BACKEND_URL, '/') . '/api/get-fv3';
$idusername = $_COOKIE['idusername'] ?? -1;
$data5 = ['results' => [], 'bookCount' => 0];
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
		} else {
			$data5['results'] = [];
			$data5['bookCount'] = 0;
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

// get-all-book L12 -> $data12
$url = rtrim(BACKEND_URL, '/') . '/api/get-all-book';
$databook12 = array('id' => 'L12');
$jsonData12 = json_encode($databook12);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer'
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData12);
$response12 = curl_exec($ch);
if ($response12 === FALSE) {
	$data12 = [];
} else {
	$data12 = json_decode($response12, true) ?: [];
	if (isset($data12['data'])) {
		$data12 = $data12['data'];
	} elseif (isset($data12['results'])) {
		$data12 = $data12['results'];
	}
}
curl_close($ch);

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
							<strong class="tg-logo"><a href="index.php"><img src="images/flogo.png"
										alt="company name here"></a></strong>
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
										<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
											data-target="#tg-navigation" aria-expanded="false">
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
														<div role="tabpanel" class="tab-pane active"
															id="<?= htmlspecialchars($catdata['catId']) ?>">
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
																		<li><a>
																				<?= htmlspecialchars($author['author']) ?>
																			</a></li>
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
																		<li><a>
																				<?= htmlspecialchars($newbook['bookName']) ?>
																			</a></li>
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
																		<li><a>
																				<?= htmlspecialchars($book['bookName']) ?>
																			</a></li>
																		<?php 
		                                                                      $count++;
		                                                                      endforeach; 
		                                                                      ?>
																	</ul>
																</li>
															</ul>
															<ul>
																<li>
																	<figure><img src="images/img-01.png"
																			alt="image description"></figure>
																	<div class="tg-textbox">
																		<h3>Hơn <span>10,000</span>cuốn sách chờ bạn khám phá
																		</h3>
																		<a class="tg-btn" href="products.php?pageIndex=1">Xem
																			thêm</a>
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
										<a href="javascript:void(0);" id="tg-wishlisst" class="tg-btnthemedropdown"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="tg-themebadge">
												<?php echo $data5['bookCount'] ?>
											</span>
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
														<img src="images/books/<?php echo $book['image']; ?>" alt="image bug"
															style="width:65px">
		
													</figure>
													<div class="tg-minicarproductdata">
														<h5><a>
																<?php echo $book['bookName']; ?>
															</a></h5>
														<h6><a>
																<?php echo $book['category']; ?>
															</a></h6>
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
										<a href="javascript:void(0);" id="tg-cartdrop" class="tg-btnthemedropdown"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="tg-themebadge">
												<?php echo isset($dataCart['itemCount']) ? htmlspecialchars($dataCart['itemCount']) : '0'; ?>
											</span>
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
														<img src="images/books/<?php echo $img; ?>" alt="image description"
															style="width:65px">
													</figure>
													<div class="tg-minicarproductdata">
														<h5><a href="cartbook.php">
																<?php echo $title ?: 'Sách'; ?>
															</a></h5>
														<h6><a href="javascript:void(0);">
																<?php echo $category; ?>
															</a></h6>
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
							<h1>About Us</h1>
							<ol class="tg-breadcrumb">
								<li><a href="javascript:void(0);">home</a></li>
								<li class="tg-active">About Us</li>
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
					About Us Start
			*************************************-->
			<section class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="tg-aboutus">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="tg-aboutusshortcode">
									<div class="tg-sectionhead">
										<h2><span>Greetings &amp; Welcome</span>Về chúng tôi</h2>
									</div>
									<div class="tg-description">
										<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p>
									</div>
									<div class="tg-btns">
										<a class="tg-btn tg-active" href="javascript:void(0);">Our History</a>
										<a class="tg-btn" href="javascript:void(0);">Meet Our Team</a>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<figure>
									<img src="images/placeholder.jpg" alt="image description">
									<iframe src="https://www.youtube.com/embed/acwr_Islo9A?rel=0&amp;controls=0&amp;showinfo=0"></iframe>
								</figure>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					About Us End
			*************************************-->
			<!--************************************
					Call to Action Start
			*************************************-->
			<section class="tg-parallax tg-bgcalltoaction tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-06.jpg">
				<div class="tg-sectionspace tg-haslayout">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="tg-calltoaction">
									<h2>Fully Loaded Template</h2>
									<h3>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore.</h3>
									<a class="tg-btn tg-active" href="javascript:void(0);">Buy Now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					Call to Action End
			*************************************-->
			<!--************************************
					Success Start
			*************************************-->
			<section class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="tg-successstory">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="tg-sectionhead">
									<h2><span>Our Pride Moments</span>Journey of Success</h2>
								</div>
								<div id="tg-successslider" class="tg-successslider tg-success owl-carousel">
									<div class="item">
										<figure>
											<img src="images/img-01.jpg" alt="image description">
										</figure>
										<div class="tg-successcontent">
											<div class="tg-sectionhead">
												<h2><span>June 27, 2017</span>First Step Toward Success</h2>
											</div>
											<div class="tg-description">
												<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p>
											</div>
										</div>
									</div>
									<div class="item">
										<figure>
											<img src="images/img-01.jpg" alt="image description">
										</figure>
										<div class="tg-successcontent">
											<div class="tg-sectionhead">
												<h2><span>June 27, 2017</span>First Step Toward Success</h2>
											</div>
											<div class="tg-description">
												<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p>
											</div>
										</div>
									</div>
									<div class="item">
										<figure>
											<img src="images/img-01.jpg" alt="image description">
										</figure>
										<div class="tg-successcontent">
											<div class="tg-sectionhead">
												<h2><span>June 27, 2017</span>First Step Toward Success</h2>
											</div>
											<div class="tg-description">
												<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					Success End
			*************************************-->
			<!--************************************
					Testimonials Start
			*************************************-->
			<section class="tg-parallax tg-bgtestimonials tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-05.jpg">
				<div class="tg-sectionspace tg-haslayout">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-2">
								<div id="tg-testimonialsslider" class="tg-testimonialsslider tg-testimonials owl-carousel">
									<div class="item tg-testimonial">
										<figure><img src="images/author/imag-02.jpg" alt="image description"></figure>
										<blockquote><q>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore tolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamcoiars nisi ut aliquip commodo.</q></blockquote>
										<div class="tg-testimonialauthor">
											<h3>Holli Fenstermacher</h3>
											<span>Manager @ CIFP</span>
										</div>
									</div>
									<div class="item tg-testimonial">
										<figure><img src="images/author/imag-02.jpg" alt="image description"></figure>
										<blockquote><q>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore tolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamcoiars nisi ut aliquip commodo.</q></blockquote>
										<div class="tg-testimonialauthor">
											<h3>Holli Fenstermacher</h3>
											<span>Manager @ CIFP</span>
										</div>
									</div>
									<div class="item tg-testimonial">
										<figure><img src="images/author/imag-02.jpg" alt="image description"></figure>
										<blockquote><q>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore tolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamcoiars nisi ut aliquip commodo.</q></blockquote>
										<div class="tg-testimonialauthor">
											<h3>Holli Fenstermacher</h3>
											<span>Manager @ CIFP</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					Testimonials End
			*************************************-->
			<!--************************************
					Authors Start
			*************************************-->
			<section class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="tg-sectionhead">
								<h2><span>Team Behind Book Library</span>Meet Our Professionals</h2>
							</div>
						</div>
						<div id="tg-teamsslider" class="tg-authors tg-authorsslider tg-teamsmember owl-carousel">
							<div class="item tg-author tg-member">
								<figure><a href="javascript:void(0);"><img src="images/team/img-01.jpg" alt="image description"></a></figure>
								<div class="tg-authorcontent">
									<h2><a href="javascript:void(0);">Jude Morphew</a></h2>
									<span>Online Retail Manager</span>
									<ul class="tg-socialicons">
										<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
										<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
										<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="item tg-author tg-member">
								<figure><a href="javascript:void(0);"><img src="images/team/img-02.jpg" alt="image description"></a></figure>
								<div class="tg-authorcontent">
									<h2><a href="javascript:void(0);">Book Burger</a></h2>
									<span>Bookstore Director</span>
									<ul class="tg-socialicons">
										<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
										<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
										<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="item tg-author tg-member">
								<figure><a href="javascript:void(0);"><img src="images/team/img-03.jpg" alt="image description"></a></figure>
								<div class="tg-authorcontent">
									<h2><a href="javascript:void(0);">Book Ship &amp; Co.</a></h2>
									<span>Business Operations</span>
									<ul class="tg-socialicons">
										<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
										<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
										<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="item tg-author tg-member">
								<figure><a href="javascript:void(0);"><img src="images/team/img-04.jpg" alt="image description"></a></figure>
								<div class="tg-authorcontent">
									<h2><a href="javascript:void(0);">Enoch Gallion</a></h2>
									<span>Assistant Director</span>
									<ul class="tg-socialicons">
										<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
										<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
										<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="item tg-author tg-member">
								<figure><a href="javascript:void(0);"><img src="images/team/img-05.jpg" alt="image description"></a></figure>
								<div class="tg-authorcontent">
									<h2><a href="javascript:void(0);">Book House</a></h2>
									<span>Business Operations</span>
									<ul class="tg-socialicons">
										<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
										<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
										<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="item tg-author tg-member">
								<figure><a href="javascript:void(0);"><img src="images/team/img-04.jpg" alt="image description"></a></figure>
								<div class="tg-authorcontent">
									<h2><a href="javascript:void(0);">Linnie Klimek</a></h2>
									<span>Assistant Director</span>
									<ul class="tg-socialicons">
										<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
										<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
										<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
					Authors End
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
										<h3>Thông tin nhà sách</h3>
									</div>
									<div class="tg-widgetcontent">
										<ul>
											<li><a href="contactus.php">Liên hệ</a></li>
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
				return;
			}

			// Get JWT token for authentication
			const token = localStorage.getItem('jwtToken');
			if (!token) {
				alert('Phiên đăng nhập hết hạn. Vui lòng đăng nhập lại.');
				window.location.href = 'admin-ui/page-login.html';
				return;
			}

			// Prepare API request
			const backendBase = (window.APP_CONFIG && window.APP_CONFIG.backendUrl) 
				? String(window.APP_CONFIG.backendUrl).replace(/\/$/, '') 
				: 'http://localhost:8000';
			
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
					try {
						if (typeof refreshCart === 'function') {
							await refreshCart();
						}
					} catch (e) {
						console.warn('refreshCart failed before redirect', e);
					}
					window.location.href = 'cartbook.php';
				} else {
					const errorMsg = result.message || result.errors || 'Không thể thêm vào giỏ hàng';
					alert('Lỗi: ' + errorMsg);
				}
			} catch (error) {
				alert('Lỗi kết nối. Vui lòng thử lại.');
			}
		}

		async function orderBook(bookId, category, bookName) {
			const user = JSON.parse(localStorage.getItem('userData') || 'null');
			if (!user || !user.id) {
				if (confirm('Bạn chưa đăng nhập. Bạn muốn tạo tài khoản bây giờ?')) {
					window.location.href = 'admin-ui/page-register.html';
					return;
				}
				return;
			}

			try {
				if (typeof setCookie === 'function') {
					if (category !== undefined) setCookie('categoryBook', category, 30);
					if (bookId !== undefined) setCookie('bookId', bookId, 30);
				}
			} catch (e) {
				console.warn('Could not set selection cookies', e);
			}

			let targetId = (bookId !== undefined && bookId !== null && String(bookId).trim() !== '') ? String(bookId) : null;
			if (!targetId && typeof getCookie === 'function') {
				const cookieVal = getCookie('bookId');
				if (cookieVal) targetId = cookieVal;
			}

			if (!targetId || String(targetId).trim() === '') {
				alert('Không xác định được mã sách. Vui lòng thử lại.');
				return;
			}

			const target = 'bookdetail.php?id=' + encodeURIComponent(targetId);
			window.location.href = target;
		}

		function escapeHtml(s) {
			if (!s) return '';
			return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
		}

		// refresh cart on page load
		document.addEventListener('DOMContentLoaded', function () {
			if (typeof refreshCart === 'function') refreshCart();
		});

		// Delegated click handler for order / add-to-cart
		document.addEventListener('click', function (e) {
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
				if (!bookId) { alert('ID sách không xác định. Vui lòng thử lại.'); return; }
				orderBook(bookId, category, bookName);
				return;
			}

			var cartBtn = e.target.closest && e.target.closest('.btn-add-cart');
			if (cartBtn) {
				e.preventDefault();
				var bookId = cartBtn.getAttribute('data-bookid');
				var bookcode = cartBtn.getAttribute('data-bookcode');
				var bookname = cartBtn.getAttribute('data-bookname');
				var price = cartBtn.getAttribute('data-price') || '0';
				var image = cartBtn.getAttribute('data-image') || null;
				if (!image) {
					const frontImg = cartBtn.closest('.tg-postbook')?.querySelector('.tg-frontcover img');
					if (frontImg && frontImg.getAttribute('src')) {
						const s = frontImg.getAttribute('src');
						const m = s.match(/images\/books\/(.+)$/);
						if (m) image = m[1];
					}
				}
				if (!bookId || !bookcode || !bookname) { alert('Thiếu thông tin sách. Vui lòng thử lại.'); return; }
				addToCart(bookId, bookcode, bookname, price, image);
				return;
			}
		});
	</script>
</body>

</html>