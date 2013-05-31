<?php 
	session_start();
	if ( ! $_SESSION['logged'] )
	{ 
	    header("Location: ../index.php"); 
	    die(); 
	}

	if (isset($_GET["player_id"])) 
	{
		require_once("../database-scripts/database-requests.php");
		$player_id = $_GET['player_id'];
		delete_player_by_id($player_id);

		header("Location: ../players.php?team_id=".$_GET["team_id"]);
	}
?>