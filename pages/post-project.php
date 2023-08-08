<?php
	require_once "../includes/connection.php";
	require_once "../includes/functions.php";

	session_start();

	if ($_SESSION['is_logged_in'] !== true) {
		if (!isset($_COOKIE['user_token'])) {
			header('location: signin.php');
		}
		else{
			$_SESSION['is_logged_in'] = true;
		}
	}


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$title = $_POST['title'];
		$excerpt = $_POST['excerpt'];
		$description = $_POST['description'];
		$sanitized_description = sanitizeCkInput($description);
		$category = $_POST['category'];

		if (!empty($description)) {
			$query = "INSERT INTO projects (title, excerpt, description, category) values (?, ?, ?, ?)";
			$stmt = $conn->prepare($query);
			$stmt->bind_param('ssss', $title, $excerpt, $sanitized_description, $category);

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
					<?php
						if (isset($desc_is_empty)) {
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                             You need to Explain the project before posting.
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
						}
					?>
					<h1 class = "serif display-5">Post new Project</h1>
					<p class = " my-3">This is the start of collaboration process.
					                   Fill the complete form and submit.
						<span
							class = "badge text-bg-danger p5">Guidelines:</span> Be responsible. Act like you would
					                   in
					                   real life. Be as detailed as possible.</p>
					<form action = "post-project.php" method = "post">
						<div class = "input-group mb-3">
							<span class = "input-group-text" id = "inputGroup-sizing-default">Title</span>
							<input required name = "title" type = "text" class = "form-control"
							       placeholder = "A self explaining title"
							       aria-label = "Sizing example input"
							       aria-describedby = "inputGroup-sizing-default">
						</div>
						<div class = "input-group mb-3">
							<span class = "input-group-text" id = "inputGroup-sizing-default">Excerpt</span>
							<input required name = "excerpt" type = "text" class = "form-control"
							       aria-label = "Sizing example input"
							       aria-describedby = "inputGroup-sizing-default"
							       placeholder = "A medium length excerpt that gives basic information about your project." minlength="250" maxlength="500">
						</div>
						<textarea required name = "description" type = "text" class = "form-control"
						          aria-label = "Sizing example input"
						          aria-describedby = "inputGroup-sizing-default" id = "article_editor"
						          placeholder = "Explain everything about the project. What you are going to make, what kind of talent you are looking for. What will be the role of those required team members. Share the github repo link if you have one. ">
						</textarea>
						<select name = "category" class = "form-select mt-3" aria-label = "Default select example"
						        required>
							<option value = "Web Development">Web Development</option>
							<option value = "Mobile App Development">Mobile App Development</option>
							<option value = "Desktop Application Development">Desktop Application Development</option>
							<option value = "DevOps and Automation">DevOps and Automation</option>
							<option value = "Data Science and Analytics">Data Science and Analytics</option>
							<option value = "Machine Learning">Machine Learning</option>
							<option value = "Artificial Intelligence">Artificial Intelligence</option>
							<option value = "Game Development">Game Development</option>
							<option value = "Algorithm Design and Optimization">Algorithm Design and Optimization
							</option>
							<option value = "Cloud Computing and Virtualization">Cloud Computing and Virtualization
							</option>
							<option value = "Internet of Things (IoT)">Internet of Things (IoT)</option>
							<option value = "Database Systems">Database Systems</option>
							<option value = "Cybersecurity and Ethical Hacking">Cybersecurity and Ethical Hacking
							</option>
							<option value = "UI/UX Design and Prototyping">UI/UX Design and Prototyping</option>
							<option value = "Augmented Reality (AR) and Virtual Reality (VR)">Augmented Reality (AR) and
							                                                                  Virtual Reality (VR)
							</option>
							<option value = "Embedded Systems and Robotics">Embedded Systems and Robotics</option>
							<option value = "Blockchain and Cryptocurrency">Blockchain and Cryptocurrency</option>
							<option value = "Natural Language Processing (NLP)">Natural Language Processing (NLP)
							</option>
							<option value = "Graphics and Multimedia">Graphics and Multimedia</option>
							<option value = "Software Testing and Quality Assurance">Software Testing and Quality
							                                                         Assurance
							</option>
							<option value = "3">OTHER</option>
						</select>
						<div class = "d-flex justify-content-center">
							<input type = "submit" value = "Submit" class = "btn btn-success mt-3 w-25 fw-medium">
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
			src = "../includes/bootstrap/js/bootstrap.bundle.js"></script>

		<!-- Full blown CKeditor, Not needed for this projects, can't support images. -->
		<!--<script src = "https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>-->

		<script src = "../includes/ckeditor/build/ckeditor.js"></script>
		<script>

			ClassicEditor
				.create(document.querySelector("#article_editor"))
				.catch((error) => {
					console.error(error);
				});

		</script>
		<style>
			.ck-editor__editable_inline {
				min-height: 200px;
			}

		</style>

	</body>
</html>
