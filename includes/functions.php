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