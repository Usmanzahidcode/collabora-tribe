<?php
	require_once "../includes/connection.php";
	session_start();

	$query = "SELECT * FROM users WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('s', $_SESSION['user_id']);

	$stmt->execute();
	$user_results = $stmt->get_result();
	$user_data = $user_results->fetch_assoc();
	$stmt->close();

	// User values:
	$user_name = $user_data['name'];
	$user_date = $user_data['date'];
	$user_email = $user_data['email'];
	$user_bio = $user_data['bio'];


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$project_id = $_POST['project_id'];
		if (isset($_POST['Complete'])) {
			$query = "UPDATE projects SET status = 'complete' WHERE id = ?";
			$stmt = $conn->prepare($query);
			$stmt->bind_param('i', $project_id);

			$stmt->execute();
			$stmt->close();
		} elseif (isset($_POST['Abort'])) {
			$status_value = 'abort';
			$query = "UPDATE projects SET status = '$status_value' WHERE id = ?";
			$stmt = $conn->prepare($query);
			$stmt->bind_param('i', $project_id);

			$stmt->execute();
			$stmt->close();
		}
	}


	// Getting user projects
	$query = "SELECT * FROM projects WHERE author = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('s', $_SESSION['name']);

	$stmt->execute();
	$user_project_results = $stmt->get_result();
	$project_count = mysqli_num_rows($user_project_results);
	$stmt->close();

	// Getting user comments or applies
	$query = "SELECT * FROM comments WHERE userid = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $_SESSION['user_id']);

	$stmt->execute();
	$user_comment_results = $stmt->get_result();
	$comment_count = mysqli_num_rows($user_comment_results);
	$stmt->close();

	// Getting completed projects
	$query = "SELECT * FROM projects WHERE author = ? and status = ?"; // The three status value are: Complete, Active and Aborted
	$stmt = $conn->prepare($query);
	$status = 'complete';
	$stmt->bind_param('ss', $_SESSION['name'], $status);

	$stmt->execute();
	$complete_project_results = $stmt->get_result();
	$complete_project_count = mysqli_num_rows($complete_project_results);
	$stmt->close();


	$conn->close();


?>
<!DOCTYPE html>
<html lang = "en">

	<head>
		<meta charset = "utf-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1"/>
		<title>Account admin | CollaboraTribe</title>
		<link rel = "shortcut icon" href = "../assets/favicon.png" type = "image/png">
		<link href = "../includes/bootstrap/css/bootstrap.min.css" rel = "stylesheet"/>
		<link rel = "stylesheet" href = "../includes/stylesheet/app.css"/>

		<link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>


		<script src = "https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
		        integrity = "sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D"
		        crossorigin = "anonymous"
		        async></script>
	</head>

	<body class = "vh-100 d-flex flex-column justify-content-between">
		<div>
			<?php
				include("../includes/header.php");
			?>

			<div class = "container-fluid py-5 bg-light-subtle">
				<div class = "container-sm">
					<div class = "col-12 col-md-10 mx-auto">
						<h1 class = "serif mb-4">Account settings</h1>
						<div class = "d-flex flex-row gap-3 align-items-start">
							<div class = "nav nav-tabs d-flex flex-column gap-2 border-bottom-0 w-auto tab-cont"
							     id = "nav-tab"
							     role = "tablist">
								<button class = " btn btn-outline-success active border-2 fs-5 py-2 px-5 rounded-1"
								        id = "nav-home-tab"
								        data-bs-toggle = "tab" data-bs-target = "#nav-profile-info" type = "button"
								        role = "tab"
								        aria-controls = "nav-profile" aria-selected = "true">
									<svg xmlns = "http://www.w3.org/2000/svg" fill = "none" viewBox = "0 0 24 24"
									     stroke-width = "1.5"
									     stroke = "currentColor" class = "a-icon">
										<path stroke-linecap = "round" stroke-linejoin = "round"
										      d = "M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
									</svg>

									Profile Info
								</button>
								<button class = " btn btn-outline-success  border-2 fs-5 py-2 px-5 rounded-1"
								        id = "nav-Info-tab"
								        data-bs-toggle = "tab" data-bs-target = "#nav-projects" type = "button"
								        role = "tab" aria-controls = "nav-i"
								        aria-selected = "false">
									<svg xmlns = "http://www.w3.org/2000/svg" fill = "none" viewBox = "0 0 24 24"
									     stroke-width = "1.5"
									     stroke = "currentColor" class = "a-icon">
										<path stroke-linecap = "round" stroke-linejoin = "round"
										      d = "M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
									</svg>

									Your Projects
								</button>
								<button class = "btn btn-outline-success  border-2 fs-5 py-2 px-5 rounded-1"
								        id = "nav-profile-tab"
								        data-bs-toggle = "tab" data-bs-target = "#nav-stats" type = "button"
								        role = "tab" aria-controls = "nav-stats"
								        aria-selected = "false">
									<svg xmlns = "http://www.w3.org/2000/svg" fill = "none" viewBox = "0 0 24 24"
									     stroke-width = "1.5"
									     stroke = "currentColor" class = "a-icon">
										<path stroke-linecap = "round" stroke-linejoin = "round"
										      d = "M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
									</svg>

									Update info
								</button>
								<button class = " btn btn-outline-success  border-2 fs-5 py-2 px-5 rounded-1"
								        id = "nav-Info-tab"
								        data-bs-toggle = "tab" data-bs-target = "#nav-unknown" type = "button"
								        role = "tab" aria-controls = "nav-i"
								        aria-selected = "false">
									<svg xmlns = "http://www.w3.org/2000/svg" fill = "none" viewBox = "0 0 24 24"
									     stroke-width = "1.5"
									     stroke = "currentColor" class = "a-icon">
										<path stroke-linecap = "round" stroke-linejoin = "round"
										      d = "M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
										<path stroke-linecap = "round" stroke-linejoin = "round"
										      d = "M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
									</svg>

									Settings
								</button>


							</div>
							<div class = "tab-content w-75 ps-2" id = "nav-tabContent">
								<div class = "tab-pane fade show active" id = "nav-profile-info" role = "tabpanel"
								     aria-labelledby = "nav-tab-home">
									<h1><?php echo $user_name ?></h1>
									<p class = "fst-italic">Created on: <span><?php echo $user_date ?></span><span
											class = "badge text-bg-warning ms-3"
											data-bs-toggle = "popover" data-bs-placement = "top"
											data-bs-trigger = "focus" tabindex = "0"
											data-bs-title = "Collaboration points"
											data-bs-custom-class = "custom-popover" data-bs-content = "This shows you activity on CollaboraTribe.
										The more acctive you are on the platform, the more points you have!">CP: 10</span>
									</p>
									<p class = " fs-5">
										<?php echo $user_bio ?>
									</p>
									<div class = "row ">
										<div class = "col">
											<div class = "card text-center">
												<div class = "card-header text-bg-success">
													Projects Posted!
												</div>
												<div class = "card-body">
													<h1><?php echo $project_count ?></h1>
												</div>
											</div>
										</div>
										<div class = "col">
											<div class = "card text-center">
												<div class = "card-header text-bg-success">
													Applied on!
												</div>
												<div class = "card-body">
													<h1><?php echo $comment_count ?></h1>
												</div>
											</div>
										</div>
										<div class = "col">
											<div class = "card text-center">
												<div class = "card-header text-bg-success">
													Completed project
												</div>
												<div class = "card-body">
													<h1><?php echo $complete_project_count ?></h1>

												</div>
											</div>
										</div>

									</div>
								</div>
								<div class = "tab-pane fade show" id = "nav-stats" role = "tabpanel"
								     aria-labelledby = "nav-tab-stats">
									<h1>profile</h1>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Voluptatem blanditiis animi neque fugit unde cupiditate? Nisi,
										natus magnam. Soluta molestiae corrupti quis et dolorem vel
										perferendis fugit expedita, assumenda veritatis?
									</p>
								</div>
								<div class = "tab-pane fade show" id = "nav-unknown" role = "tabpanel"
								     aria-labelledby = "nav-tab-">
									<h1>info</h1>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Voluptatem blanditiis animi neque fugit unde cupiditate? Nisi,
										natus magnam. Soluta molestiae corrupti quis et dolorem vel
										perferendis fugit expedita, assumenda veritatis?
									</p>
								</div>
								<div class = "tab-pane fade show" id = "nav-projects" role = "tabpanel"
								     aria-labelledby = "nav-tab-">
									<h1>Your projects so far</h1>
									<p>
										Here are all of your projects.
									<div class = "row d-flex">
										<?php foreach ($user_project_results as $projects): ?>

											<div class = "col-sm-6 mb-3">
												<div class = "card h-100">
													<div class = "card-body">
														<?php if ($projects['status'] == 'complete'): ?>
															<h6 class = "badge text-bg-success">Completed</h6>
														<?php elseif ($projects['status'] == 'abort'): ?>
															<h6 class = "badge text-bg-danger">Aborted</h6>
														<?php elseif ($projects['status'] == 'active'): ?>
															<h6 class = "badge text-bg-primary">Active</h6>
														<?php endif; ?>
														<h5 class = "card-title m-0"><?php echo $projects['title'] ?>
														</h5>
														<div class = "my-2"><a
																href = "../pages/project.php?id= <?php echo $projects['id'] ?>"
																class = "text-decoration-none text-decoration-underline text-dark py-5 fst-italic">Visit
														                                                                                           Project
														                                                                                           >></a>
														</div>

														<form action = "admin.php"
														      method = "post">
															<input type = "hidden" name = "project_id"
															       value = "<?php echo $projects['id'] ?>">
															<input type = "submit" class = "btn btn-success"
															       value = "Complete" name = "Complete">
															<input type = "submit" class = "btn btn-danger"
															       value = "Abort" name = "Abort">
														</form>

													</div>
												</div>
											</div>

										<?php endforeach; ?>
									</div>


								</div>
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
		<script src = "../includes/bootstrap/js/bootstrap.bundle.js"></script>
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