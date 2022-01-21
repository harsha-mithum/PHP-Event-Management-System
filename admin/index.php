<?php
session_start();
if (isset($_SESSION['username'])) {
	header("Location:admin-dashboard.php");
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Ideagraphy Studio | Admin Login</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="assets/css/feathericon.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<style type="text/css">
		html,
		body {
			height: 100%;
		}

		.card-body {
			border-radius: 5px;
		}

		.background {
			background-image: url('../assets/images/bg/img-2.jpg');
			background-position: bottom;
			background-repeat: no-repeat;
			background-size: cover;
			height: 100vh;
			width: 100%;
		}

		.bg-dark {
			background-color: black !important;
			color: darkgrey;
		}

		.blur {
			box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);
			border-radius: 25px;
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
			filter: blur(100px);
			margin: -20px;
		}
		input {
			background-color: cornsilk !important;
		}
	</style>

</head>

<body class="background">

	<div class="container h-100 ">
		<div class="row h-100 align-items-center justify-content-center">
			<div class="col-lg-5">
				<div class="card shadow-lg blur">
					<div class="card-header bg-dark">
						<h3 class="m-0 text-center">Admin Login</h3>
					</div>
					<div class="card-body">
						<div id="adminLoginAlert"></div>
						<form action="#" method="post" class="px-3" id="admin-login-form">
							<div class="form-group">
								<input type="text" name="username" placeholder="Username" class="form-control rounded-0" required autofocus>
							</div>
							<div class="form-group">
								<input type="password" name="password" placeholder="Password" class="form-control rounded-0" required>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-block rounded-pill btn-info" name="admin-login" id="adminLoginBtn">Login&nbsp;
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="admin-login-spinner"></span></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>
	<script src="assets/php/js/index.js"></script>

</body>

</html>