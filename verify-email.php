<?php
	require_once 'assets/php/session.php';

    if (isset($_GET['email']) && isset($_GET['token'])) {
        $email = $cuser->test_input($_GET['email']);
        $token = $cuser->test_input($_GET['token']);

        $auth_user = $cuser->reset_pass_auth($email, $token);

        if ($auth_user != null) {
        	$cuser->verify_email($email);
        	header("Location:profile.php");
        	exit();
        } else {
        	header("Location:index.php");
        	exit();
        }
    } else {
    	header("Location:index.php");
    	exit();
    }
?>