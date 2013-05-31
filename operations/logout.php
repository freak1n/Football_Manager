<?php 
	session_start();
	$_SESSION['username'] = "";
	$_SESSION['logged'] = FALSE;
	header("Location: ../index.php");
	die();