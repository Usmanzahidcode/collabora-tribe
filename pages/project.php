<?php
	session_start();
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1"/>
		<title>Homepage | CollaboraTribe</title>
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
				<p class = "badge text-bg-success m-0">Web Development</p>
				<h1 class = "serif display-6 fw-bold my-3">A web app using nodejs for a university to manage
				                                           assignments</h1>
				<p class = "m-0"><strong>Author: </strong><span class = "fst-italic">Usman Zahid</span></p>
				<p class = "fst-italic mt-0">Posted on: 10 july 2023</p>
				<div class = "desc">
					<h1>Heading 1 test</h1>
					<p class = "fs-5">Collaboration is essential for success in today's interconnected world. When
					                  individuals come
					                  together, combining their unique skills and knowledge, they create a powerful
					                  force for
					                  innovation
					                  and progress. Collaborative efforts foster creativity, allowing diverse
					                  perspectives to merge and
					                  form novel solutions to complex problems. By sharing resources and pooling
					                  expertise, teams can
					                  accomplish tasks that would be difficult or impossible for individuals alone.
					                  Through open
					                  communication and mutual respect, collaboration builds trust among team members,
					                  encouraging a
					                  supportive and positive working environment. Successful collaboration enables
					                  individuals to earn
					                  reputation and recognition within the community, establishing themselves as
					                  valuable
					                  contributors.
					                  Celebrating achievements as a team reinforces motivation and fosters a culture of
					                  continuous
					                  improvement. Embracing collaboration empowers individuals to face challenges
					                  together, navigating
					                  obstacles with combined strength and adaptability. Ultimately, collaboration not
					                  only benefits
					                  the
					                  individuals involved but also drives collective progress toward shared goals.</p>
					<h2>Heading 2 test</h2>
					<ol>
						<li>Earn Reputation</li>
						<li>Add Value</li>
						<li>Promote Diversity</li>
						<li>Foster Innovation</li>
						<li>Enhance Efficiency</li>
					</ol>


					<h3>Heading 3 test</h3>
					<p>Each list item represents a crucial aspect of effective collaboration. "Earn Reputation" refers
					   to
					   the recognition individuals receive within the community for their valuable contributions to
					   collaborative efforts. Collaboration allows individuals to showcase their expertise and gain
					   respect
					   among peers, strengthening their professional reputation. Furthermore, collaboration enables team
					   members to "Add Value" by bringing their unique perspectives and skills to the table, enriching
					   the
					   overall quality of the project. A collaborative environment promotes inclusivity, "Promoting
					   Diversity" of ideas and approaches, leading to more comprehensive and well-rounded solutions.
					   "Foster
					   Innovation" highlights how collaboration sparks creativity and inspires breakthrough ideas that
					   may
					   not have emerged individually. Lastly, collaboration "Enhances Efficiency" by pooling resources
					   and
					   skills, streamlining the process, and accomplishing tasks more effectively. By embracing these
					   principles, teams can achieve remarkable outcomes and maximize the benefits of collaboration.</p>
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
