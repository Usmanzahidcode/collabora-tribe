<?php
	session_start();
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

			<title>Sign Out | CollaboraTribe</title>
		</head>
		<body class = "vh-100 d-flex flex-column justify-content-between">
			<?php
				include("../includes/header.php");
			?>
			<div class = "container-md">
				<div class = "row">
					<?php if (isset($_SESSION['signout_success']) && ($_SESSION['signout_success'] === true)) : ?>
						<div class = "col-4 rounded text-bg-success mx-auto p-3">
							<h1 class = "serif">You have successfully logged out of your account</h1>
							<p>
								You can sign-in again when you want to resume your collaboration journey.
							</p>
							<a href = "signin.php" class = "btn btn-outline-warning w-100">Sign In</a>
						</div>
					<?php else : ?>
						<div class = "col-4 rounded text-bg-success mx-auto p-3">
							<h1 class = "serif">You cant sign out if you dont have an account!</h1>
							<p>
								Start by creating an account or signing in to an existing account.
							</p>
							<a href = "signin.php" class = "btn btn-outline-warning w-100">Sign In</a>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<?php
				include("../includes/footer.html");
			?>

			<!-- bootstrap js -->
			<script src = "../includes/bootstrap/js/bootstrap.bundle.js"></script>
		</body>
	</html>

<?php unset($_SESSION['signout_success']); ?>