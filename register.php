<?php
session_start();
if (isset($_SESSION['user'])) {
	header("Location:home.php");
}

include_once 'assets/php/config.php';
$db = new Database();


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Ideagraphy Studio</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-4/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-4/font-awesome.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-4/style.css">
	<link rel="stylesheet" href="assets/css/bootstrap-4/jquery.passwordRequirements.css">
	
	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<style>
		.background {
			background-image: url('assets/images/bg/img-10.webp');
			background-position: bottom;
			background-repeat: no-repeat;
			background-size: cover;
			height: 100vh;
			width: 100%;
		}




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
			filter: blur(2px);
			margin: -20px;
		}

		.login-left {
			background-image: url('assets/images/bg/login-3.jpg') !important;
			background-position: center center !important;
			background-repeat: no-repeat;
			background-attachment: fixed;
			height: auto;
			width: 100%;
			background-size: cover ;
		}

		#logo {
			position: relative;
			top: 200px !important;
		}

		.btn-primary {
			background-color: darkturquoise;
			color: white;
		}


		.btn-secondary {
			background-color:#f2f2f2;
			color: black;
		}


	</style>
</head>

<body class="background">

	<!--Login Main Wrapper -->
	<div class="main-wrapper login-body blur" id="login-box">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left">
						<img class="img-fluid" src="assets/img/logo.png" alt="Logo" id="logo">
					</div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1 class="mb-4">Login</h1>

							<!-- Form -->
							<form action="#" method="post" id="login-form">
								<div id="loginAlert"></div>
								<div class="form-group">
									<input class="form-control" type="email" name="email" id="email" placeholder="Email" required value="<?php if (isset($_COOKIE['email'])) {
																																				echo $_COOKIE['email'];
																																			} ?>">
								</div>
								<div class="form-group">
									<input class="form-control" type="password" name="password" id="password" placeholder="Password" required minlength="6" value="<?php if (isset($_COOKIE['password'])) {
																																										echo $_COOKIE['password'];
																																									} ?>">
								</div>
								<div class="form-group">
									<div class="checkbox float-left">
										<label>
											<input type="checkbox" name="rem" <?php if (isset($_COOKIE['email'])) { ?> checked <?php } ?>> Remember Me
										</label>
									</div>
									<div class="float-right forgotpass"><a href="#" id="forgot-link">Forgot Password?</a></div>
								</div>
								<div class="form-group">
									<button class="btn btn-primary btn-block" type="submit" id="login-btn">Login&nbsp;
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="login-spinner"></span></button>
								</div>
							</form>
							<!-- /Form -->

							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>

							<div class="text-center dont-have">Don’t have an account? <a href="#" id="register-link">Register</a></div>
							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>
							<div>
								<a class="btn btn-block btn-secondary" href="index.php">Go Back</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Login Main Wrapper -->

	<!--Register Main Wrapper -->
	<div class="main-wrapper login-body" id="register-box" style="display: none;">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left">
						<img class="img-fluid" src="assets/img/logo.png" alt="Logo" id="logo">
					</div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1 class="mb-4">Register</h1>

							<!-- Form -->
							<form action="#" method="post" id="register-form">
								<div id="regAlert"></div>
								<div class="form-group">
									<input class="form-control" type="text" name="name" id="name" placeholder="Full Name" required>
								</div>
								<div class="form-group">
									<input class="form-control" name="email" id="remail" type="email" placeholder="Email" required>
								</div>
								<div class="form-group">
									<input class="form-control pr-password" type="password" name="password" id="rpassword" placeholder="Password" minlength="6" required>
								</div>
								<div class="form-group">
									<input class="form-control pr-password" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" minlength="6" required>
								</div>
								<div class="form-group">
									<div id="passError" class="text-center text-danger font-weight-bold"></div>
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-primary btn-block" type="submit" id="register-btn">Register&nbsp;
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="register-spinner"></span></button>
								</div>
							</form>
							<!-- /Form -->

							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>

							<div class="text-center dont-have">Already have an account? <a href="login.php" id="login-link">Login</a></div>
							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>
							<div>
								<a class="btn btn-block btn-secondary" href="index.php">Go Back</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Register Main Wrapper -->

	<!--Forgot Main Wrapper -->
	<div class="main-wrapper login-body" id="forgot-box" style="display: none;">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left">
						<img class="img-fluid" src="assets/img/logo.png" alt="Logo" id="logo">
					</div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>Forgot Password?</h1>
							<p class="account-subtitle">Enter your email to get a password reset link</p>

							<!-- Form -->
							<form action="#" method="post" id="forgot-form">
								<div id="forgotAlert"></div>
								<div class="form-group">
									<input class="form-control" type="email" name="email" id="femail" placeholder="Email" required>
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-primary btn-block" type="submit" id="forgot-btn">Reset Passowrd&nbsp;
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="forgot-spinner"></span></button>
								</div>
							</form>
							<!-- /Form -->

							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>

							<div class="text-center dont-have">Go back to <a href="#" id="back-link">Login</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Forgot Main Wrapper -->

	<!-- jQuery -->
	<script src="assets/js/bootstrap-4/jquery-3.2.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/bootstrap-4/popper.min.js"></script>
	<script src="assets/js/bootstrap-4/bootstrap.min.js"></script>

	<!-- Form Validation JS -->
	<script src="assets/js/bootstrap-4/form-validation.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/bootstrap-4/script.js"></script>
	<script src="assets/php/js/index.js"></script>
	<script src="assets/js/bootstrap-4/jquery.passwordRequirements.min.js"></script>
	
	<script>
		$("#login-box").hide();
		$("#register-box").show();
	</script>
	<script>
		$(function() {
			
			$(".pr-password").passwordRequirements();
			
		});
	</script>
</body>

</html>