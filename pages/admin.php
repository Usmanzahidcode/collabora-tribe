<?php
	require_once "../includes/connection.php";
	require_once "../includes/functions.php";

	session_start();

	if (!isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] !== true) {
		if (!isset($_COOKIE['user_token'])) {
			header('location: signin.php');
		} else {
			$_SESSION['is_logged_in'] = true;
		}
	}


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$title = $_POST['title'];
		$author = $_SESSION['name'];
		$excerpt = $_POST['excerpt'];
		$description = $_POST['description'];
		$sanitized_description = sanitizeCkInput($description);
		$category = $_POST['category'];

		if (!empty($description)) {
			$query = "INSERT INTO projects (title, author, excerpt, description, category) values (?, ?, ?, ?, ?)";
			$stmt = $conn->prepare($query);
			$stmt->bind_param('sssss', $title, $author, $excerpt, $sanitized_description, $category);

			$stmt->execute();
			$stmt->close();
			$conn->close();
		} else {
			$desc_is_empty = true;
		}
	}
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1"/>
		<title>Submit new project | CollaboraTribe</title>
		<link rel = "shortcut icon" href = "../assets/favicon.png" type = "image/png">
		<link
			href = "../includes/bootstrap/css/bootstrap.min.css"
			rel = "stylesheet"/>
		<link rel = "stylesheet" href = "../includes/stylesheet/app.css"/>

		<link
			rel = "stylesheet"
			href = "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>

	</head>

	<body>

		<?php
			include("../includes/header.php");
		?>

		<div class = "container-fluid py-5 bg-light-subtle">
			<div class = "container-sm">
				<div class = "col-12 col-md-10 mx-auto">
					<h1 class = "serif mb-4">Account settings</h1>
					<div class = "d-flex flex-row gap-3 align-items-start">
						<div class = "nav nav-tabs d-flex flex-column gap-2 border-bottom-0 w-auto" id = "nav-tab"
						     role = "tablist">
							<button
								class = " btn btn-outline-success active border-2 fs-5 py-2 px-5 rounded-1"
								id = "nav-home-tab"
								data-bs-toggle = "tab"
								data-bs-target = "#nav-profile-info"
								type = "button"
								role = "tab"
								aria-controls = "nav-profile"
								aria-selected = "true">
								Profile Info
							</button>
							<button
								class = "btn btn-outline-success  border-2 fs-5 py-2 px-5 rounded-1"
								id = "nav-profile-tab"
								data-bs-toggle = "tab"
								data-bs-target = "#nav-stats"
								type = "button"
								role = "tab"
								aria-controls = "nav-stats"
								aria-selected = "false">
								Profile
							</button>
							<button
								class = " btn btn-outline-success  border-2 fs-5 py-2 px-5 rounded-1"
								id = "nav-Info-tab"
								data-bs-toggle = "tab"
								data-bs-target = "#nav-unknown"
								type = "button"
								role = "tab"
								aria-controls = "nav-i"
								aria-selected = "false">
								Info
							</button>
						</div>
						<div class = "tab-content w-75 ps-2" id = "nav-tabContent">
							<div
								class = "tab-pane fade show active"
								id = "nav-profile-info"
								role = "tabpanel"
								aria-labelledby = "nav-tab-home">
								<h1>Muhammad Usman Zahid</h1>
								<p class = "fst-italic">Created on: <span>12 july 2043</span><span
										class = "badge text-bg-warning ms-3" data-bs-toggle = "popover"
										data-bs-placement = "top" data-bs-trigger = "focus" tabindex = "0"
										data-bs-title = "Collaboration points" data-bs-custom-class = "custom-popover"
										data-bs-content = "This shows you activity on CollaboraTribe.
										The more acctive you are on the platform, the more points you have!">CP: 10</span>
								</p>
								<p class = " fs-5">
									Diving into the world of Node.js 🚀 Crafting seamless web
									experiences with
									JavaScript. Real-time aficionado, code conductor, and digital
									sorcerer. Let's bring
									ideas to life, one line at a time! #NodeJS #WebDeveloper
								</p>
								<div class = "row ">
									<div class = "col">
										<div class = "card text-center">
											<div class = "card-header text-bg-success">
												Projects Posted!
											</div>
											<div class = "card-body">
												<h1>05</h1>
											</div>
										</div>
									</div>
									<div class = "col">
										<div class = "card text-center">
											<div class = "card-header text-bg-success">
												Applied on!
											</div>
											<div class = "card-body">
												<h1>05</h1>
											</div>
										</div>
									</div>
									<div class = "col">
										<div class = "card text-center">
											<div class = "card-header text-bg-success">
												Completed project
											</div>
											<div class = "card-body">
												<h1>05</h1>

											</div>
										</div>
									</div>

								</div>
							</div>
							<div
								class = "tab-pane fade show"
								id = "nav-stats"
								role = "tabpanel"
								aria-labelledby = "nav-tab-stats">
								<h1>profile</h1>
								<p>
									Lorem ipsum dolor sit amet consectetur adipisicing elit.
									Voluptatem blanditiis animi neque fugit unde cupiditate? Nisi,
									natus magnam. Soluta molestiae corrupti quis et dolorem vel
									perferendis fugit expedita, assumenda veritatis?
								</p>
							</div>
							<div
								class = "tab-pane fade show"
								id = "nav-unknown"
								role = "tabpanel"
								aria-labelledby = "nav-tab-">
								<h1>info</h1>
								<p>
									Lorem ipsum dolor sit amet consectetur adipisicing elit.
									Voluptatem blanditiis animi neque fugit unde cupiditate? Nisi,
									natus magnam. Soluta molestiae corrupti quis et dolorem vel
									perferendis fugit expedita, assumenda veritatis?
								</p>
							</div>
						</div>
					</div>


				</div>

			</div>
		</div>

		<?php
			include("../includes/footer.html");
		?>
		<!-- bootstrap js -->
		<script
			src = "../includes/bootstrap/js/bootstrap.bundle.js"></script>
		<script>
			const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
			const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
		</script>
		<style>
			.popover-arrow {
				display: none !important;
			}

			.popover {
				/*border-color: #279863;*/
			}

			.popover-header {
				color: white !important;
				background-color: #279863 !important;
			}

			.popover-body {
			}
		</style>

	</body>
</html>

