<?php
	include "../includes/connection.php";

	$update_token_sql = "UPDATE users SET token = 'tets token' WHERE email = '$email'";
	$conn->query($update_token_sql);
    