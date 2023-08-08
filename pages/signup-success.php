<?php
	session_start();

	if (isset($_SESSION['signup_success'])) {
		$did_signup = true;
	} else {
		$did_signup = false;
	}
?>
	<!doctype html>
	<html lang = "en">
		<head>
			<meta charset = "UTF-8">
			<meta name = "viewport"
			      content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
			<meta http-equiv = "X-UA-Compatible" content = "ie=edge">
			<link rel = "shortcut icon" href = "../assets/favicon.png" type = "image/png">

			<link
				href = "../includes/bootstrap/css/bootstrap.css"
				rel = "stylesheet"/>
			<link rel = "stylesheet" href = "../includes/stylesheet/app.css"/>

			<link
				rel = "stylesheet"
				href = "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>

			<title>Successful Sign Up</title>
		</head>
		<body class = "vh-100 d-flex flex-column justify-content-between">
			<?php
				require_once "../includes/header.php";
			?>

			<div class = "container-md">
				<div class = "row">
					<!--<div class = "col-4 rounded text-bg-success mx-auto p-3">-->
					<?php

						if ($did_signup === true) {
							echo '<div class = "col-4 rounded text-bg-success mx-auto p-3">	
								<h1 class = "serif">You have successfully created an account</h1>
								<p>
									Start by signing into that account and apply or post on different projects.
								</p>
								<a href = "signin.php" class = "btn btn-outline-warning w-100">Sign In</a>
							</div>';
						} else {
							echo '<div class = "col-4 rounded text-bg-warning mx-auto p-3">
								<h1 class = "serif">You have not created an account yet!</h1>
								<p>
									You might have reached here by mistake.Start by signing up on CollaboraTribe. Or if you have an account then
									sign into your account.
								</p>
								<a href = "signup.php" class = "btn btn-success w-100">Sign Up</a>
							</div>';

						}
					?>
					<!--</div>-->
				</div>
			</div>


			<?php
				include("../includes/footer.html");
			?>

			<!-- bootstrap js -->
			<script
				src = "../includes/bootstrap/js/bootstrap.bundle.js"
			></script>
		</body>
	</html>
<?php unset($_SESSION['signup_success']); ?>