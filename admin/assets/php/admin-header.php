<?php
require_once 'admin-db.php';

session_start();
if (!isset($_SESSION['username'])) {
	header("Location:index.php");
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<?php
	$title = basename($_SERVER['PHP_SELF'], '.php');
	$title = explode('-', $title);
	$title = ucfirst($title[1]);
	?>

	<title>Ideagraphy Studio - <?= $title; ?></title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="assets/css/feathericon.min.css">

	<!-- Datatables CSS -->
	<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- FontAwesome CSS -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css" />

	<!-- LightBox CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">

	<!-- <link rel="stylesheet" href="assets/plugins/fullcalendar-schedular/main.min.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

	<!-- TimePicker CSS -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

	<link rel="stylesheet" href="assets/plugins/dropzone/dropzone.css">
	<link rel="stylesheet" href="assets/plugins/bootstrap4-toggle-3.6.1/bootstrap4-toggle.min.css">
	<!-- <link rel="stylesheet" href="assets/css/validation.css"> -->
	<link rel="stylesheet" href="assets/css/jquery.passwordRequirements.css">
	<style>



		.blur {
			box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);
			border-radius: 5px;
			position: relative;
			z-index: 1;
			background: inherit;
			overflow: hidden;
		}

		.blur:before {
			content: "";
			position: absolute;
			background: inherit;
			z-index: -1;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			box-shadow: inset 0 0 2000px rgba(255, 255, 255, .5);
			filter: blur(20px);
			margin: -20px;
		}


	</style>
</head>

<body class="">

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header">

			<!-- Logo -->
			<div class="header-left">
				<a href="admin-dashboard.php" class="logo">
					<img src="assets/img/logo-1.png" alt="Logo" class="p-2">
				</a>
				<a href="admin-dashboard.php" class="logo logo-small">
					<img src="assets/img/logo-small.png" alt="Logo" width="30" height="30">
				</a>
			</div>
			<!-- /Logo -->

			<a href="javascript:void(0);" id="toggle_btn">
				<i class="fe fe-text-align-left"></i>
			</a>

			<!-- Mobile Menu Toggle -->
			<a class="mobile_btn" id="mobile_btn">
				<i class="fa fa-bars"></i>
			</a>
			<!-- /Mobile Menu Toggle -->

			<!-- Header Right Menu -->
			<ul class="nav user-menu">

				<!-- User Menu -->
				<li class="nav-item dropdown has-arrow">

					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar.png" width="31" alt="admin"></span>
					</a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm">
								<img src="assets/img/profiles/avatar.png" alt="User Image" class="avatar-img rounded-circle">
							</div>
							<div class="user-text">
								<h6>Hey, <?= $_SESSION['username']; ?></h6>
								<p class="text-muted mb-0">Administrator</p>
							</div>

						</div>
						<div class="dropdown-item pl-4">
							<a href="admin-profile.php">
								<h6><i class="fas fa-user-tie"></i>&nbsp;&nbsp;&nbsp;View Profile</h6>
							</a>
						</div>
						<div class="dropdown-item pl-4">
							<a href="./../index.php">
								<h6><i class="fal fa-browser"></i>&nbsp;&nbsp;&nbsp;Main Site</h6>
							</a>
						</div>
						<div class="dropdown-item pl-4">
							<a href="assets/php/logout.php">
								<h6><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Logout</h6>
							</a>
						</div>

					</div>
				</li>
				<!-- /User Menu -->

			</ul>
			<!-- /Header Right Menu -->

		</div>
		<!-- /Header -->

		<!-- Sidebar -->
		<div class="sidebar bg-blue " id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu " class="sidebar-menu">
					<ul>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php') ? "active" : ""; ?>">
							<a href="admin-dashboard.php"><i class="fe fe-home"></i> <span>Dashboard</span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-users.php') ? "active" : ""; ?>">
							<a href="admin-users.php"><i class="fe fe-users"></i> <span>Users</span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-notes.php') ? "active" : ""; ?>">
							<a href="admin-notes.php"><i class="fe fe-file"></i> <span>Notes</span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-feedback.php') ? "active" : ""; ?>">
							<a href="admin-feedback.php"><i class="fe fe-comment-o"></i> <span>Feedback</span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-notification.php') ? "active" : ""; ?>">
							<a href="admin-notification.php"><i class="fe fe-bell"></i> <span>Notification</span> <span id="checkNotification"></span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-event.php') ? "active" : ""; ?>">
							<a href="admin-event.php"><i class="fe fe-user-minus"></i> <span>Events</span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-calendar.php') ? "active" : ""; ?>">
							<a href="admin-calendar.php"><i class="fe fe-user-minus"></i> <span>Calendar</span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-event-types.php') ? "active" : ""; ?>">
							<a href="admin-event-types.php"><i class="fe fe-user-minus"></i> <span>Event Types</span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-package.php') ? "active" : ""; ?>">
							<a href="admin-package.php"><i class="fad fa-stream"></i> <span>Packages</span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-posts.php') ? "active" : ""; ?>">
							<a href="admin-posts.php"><i class="fad fa-stream"></i> <span>Posts</span></a>
						</li>
						<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-export.php') ? "active" : ""; ?>">
							<a href="admin-export.php"><i class="fal fa-table"></i><span>Export</span></a>
						</li>

					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->