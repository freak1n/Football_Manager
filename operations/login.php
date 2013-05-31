<?php 
	if (isset($_POST['submit'])) 
	{
		require_once("../database-scripts/database-config.php");
		$entered_username = $mysqli->real_escape_string($_POST['username']);
		$entered_password = $mysqli->real_escape_string($_POST['password']);

		// SQL Query for check credentials
		$query = "SELECT `username` 
					FROM `fb_users` 
					WHERE `username` = '$entered_username'
					AND `password` = MD5 ('$entered_password')
					LIMIT 1";
		$result = $mysqli->query($query);

		// Check if the credentials are true
		if ($result->num_rows === 1) 
		{
			$logged_user = $result->fetch_assoc();
			session_start();
			$_SESSION["username"] = $logged_user["username"];
			$_SESSION["logged"] = TRUE;
			header("Location: ../teams.php");
		} 
		else 
		{
			header("Location: ../index.php?failed=1");
		}

	} 
	else 
	{
		 header("Location: index.php");
		 die();
	}