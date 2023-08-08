<?php
	session_start();
	require_once "../includes/connection.php";

	$query = "SELECT * FROM projects ORDER BY id DESC LIMIT 10";
	$stmt = $conn->prepare($query);
	$stmt->execute();

	$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1"/>
		<title>Project catalog | CollaboraTribe</title>
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
			<div class = "container-sm mt-2">
				<h1 class = "serif display-5 mb-5">Latest Projects</h1>
				<div class = "col-md-12">

					<div
						class = "row g-0 gap-4 border rounded overflow-hidden flex-md-row-reverse mb-4 shadow-sm h-md-250 position-relative">
						<div class = "col p-4 d-flex flex-column position-static gap-2 align-items-start">
							<strong class = "d-inline-block mb-0 text-success fs-6"
							>Web Devlopment</strong
							>
							<h3 class = "mb-0 fs-1 serif fw-bold">A web app using nodejs for a university to manage
							                                      assignments</h3>
							<p class = "fs-5 mb-2">
								Collaborating on projects with like-minded individuals has never
								been easier. At Collaboratribe, we believe in simplicity and
								effectiveness. Here are the 6 simple steps that will guide you
								towards great collaboration:
							</p>
							<a href = "#" class = "stretched-link text-decoration-none fw-medium btn btn-success">Apply
							                                                                                      Now</a>
						</div>
					</div>

					<?php foreach ($result as $row): ?>
						<div
							class = "row g-0 gap-4 border rounded overflow-hidden flex-md-row-reverse mb-4 shadow-sm h-md-250 position-relative">
							<div class = "col p-4 d-flex flex-column position-static gap-2 align-items-start">
								<strong class = "d-inline-block mb-0 text-success fs-6"><?php echo $row['category']?></strong>
								<h3 class = "mb-0 fs-1 serif fw-bold"><?php echo $row['title']?></h3>
								<p class = "fs-5 mb-2">
									<?php echo $row['excerpt']?>
								</p>
								<a href = "project.php?id='<?php echo $row['id']?>"
								   class = "stretched-link text-decoration-none fw-medium btn btn-success">Apply
								                                                                           Now</a>
							</div>
						</div>
					<?php endforeach; ?>
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
