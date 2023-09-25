<?php
	session_start();
	require_once "../includes/connection.php";

	$comm_is_empty = false;
	$id = $_GET['id'];

	$query = "SELECT * FROM projects WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $id);
	$stmt->execute();


	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

	$stmt->close();



	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$comment = $_POST['comment'];
		$user_id = $_SESSION['user_id'];

		if (!empty($comment)) {
			$query = "INSERT INTO comments (comment, userid, postid) values (?, ?, ?)";
			$stmt = $conn->prepare($query);
			$stmt->bind_param('sii', $comment, $user_id, $id);

			$stmt->execute();
			$stmt->close();
		} else {
			$comm_is_empty = true;
		}

	}

	$query = "SELECT * FROM comments WHERE postid = ? ORDER BY id DESC";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $id);
	$stmt->execute();


	$comment_results = $stmt->get_result();

	$stmt->close();

?>
<!DOCTYPE html>
<html lang = "en">

	<head>
		<meta charset = "utf-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1"/>
		<title>
			<?php echo $row['title']; ?>
		</title>
		<link rel = "shortcut icon" href = "../assets/favicon.png" type = "image/png">
		<link href = "../includes/bootstrap/css/bootstrap.css" rel = "stylesheet"/>
		<link rel = "stylesheet" href = "../includes/stylesheet/app.css"/>

		<link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
	</head>

	<body>
		<?php
			include("../includes/header.php");
		?>

		<div class = "container-md my-3">
			<div class = " border rounded p-4">
				<h4>
					<span class="badge text-bg-success"><?php echo $row['category']; ?></span>
				</h4>
				<h1 class = "serif display-6 fw-bold my-3">
					<?php echo $row['title']; ?>
				</h1>
				<p class = "m-0"><strong>Author: </strong><span class = "fst-italic">
					<?php echo $row['author']; ?>
				</span></p>
				<p class = "fst-italic mt-0">Posted on:
					<?php echo $row['date']; ?>
				</p>
				<div class = "desc">
					<?php echo $row['description']; ?>
				</div>
			</div>
			<h2 class = "mt-3">Recent comments</h2>
			<div class = "row">
				<div class = "col-12">
					<div class = "border rounded p-4">
						<?php if ($comm_is_empty == true): ?>
							<div class = "alert alert-danger alert-dismissible fade show" role = "alert">
								Empty comment!
								<button type = "button" class = "btn-close" data-bs-dismiss = "alert"
								        aria-label = "Close"></button>
							</div>
						<?php else: ?>
						<?php endif; ?>
						<form action = "project.php <?php echo '?id=' . $id; ?>" method = "post"
						      class = "d-flex flex-column flex-md-row gap-3 justify-content-between align-items-start align-items-md-center">
							<div class = "input-group">
								<span class = "input-group-text d-none d-sm-block">Your comment</span>
								<textarea name = "comment" class = "form-control rounded-end"
								          aria-label = "With textarea"
								          placeholder = "Explain how you can be helpful in this project"
								          rows = "1"></textarea>
							</div>
							<input type = "submit" value = "Submit" class = "btn btn-success">
						</form>
					</div>
				</div>
			</div>
			<div class = "row">
				<?php foreach ($comment_results as $post_comment): ?>
					<?php
					$query = "SELECT * FROM users WHERE id = ?";
					$stmt = $conn->prepare($query);
					$stmt->bind_param('i', $post_comment['userid']);
					$stmt->execute();
					$user_results = $stmt->get_result();
					$single_user = $user_results->fetch_assoc();

					$comment_user_name = $single_user['name'];
					$comment_user_email = $single_user['email'];

					$stmt->close();
					?>
					<div class = "col-12 col-md-6 mt-4">
						<div class = "border rounded p-4">

							<p class = "fw-bold fs-5 m-0"><?php echo $comment_user_name ?></p>
							<p class = "badge text-bg-success mb-2"><strong>Email: </strong><span><a
										href = "mailto:<?php echo $comment_user_email ?>"
										class = "text-decoration-none fw-medium text-white"><?php echo $comment_user_email ?></a></span>
							</p>
							<p class = "fs-5 m-0"><?php echo $post_comment['comment'] ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

		</div>


		<?php
			include("../includes/footer.html");

			$conn->close();
		?>


		<!-- bootstrap js -->
		<script src = "../includes/bootstrap/js/bootstrap.bundle.js"></script>

	</body>

</html>