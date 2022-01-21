<?php

    require_once 'assets/php/auth.php';

    $user = new Auth();
    $msg = '';

    if (isset($_GET['email']) && isset($_GET['token'])) {
        $email = $user->test_input($_GET['email']);
        $token = $user->test_input($_GET['token']);

        $auth_user = $user->reset_pass_auth($email, $token);

        if($auth_user != null){
            if (isset($_POST['submit'])) {
                $newpass = $_POST['pass'];
                $cnewpass = $_POST['cpass'];

                $hnewpass = password_hash($newpass, PASSWORD_DEFAULT);

                if ($newpass == $cnewpass) {
                    $user->update_new_pass($hnewpass, $email);
                    $msg = $user->showMessage('success', 'Password Changed Successfully.');
                } else {
                    $msg = $user->showMessage('danger', 'Both password are did not matched.');
                }
            }
        } else {
            header('location:index.php');
            exit();
        }
    } else {
        header('location:index.php');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Ventura - Reset Password</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							<img class="img-fluid" src="assets/img/logo.png" alt="Logo">
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1>Reset Password</h1>
								<p class="account-subtitle"></p>
								
								<!-- Form -->
								<form action="#" method="post">
									<div class="text-center"><?php echo $msg; ?></div>
									<div class="form-group">
										<input class="form-control" name="pass" type="password" placeholder="New Password" required minlength="6">
									</div>
									<div class="form-group">
										<input class="form-control" name="cpass" type="password" placeholder="Confirm New Password" required minlength="6">
									</div>
									<div class="form-group">
										<input class="btn btn-primary btn-block" type="submit" name="submit" value="Reset Password">
									</div>
								</form>
								<!-- /Form -->
								<div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div>
								<div class="text-center dont-have">Go Back to <a href="index.php">Login</a></div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
    </body>
</html>