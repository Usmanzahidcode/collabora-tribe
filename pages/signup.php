<?php
include '../includes/connection.php';
include '../includes/functions.php';

session_start();

$refill_name = '';
$refill_email = '';
$refill_bio = '';

if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    header('location: projectcatalog.php');
}
//
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//
//    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
//    $email_half = filter_var($_POST['email-half'], FILTER_SANITIZE_EMAIL);
//    // Creating full email
//    $email_complete = $email_half . '@gmail.com';
//    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
//    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
//    $confirm_password = filter_var($_POST['confirm-password'], FILTER_SANITIZE_STRING);
//
//    if ($password === $confirm_password) {
//        if (is_strong_password($password)) {
//            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//
//            $query = "INSERT INTO users (name, email, bio, password) VALUES (?, ?, ?, ?)";
//            $stmt = $conn->prepare($query);
//            $stmt->bind_param("ssss", $name, $email_complete, $bio, $hashedPassword);
//
//            $stmt->execute();
//            $stmt->close();
//
//            $conn->close();
//
//            session_start();
//            $_SESSION['signup_success'] = true;
//
//            //Redirect here to success page that also has link to the login page.
//            header('location: signup-success.php');
//
//        } else {
//            $passwordIsStrong = false;
//        }
//    } else {
//        $passwordIsMatching = false;
//    }
//}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email_half = filter_var($_POST['email-half'], FILTER_SANITIZE_EMAIL);
    $email_complete = $email_half . '@gmail.com';
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $confirm_password = filter_var($_POST['confirm-password'], FILTER_SANITIZE_STRING);

    if ($password === $confirm_password) {
        if (is_strong_password($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Check if a file was uploaded
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
                $file = $_FILES['profile_picture'];
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                $file_size = $file['size'];
                $file_error = $file['error'];

                // Check if the image is square
                list($width, $height) = getimagesize($file_tmp);
                if ($width != $height) {
                    echo "Only square images are allowed.";
                    exit;
                }

                // Check if the image size is less than 2 MB
                if ($file_size > 2 * 1024 * 1024) {
                    echo "Image size should be less than 2 MB.";
                    exit;
                }

                // Generate a unique file name
                $new_file_name = uniqid() . "_" . $file_name;
                $upload_dir = "../userdata/profilepictures/";
                $upload_file = $upload_dir . $new_file_name;

                // Move the uploaded file to the upload directory
                if (move_uploaded_file($file_tmp, $upload_file)) {
                    // Save the file name in the database
                    $query = "INSERT INTO users (name, email, bio, password, profile_picture) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssss", $name, $email_complete, $bio, $hashedPassword, $new_file_name);
                    $stmt->execute();
                    $stmt->close();

                    $conn->close();

                    session_start();
                    $_SESSION['signup_success'] = true;

                    // Redirect here to success page that also has link to the login page.
                    header('location: signup-success.php');
                } else {
                    echo "Error uploading the file.";
                }
            } else {
                echo "No file was uploaded.";
            }
        } else {
            $passwordIsStrong = false;
        }
    } else {
        $passwordIsMatching = false;
    }
    $refill_name = $_POST['name'];
    $refill_email = $email_half;
    $refill_bio = $_POST['bio'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Sign Up! | CollaboraTribe</title>
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/png">
    <link
            href="../includes/bootstrap/css/bootstrap.min.css"
            rel="stylesheet"/>
    <link rel="stylesheet" href="../includes/stylesheet/app.css"/>

    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
</head>
<body class="d-flex flex-column vh-100 justify-content-between">

<?php
include("../includes/header.php");
?>

<div class="container py-4">
    <div class="w-100 d-flex justify-content-center align-items-center">
        <img src="../assets/logo_full_color.png" class="me-3 pb-3" width="300px" alt=""/>
    </div>

    <div class="row px-0">
        <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto p-4 text-bg-success rounded">
            <?php
            if (isset($passwordIsMatching)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                             Password are not the same!
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
            }
            if (isset($passwordIsStrong)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                             Password is not strong enough. Include numbers, Capitals and small letters!
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
            }
            ?>

            <h1 class="text-center serif">Sign Up!</h1>
            <p class="text-center">
                Create your account and embrace the collaboration journey
            </p>
            <form action="signup.php" method="post" enctype="multipart/form-data">
                <div class="input-group flex-nowrap mb-3">
							<span class="input-group-text" id="addon-wrapping"><i
                                        class="bi bi-person-fill"></i></span>
                    <input name="name" type="text" class="form-control" placeholder="Full name"
                           aria-label="Username"
                           aria-describedby="addon-wrapping" required value="<?php if(isset($refill_name)) { echo $refill_name; } ?>">
                </div>
                <div class="input-group mb-3">
                    <input name="email-half"
                           type="text"
                           class="form-control"
                           placeholder="User's email"
                           aria-label="User's email"
                           aria-describedby="basic-addon2" required  value="<?php if(isset($refill_email)) { echo $refill_email; } ?>"/>
                    <span class="input-group-text" id="basic-addon2">@gmail.com</span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Bio</span>
                    <textarea name="bio" class="form-control" aria-label="With textarea"
                              placeholder="Hello World! A Laravel Developer with a keen interest in fullstack side of web development."
                              rows="3"><?php if(isset($refill_bio)) { echo $refill_bio; } ?></textarea>
                </div>

                <div class="input-group flex-nowrap mb-3">
							<span class="input-group-text" id="addon-wrapping"><i
                                        class="bi bi-shield-lock-fill"></i></span>
                    <input name="password"
                           type="password"
                           class="form-control"
                           placeholder="8+ length with capital and small letters"
                           aria-label="Password"
                           aria-describedby="addon-wrapping" required/>
                </div>
                <div class="input-group flex-nowrap mb-3">
							<span class="input-group-text" id="addon-wrapping"><i
                                        class="bi bi-shield-lock-fill"></i></span>
                    <input name="confirm-password"
                           type="password"
                           class="form-control"
                           placeholder="Confirm Password"
                           aria-label="Confirm Password"
                           aria-describedby="addon-wrapping" required/>
                </div>
                <div class="input-group flex-nowrap mb-3">
                    <input name="profile_picture"
                           type="file"
                           class="form-control" required/>
                </div>
                <div class="w-100 d-flex justify-content-center mb-3">
                    <input
                            class="btn btn-light w-100"
                            type="submit"
                            name="submit"
                            value="Submit"
                            id="submit"/>
                </div>
                <a class="text-white" href="signin.php">I already have an account!</a>
            </form>
        </div>
    </div>
</div>
<?php
include("../includes/footer.html");
?>

<!-- bootstrap js -->
<script
        src="../includes/bootstrap/js/bootstrap.bundle.js"
></script>

</body>
</html>
