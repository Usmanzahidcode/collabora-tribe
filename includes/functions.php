<?php
	function is_strong_password($password)
	{
		if (strlen($password) < 8) {
			return false;
		}
		if (!preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
			return false;
		}
		return true;
	}
	function generateToken($length = 32) {
		$token = bin2hex(random_bytes($length));
		return $token;
	}
	function sanitizeCkInput($input) {
		// List of allowed HTML tags (h1, h2, h3, p, ul, ol, li, strong, a, span, and em)
		$allowedTags = '<h2><h3><h4><p><ul><ol><li><strong><a><i>';
		// Strip all tags except the allowed ones
		$sanitizedInput = strip_tags($input, $allowedTags);

		return $sanitizedInput;
	}
