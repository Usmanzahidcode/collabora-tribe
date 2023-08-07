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
			include("../includes/header.php");
		?>

		<div class = "container-md">
			<div class = "row">
				<div class = "col-4 rounded text-bg-success mx-auto p-3">
					<?php
						if ($did_signup === true) {
							include "../includes/templates/signup-success-template.html";
						} else {
							include "../includes/templates/did-not-signup-template.html";
						}
					?>
				</div>
			</div>
		</div>


		<?php
			include("../includes/footer.html");
		?>
	</body>
</html>