<?php
	include "../includes/connection.php";
	include "../includes/functions.php";
	
	session_start();

	if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true){
		header('location: projectcatalog.php');
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$email_full = $email . '@gmail.com';
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

		if (!empty($email) && !empty($password)) {

			$query = "SELECT * FROM users WHERE email = ?";
			$stmt = $conn->prepare($query);
			$stmt->bind_param('s', $email_full);

			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();

			if ($result->num_rows === 1) {

				$row = $result->fetch_assoc();
				$hashed_password = $row['password'];
				$name = $row['name'];

				if (password_verify($password, $hashed_password)) {

					if (isset($_POST['remember'])) {
						//set cookies here and start session
						$token = generateToken();

						$cookie_name = "user_token";
						$cookie_value = $token;
						$cookie_expiry = time() + (86400 * 30); // (86400 seconds per day)

						setcookie($cookie_name, $cookie_value, $cookie_expiry, '/', '');

						// store in database
						$update_token_sql = "UPDATE users SET token = '$cookie_value' WHERE email = '$email_full'";
						$conn->query($update_token_sql);

						$conn->close();

						session_start();
						$_SESSION['is_logged_in'] = true;
						$_SESSION['name'] = $name;
						$_SESSION['email'] = $email_full;

						// Redirect
						header('location: projectcatalog.php');

					} else {
						//start session here
						session_start();
						$_SESSION['is_logged_in'] = true;
						$_SESSION['name'] = $name;
						$_SESSION['email'] = $email_full;

						header('location: projectcatalog.php');
					}
				} else {
					// wrong password
					$sign_in_done = false;
				}


			} else {
				// User not found or incorrect credentials
				$sign_in_done = false;
			}

		}
	}
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1"/>
		<title>Sign In! | CollaboraTribe</title>
		<link rel = "shortcut icon" href = "../assets/favicon.png" type = "image/png">
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
			include("../includes/header.php");
		?>

		<div class = "container py-4">
			<div class = "w-100 d-flex justify-content-center align-items-center">
				<img src = "../assets/logo_full_color.png" class = "me-3 pb-3" width = "300px" alt = ""/>
			</div>

			<div class = "row px-0">
				<div class = "col-11 col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto p-4 text-bg-success rounded">
					<?php
						if (isset($sign_in_done)) {
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                             Email or Password wrong!
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
						}
					?>
					<h1 class = "text-center serif">Sign In!</h1>
					<p class = "text-center">
						Sign into your account to start collaborating.
					</p>
					<form action = "signin.php" method = "post">
						<div class = "input-group mb-3">
							<input name = "email" required
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
							<input name = "password" required
							       type = "password"
							       class = "form-control"
							       placeholder = "Password"
							       aria-label = "Password"
							       aria-describedby = "addon-wrapping"/>
						</div>
						<div class = "form-check mb-3">
							<input class = "form-check-input" type = "radio" name = "remember"
							       id = "flexRadioDefault1">
							<label class = "form-check-label" for = "flexRadioDefault1">
								Remember Me!
							</label>
						</div>

						<div class = "w-100 d-flex justify-content-center">
							<input
								class = "btn btn-light w-100"
								type = "submit"
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
