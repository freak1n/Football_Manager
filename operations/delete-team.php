<?php 
	session_start();
	if ( ! $_SESSION['logged'] )
	{ 
	    header("Location: ../index.php"); 
	    die(); 
	}

	if (isset($_GET['team_id'])) 
	{
		require_once("../database-scripts/database-requests.php");
		$team_id = $_GET["team_id"];
		delete_team_by_id($team_id);

		header("Location: ../teams.php");
	}