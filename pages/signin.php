<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1"/>
		<title>Sign In! | CollaboraTribe</title>
		<link
			href = "../includes/bootstrap/css/bootstrap.min.css"
			rel = "stylesheet"/>
		<link rel = "stylesheet" href = "../includes/stylesheet/app.css"/>

		<link
			rel = "stylesheet"
			href = "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
	</head>
	<body class = "d-flex flex-column vh-100 justify-content-between">

		<?php
			include("../includes/header.html");
		?>

		<div class = "container py-4">
			<div class = "w-100 d-flex justify-content-center align-items-center">
				<img src = "../assets/logo_full_color.png" class = "me-3 pb-3" width = "300px" alt = ""/>
			</div>

			<div class = "row px-0">
				<div class = "col-11 col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto p-4 text-bg-success rounded">
					<h1 class = "text-center serif">Sign Up!</h1>
					<p class = "text-center">
						Create your account and embrace the collaboration journey
					</p>
					<form action = "">
						<div class = "input-group mb-3">
							<input
								type = "text"
								class = "form-control"
								placeholder = "User's email"
								aria-label = "User's email"
								aria-describedby = "basic-addon2"/>
							<span class = "input-group-text" id = "basic-addon2">@gmail.com</span>
						</div>
						<div class = "input-group flex-nowrap mb-3">
							<span class = "input-group-text" id = "addon-wrapping"><i
								class = "bi bi-shield-lock-fill"></i></span>
							<input
								type = "password"
								class = "form-control"
								placeholder = "Password"
								aria-label = "Password"
								aria-describedby = "addon-wrapping"/>
						</div>

						<div class = "w-100 d-flex justify-content-center">
							<input
								class = "btn btn-light w-100"
								type = "button"
								name = "submit"
								value = "Submit"
								id = "submit"/>
						</div>
					</form>
				</div>
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
