<?php

	$header_username = "Account";

	if (session_status() == PHP_SESSION_ACTIVE) {
		if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
			if (isset($_SESSION['name'])) {
				$header_username = $_SESSION['name'];
			}
		}

	} else {
		if (isset($_COOKIE['user_token'])) {

			$cookie_value = $_COOKIE['user_token'];

			require_once "connection.php";

			$query = "SELECT * FROM users WHERE token = ?";
			$stmt = $conn->prepare($query);
			$stmt->bind_param('s', $cookie_value);

			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			$conn->close();

			if ($result->num_rows >= 1) {
				$row = $result->fetch_assoc();

				session_start();

				$_SESSION['name'] = $row['name'];
				$_SESSION['is_logged_in'] = true;
				$header_username = $_SESSION['name'];
			}
		}
	}


	function isActive($url)
	{
		$currentURL = $_SERVER['PHP_SELF']; // Use $_SERVER['REQUEST_URI'] if URL rewriting is involved.
		if ($currentURL === $url) {
			return 'active';
		} else {
			return '';
		}
	}

?>
<nav
	class = "navbar navbar-expand-md pt-3 pb-3 text-bg-dark"
	data-bs-theme = "dark">
	<div class = "container-sm align-items-center">
		<a class = "navbar-brand" href = "/"
		><img src = "/assets/logo_header.png" width = "150px"
			/></a>

		<button
			class = "navbar-toggler"
			type = "button"
			data-bs-toggle = "offcanvas"
			data-bs-target = "#navbarSupportedContent"
			aria-controls = "navbarSupportedContent"
			aria-expanded = "false"
			aria-label = "Toggle navigation">
			<span class = "navbar-toggler-icon"></span>
		</button>
		<div
			class = "offcanvas offcanvas-end d-flex flex-column
			flex-md-row my-md-0 w-50 align-items-end justify-content-start justify-content-md-between
			px-5 px-md-0 pt-5 pt-md-0 w-auto"
			id = "navbarSupportedContent">
			<ul class = "navbar-nav mb-lg-0 align-items-end mx-auto fs-5 gap-0 gap-lg-5 mb-3 mb-md-0">
				<li class = "nav-item">
					<a class = "nav-link <?php echo isActive('/index.php'); ?>" aria-current = "page"
					   href = "/">Home</a>
				</li>
				<li class = "nav-item">
					<a class = "nav-link <?php echo isActive('/pages/projectcatalog.php'); ?>"
					   href = "/pages/projectcatalog.php">Project Catalog</a>
				</li>

				<li class = "nav-item dropdown">
					<a
						class = "nav-link dropdown-toggle <?php echo isActive('/pages/post-project.php'); ?><?php echo isActive('/pages/signout.php.php'); ?>
						<?php echo isActive('/pages/signup.php'); ?><?php echo isActive('/pages/signin.php'); ?><?php echo isActive('/pages/signup-success.php'); ?>"
						href = "#"
						role = "button"
						data-bs-toggle = "dropdown"
						aria-expanded = "false">
						<?php echo $header_username; ?>
					</a>
					<?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) : ?>
						<ul class = "dropdown-menu fade">
							<li><a class = "dropdown-item" href = "/pages/admin.php">Admin</a></li>
							<li><a class = "dropdown-item" href = "/pages/post-project.php">Post Project</a></li>
							<li><a class = "dropdown-item" href = "/pages/signout.php">Sign Out!</a></li>
							<li>
								<hr class = "dropdown-divider"/>
							</li>
							<li>
								<a class = "dropdown-item" href = "#">View more!</a>
							</li>
						</ul>

					<?php else : ?>
						<ul class = "dropdown-menu">
							<li><a class = "dropdown-item" href = "/pages/signup.php">Sign Up!</a></li>
							<li><a class = "dropdown-item" href = "/pages/signin.php">Sign In!!</a></li>
							<li>
								<hr class = "dropdown-divider"/>
							</li>
							<li>
								<a class = "dropdown-item" href = "#">View more!</a>
							</li>
						</ul>
					<?php endif; ?>
				</li>
			</ul>
			<a
				class = "btn btn-outline-success"
				href = "https://github.com"
				type = "button">
				Contribute to Platform
			</a>
		</div>
	</div>
</nav>