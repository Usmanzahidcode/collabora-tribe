<?php
	session_start();

	require_once "../includes/connection.php";

	$id = $_GET['id'];

	$query = "SELECT * FROM projects WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $id);
	$stmt->execute();


	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

	$stmt->close();
	$conn->close();
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1"/>
		<title><?php echo $row['title']; ?></title>
		<link rel = "shortcut icon" href = "../assets/favicon.png" type = "image/png">
		<link
			href = "../includes/bootstrap/css/bootstrap.css"
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

		<div class = "container-md my-3">
			<div class = " border rounded p-4">
				<p class = "badge text-bg-success m-0"><?php echo $row['category']; ?></p>
				<h1 class = "serif display-6 fw-bold my-3"><?php echo $row['title']; ?></h1>
				<p class = "m-0"><strong>Author: </strong><span class = "fst-italic"><?php echo $row['author']; ?></span></p>
				<p class = "fst-italic mt-0">Posted on: <?php echo $row['date']; ?></p>
				<div class = "desc">
					<?php echo $row['description']; ?>
				</div>


			</div>
			<h2 class = "mt-3">Recent comments</h2>
			<div class = "row">
				<div class = "col-12">
					<div class = "border rounded p-4">
						<form action = "">
							<div class = "input-group">
								<span class = "input-group-text">Your comment</span>
								<textarea class = "form-control" aria-label = "With textarea"
								          placeholder = "Explain how you can be helpful in this project"
								          rows = "1"></textarea>
							</div>
							<input type = "submit" value = "Submit" class = "btn btn-success mt-3">
						</form>
					</div>
				</div>
			</div>
			<div class = "row">
				<div class = "col-6 mt-4">
					<div class = "border rounded p-4">

						<p class = "fw-bold fs-5 m-0">Usman Zahid</p>
						<p class = "badge text-bg-success mb-2"><strong>Email: </strong><span><a href =
						                                                                         "mailto:developerusman@yahoo.com"
						                                                                         class = "text-decoration-none fw-medium text-white">Developerusman@yahoo
				                                                                             .com</a></span></p>
						<p class = "fs-5 m-0">Hey, I can work on the security of your project, as your project is
						                      going to be large scale, it needs good security for users. Thanks</p>
					</div>
				</div>
				<div class = "col-6 mt-4">
					<div class = "border rounded p-4">

						<p class = "fw-bold fs-5 m-0">Usman Zahid</p>
						<p class = "badge text-bg-success mb-2"><strong>Email: </strong><span><a href =
						                                                                         "mailto:developerusman@yahoo.com"
						                                                                         class = "text-decoration-none fw-medium text-white">Developerusman@yahoo
				                                                                             .com</a></span></p>
						<p class = "fs-5 m-0">Hey, I can work on the security of your project, as your project is
						                      going to be large scale, it needs good security for users. Thanks</p>
					</div>
				</div>
				<div class = "col-6 mt-4">
					<div class = "border rounded p-4">

						<p class = "fw-bold fs-5 m-0">Usman Zahid</p>
						<p class = "badge text-bg-success mb-2"><strong>Email: </strong><span><a href =
						                                                                         "mailto:developerusman@yahoo.com"
						                                                                         class = "text-decoration-none fw-medium text-white">Developerusman@yahoo
				                                                                             .com</a></span></p>
						<p class = "fs-5 m-0">Hey, I can work on the security of your project, as your project is
						                      going to be large scale, it needs good security for users. Thanks</p>
					</div>
				</div>
			</div>

		</div>


		<?php
			include("../includes/footer.html");
		?>


		<!-- bootstrap js -->
		<script src = "../includes/bootstrap/js/bootstrap.bundle.js"></script>

	</body>
</html>
