<?php

include '../includes/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email_half = filter_var($_POST['email-half'], FILTER_SANITIZE_EMAIL);
    $email_complete = $email_half . '@gmail.com';
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    //    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    //    $confirm_password = filter_var($_POST['confirm-password'], FILTER_SANITIZE_STRING);
    //    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

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
        if ($file_size > 5 * 1024 * 1024) {
            echo "Image size should be less than 2 MB.";
            exit;
        }

        // Generate a unique file name
        $new_file_name = uniqid() . "_" . $file_name;
        $upload_dir = "../userdata/profilepictures/";
        $upload_file = $upload_dir . $new_file_name;

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($file_tmp, $upload_file)) {
            // Update the user profile in the database
            $query = "UPDATE users SET name = ?, email = ?, bio = ?, profile_picture = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssi", $name, $email_complete, $bio, $new_file_name, $_SESSION['user_id']);
            $stmt->execute();
            $stmt->close();

            // Redirect to profile page or success message
            $_SESSION['name'] = $name;
            header('location: admin.php');
        } else {
            echo "Error uploading the file.";
        }
    } else {
        // Update the user profile without changing the profile picture
        $query = "UPDATE users SET name = ?, email = ?, bio = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $name, $email_complete, $bio, $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();

        // Redirect to profile page or success message
        $_SESSION['name'] = $name;
        header('location: admin.php');
    }
}