<?php
	require_once "../includes/connection.php";
	require_once "../includes/functions.php";

	session_start();

	if (!isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] !== true){
		if (!isset($_COOKIE['user_token'])) {
			header('location: signin.php');
		}
		else{
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
					<h1 class="serif mb-4">Account settings</h1>

						<nav class="d-flex flex-row gap-3">
							<div class="nav nav-tabs d-flex flex-column gap-2 border-bottom-0" id="nav-tab" role="tablist">
								<button
									class=" btn btn-success active border-0 fs-5 py-2 px-5 rounded-1"
									id="nav-home-tab"
									data-bs-toggle="tab"
									data-bs-target="#nav-home"
									type="button"
									role="tab"
									aria-controls="nav-home"
									aria-selected="true">
									Home
								</button>
								<button
									class="btn btn-success  border-0 fs-5 py-2 px-5 rounded-1"
									id="nav-profile-tab"
									data-bs-toggle="tab"
									data-bs-target="#nav-profile"
									type="button"
									role="tab"
									aria-controls="nav-profile"
									aria-selected="false">
									Profile
								</button>
								<button
									class=" btn btn-success  border-0 fs-5 py-2 px-5 rounded-1"
									id="nav-Info-tab"
									data-bs-toggle="tab"
									data-bs-target="#nav-info"
									type="button"
									role="tab"
									aria-controls="nav-info"
									aria-selected="false">
									Info
								</button>
							</div>
							<div class="tab-content" id="nav-tabContent">
								<div
									class="tab-pane fade show active p-3"
									id="nav-home"
									role="tabpanel"
									aria-labelledby="nav-tab-home">
									<h1>Home</h1>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Voluptatem blanditiis animi neque fugit unde cupiditate? Nisi,
										natus magnam. Soluta molestiae corrupti quis et dolorem vel
										perferendis fugit expedita, assumenda veritatis?
									</p>
								</div>
								<div
									class="tab-pane fade show p-3"
									id="nav-profile"
									role="tabpanel"
									aria-labelledby="nav-tab-profile">
									<h1>profile</h1>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Voluptatem blanditiis animi neque fugit unde cupiditate? Nisi,
										natus magnam. Soluta molestiae corrupti quis et dolorem vel
										perferendis fugit expedita, assumenda veritatis?
									</p>
								</div>
								<div
									class="tab-pane fade show p-3"
									id="nav-info"
									role="tabpanel"
									aria-labelledby="nav-tab-info">
									<h1>info</h1>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Voluptatem blanditiis animi neque fugit unde cupiditate? Nisi,
										natus magnam. Soluta molestiae corrupti quis et dolorem vel
										perferendis fugit expedita, assumenda veritatis?
									</p>
								</div>
							</div>
						</nav>


				</div>

			</div>
		</div>

		<?php
			include("../includes/footer.html");
		?>
		<!-- bootstrap js -->
		<script
			src = "../includes/bootstrap/js/bootstrap.bundle.js"></script>

	</body>
</html>

