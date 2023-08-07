<?php
	session_start();
	if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
		$_SESSION = array();
		session_destroy();
		setcookie('user_token', '', time() - 3600, '/', '');

		session_start();
		$_SESSION['signout_success'] = true;
		header('location: signout-success.php');
	} else {
		session_start();
		$_SESSION['signout_success'] = false;
		header('location: signout-success.php');
	}
?>