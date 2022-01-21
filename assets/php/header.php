<?php
session_start();
include_once 'admin/assets/php/admin-db.php';
?>






<?php
$db = new Database();
$admin = new Admin();
$cuser = new User();
$sql = "UPDATE visitors SET hits = hits+1";
$stmt = $db->conn->prepare($sql);
$stmt->execute();


?>

<?php
$title = basename($_SERVER['PHP_SELF'], '.php');
$title = explode('-', $title);
$title = ucfirst($title[0]);
if ($title == 'Index') {
	$title = 'Wedding Photography & Videography in Sri Lanka';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="wpOceans">
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<title> Ideagraphy Studio | <?= $title ?></title>
	<link href="assets/css/themify-icons.css" rel="stylesheet">
	<link href="assets/css/flaticon.css" rel="stylesheet">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/animate.css" rel="stylesheet">
	<link href="assets/css/owl.carousel.css" rel="stylesheet">
	<link href="assets/css/owl.theme.css" rel="stylesheet">
	<link href="assets/css/slick.css" rel="stylesheet">
	<link href="assets/css/slick-theme.css" rel="stylesheet">
	<link href="assets/css/swiper.min.css" rel="stylesheet">
	<link href="assets/css/nice-select.css" rel="stylesheet">
	<link href="assets/css/owl.transitions.css" rel="stylesheet">
	<link href="assets/css/jquery.fancybox.css" rel="stylesheet">
	<link href="assets/css/odometer-theme-default.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
	<style>
		.fa-youtube {
			color: #FF0000;
			font-size: 1.5rem;
		}

		.fa-facebook {
			color: #4267B2;
			font-size: 1.5rem;
		}

		.fa-instagram {
			color: #8a3ab9;
			font-size: 1.5rem;
		}

		.fa-whatsapp {
			color: #25d366;
			font-size: 1.5rem;
		}

		.user-img {
			display: inline-block;
			top: -0.5rem;
			margin-bottom: 0 !important;
			margin-right: 3px;
			position: relative;
		}

		.user-text {
			align-content: bas;
		}
	</style>
</head>

<body>



	<!-- start page-wrapper -->
	<div class="page-wrapper">

		<!-- start preloader -->
		<div class="preloader">
			<div class="vertical-centered-box">
				<div class="content">
					<div class="loader-circle"></div>
					<div class="loader-line-mask">
						<div class="loader-line"></div>
					</div>
					<img src="assets/images/favicon.png" alt="" width="20%" style="margin-left: 41%;">
				</div>
			</div>
		</div>
		<!-- end preloader -->
		<!-- start-header-topbar -->
		<section class="topbar">
			<h2 class="hidden">some</h2>
			<div class="container-fluid">
				<div class="row">
					<div class="col col-lg-7 col-md-12 col-12">
						<div class="contact-intro">
							<ul>
								<li><i class="fi flaticon-email"></i><em>ideagraphy@outlook.com</em></li>
								<li><i class="fi flaticon-phone-call"></i>+9476 6866 978</li>
								<li><i class="fi flaticon-maps-and-flags"></i> 311A/1/1 Madiwela Rd, Kotte</li>
							</ul>
						</div>
					</div>
					<div class="col col-lg-5 col-md-12 col-12">
						<div class="contact-info">
							<ul>
								<?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
									$cemail = $_SESSION['user'];
									$data = $cuser->user_exist($cemail);
									$cname = $data['name'];
									$fname = strtok($cname, " ");
									$cphoto = $data['photo'];
								?>
									<div>

										<li><a href="assets/php/logout.php" title="Sign Out"><strong>Sign Out</strong></a></li>
										<li><strong>|</strong></li>
										<li><a href="home.php" title="Create an Account"><strong class="">My Profile</strong></li>
										<li>
											<span class="user-img mt-0">
												<!-- <img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt="Ryan Taylor"> -->
												<?php if (!$cphoto) : ?>
													<img class="rounded-circle" alt="User Image" width="40" src="assets/img/profiles/avatar.png" id="uploaded_image">
												<?php else : ?>
													<img class="rounded-circle" alt="User Image" width="40" src="<?= 'assets/php/' . $cphoto; ?>">
												<?php endif; ?>
											</span></a>
										</li>
									</div>
								<?php } else { ?>
									<div>
										<li><a href="register.php" title="Create an Account"><strong>Create an Account</strong></a></li>
										<li><strong>|</strong></li>
										<li><a href="login.php" title="Sign In"><strong>Sign In</strong></a></li>
									</div>
								<?php } ?>

							</ul>
						</div>
						<div class="contact-info">
							<ul>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- end-header-topbar -->










		<!-- start wpo-box-style -->
		<div class="wpo-box-style">

			<!-- Start header -->
			<header id="header">
				<div class="wpo-site-header">
					<nav class="navigation navbar navbar-expand-lg navbar-light">
						<div class="container-fluid">
							<div class="row align-items-center">
								<div class="col-lg-3 col-md-3 col-3 d-lg-none dl-block">
									<div class="mobail-menu">
										<button type="button" class="navbar-toggler open-btn">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar first-angle"></span>
											<span class="icon-bar middle-angle"></span>
											<span class="icon-bar last-angle"></span>
										</button>
									</div>
								</div>
								<div class="col-lg-2 col-md-6 col-6">
									<div class="navbar-header">
										<a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" alt=""></a>
									</div>
								</div>
								<div class="col-lg-8 col-md-1 col-1">
									<div id="navbar" class="collapse navbar-collapse navigation-holder">
										<button class="menu-close"><i class="ti-close"></i></button>

										<ul class="nav navbar-nav mb-2 mb-lg-0">
											<li class="<?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? "active" : ""; ?>">
												<a href="index.php">Home</span></a>
											</li>
											<li class="<?= (basename($_SERVER['PHP_SELF']) == 'contact.php') ? "active" : ""; ?>">
												<a href="contact.php">Contact</span></a>
											</li>
											<li class="<?= (basename($_SERVER['PHP_SELF']) == 'about-us.php') ? "active" : ""; ?>">
												<a href="about-us.php">About Us</span></a>
											</li>
											 <li class="<?= (basename($_SERVER['PHP_SELF']) == 'events.php') ? "active" : ""; ?> menu-item-has-children">
												<a href="events.php">Events</span></a>
												<ul class="sub-menu container">

													<?php
													$data = $admin->fetchAllCat();

													foreach ($data as $row) {
														$cat_id = $row['id'];
														$cat_name = $row['name'];
														$output = '<li class="menu-item-has-children"><a href="events.php?=' . $row['name'] . '">' . $row['name'] . '</a>

														<ul class="sub-menu ">';
														$data2 = $admin->fetchAllTypesByCat($row['name']);
														foreach ($data2 as $row2) {

															$output .= '<li><a href="events.php?=' . $row2['name'] . '">' . $row2['name'] . '</a></li>';
														}
														$output .= '</ul></li>';
														echo $output;
													} ?>

												</ul> 
											</li>
											<li class="<?= (basename($_SERVER['PHP_SELF']) == 'packages.php') ? "active" : ""; ?>">
												<a href="packages.php">Packages</span></a>
											</li>

										</ul>

									</div><!-- end of nav-collapse -->
								</div>
								<div class="col-lg-2 col-md-2 col-2">
									<div class="header-right">
										<div class="header-search-form-wrapper">
											<div class="cart-search-contact">
												<button class="search-toggle-btn"><i class="fi flaticon-search"></i></button>
												<div class="header-search-form">
													<form>
														<div>
															<input type="text" class="form-control" placeholder="Search here...">
															<button type="submit"><i class="fi flaticon-search"></i></button>
														</div>
													</form>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div><!-- end of container -->
					</nav>
				</div>
			</header>
			<!-- end of header -->