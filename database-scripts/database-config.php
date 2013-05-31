<?php 
	// DB Connect
	define("DATABASE_NAME", "yavorclo_FootballManager");
	define("SERVER", "localhost");
	define("USERNAME", "yavorclo_yavor");
	define("PASSWORD", "yavorclo$1");

	$mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE_NAME);
	if($mysqli->connect_error){
		die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}

	// FIX Cyrillic
	$mysqli -> query("SET NAMES UTF8");
?>