<?php
include_once('assets/php/config2.php');
$album = ($_GET['id']);

$cemail = $_SESSION['user'];



?>
<?php
//require_once 'assets/php/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamguys.co.in/demo/ventura/blank-page.html by HTTrack Website Copier/3.x [XR&CO'2017], Sat, 18 Apr 2020 05:52:31 GMT -->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<?php
	$title = basename($_SERVER['PHP_SELF'], '.php');
	$title = explode('-', $title);
	$title = ucfirst($title[0]); ?>
	<title>Ideagraphy Studio - <?= $title ?></title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-4/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-4/font-awesome.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-4/feathericon.min.css">

	<!-- Datatables CSS -->
	<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-4/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

	<style type="text/css">
		@media only screen and (max-width: 767.98px) {
			.header .header-left .logo {
				padding-right: 100rem !important;
			}

			.header-left .logo.logo-small {
				display: inline-block;
			}
		}

		.img-wrap {
			position: relative;
		}

		.img-wrap .close {
			color: red;
			background-color: white;
			border-radius: 15%;
			font-size: 1.5rem;
			position: absolute;
			top: 1px;
			right: 5px;
			z-index: 100;
		}

		#img {
			position: relative;
			width: auto;
			height: 170px;
		}

		#userImage {
			width: 250px;
			height: 250px;
			position: relative;
			overflow: hidden;
		}



		#modal>img {
			display: block;
			max-width: 100%;
			height: auto;
		}

		.modal-lg {
			max-width: 1000px !important;
			height: 600px;
		}



		.preview {
			overflow: hidden;
			width: 200px;
			height: 200px;
			margin: 10px;
			border: 1px solid red;
		}



		.overlay {
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			background-color: rgba(0, 0, 0, 0.7);
			overflow: hidden;
			height: 0;
			transition: .01s ease;
			width: 100%;
		}



		.image_area:hover .overlay {
			height: 100%;
			cursor: pointer;
		}

		.text {
			color: #FFF;
			font-size: 1.2rem;
			position: absolute;
			top: 50%;
			bottom: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			text-align: center;
		}

		body {
			/*	background-image: url('assets/images/bg/img-10.png');*/
			background-position: bottom;
			background-repeat: repeat;
			background-attachment: fixed;
			background-size: cover;
			height: 100vh;
			width: 100%;
		}
	</style>

	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body class="mini-sidebar bg-dark">

	<!-- Main Wrapper -->
	<div class="main-wrapper blur ">

		<!-- Header -->
		<div class="header">

			<!-- Logo -->
			<div class="header-left">
				<a href="index.php" class="logo logo-small">
					<img src="assets/img/logo-1.png" alt="Logo" width="30" height="30">
				</a>
			</div>
			<!-- /Logo -->

			<!-- Header Right Menu -->
			<ul class="nav user-menu">
				<li class="nav-item">
					<a href="feedback.php" class="nav-link"><i class="fe fe-comment-o" title="Feedback"></i></a>
				</li>

				<!-- Notifications -->
				<li class="nav-item dropdown noti-dropdown">
					<a href="notification.php" class="nav-link" title="Notifications">
						<i class="fe fe-bell"></i> <span id="checkNotification"></span>
					</a>
				</li>
				<!-- /Notifications -->

				<!-- User Menu -->
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
							<!-- <img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt="Ryan Taylor"> -->
							<?php if (!$cphoto) : ?>
								<img class="rounded-circle" alt="User Image" width="31" src="assets/img/profiles/avatar.png" id="uploaded_image">
							<?php else : ?>
								<img class="rounded-circle" alt="User Image" width="31" src="<?= 'assets/php/' . $cphoto; ?>">
							<?php endif; ?>
						</span>
					</a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm">
								<!-- <img src="assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle"> -->
								<?php if (!$cphoto) : ?>
									<img class="rounded-circle" alt="User Image" width="31" src="assets/img/profiles/avatar.png" id="uploaded_image">
								<?php else : ?>
									<img class="rounded-circle" alt="User Image" width="31" src="<?= 'assets/php/' . $cphoto; ?>">
								<?php endif; ?>
							</div>
							<div class="user-text">
								<h6 class="pt-2">Hello, <?= $fname; ?></h6>
							</div>
						</div>
						<a class="dropdown-item" href="profile.php">My Profile</a>
						<a class="dropdown-item" href="assets/php/logout.php">Logout</a>
					</div>
				</li>
				<!-- /User Menu -->

			</ul>
			<!-- /Header Right Menu -->

		</div>
		<!-- /Header -->
		<div class="page-wrapper">
			<div class="container-fluid">
				<div class="gallery row" id="">
					<a href="./home.php" class="btn btn-success m-2">Go Back</a>
					<ul class="nav nav-pills m-5 justify-content-lg-around justify-content-sm-between">
						<?php
						//Fetch all images from database
						$images = $db->getAllImages($album);
						if (!empty($images)) {
							foreach ($images as $row) {
						?>
								<li id="image_li_<?php echo $row['id']; ?>" class="ui-sortable-handle m-1">
									<div class="img-wrap">
										<a href="uploads/albums/<?php echo $row['img_name']; ?>" class="img-link" data-fancybox="true">
											<img src="uploads/albums/<?php echo $row['img_name']; ?>" alt="" class="img-thumbnail " id="img">
										</a>
									</div>
								</li>


						<?php
							}
						} else {
							echo '<h1 class="m-5 text-center">No Image information available.</h1>';
						}
						?>
					</ul>
				</div>
			</div>
		</div>

	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
	<script src="https://unpkg.com/freewall@1.0.8/freewall.js"></script>

</body>

</html>