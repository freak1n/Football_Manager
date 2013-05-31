<?php 
	if (isset($_POST["submit"])) 
	{
		require_once("../database-scripts/database-requests.php");
		$first_name = $mysqli->real_escape_string($_POST["firstname"]);
		$last_name = $mysqli->real_escape_string($_POST["lastname"]);
		$height = $mysqli->real_escape_string($_POST["height"]);
		$playing_position = $mysqli->real_escape_string($_POST["playing_position"]);
		$team_id = $mysqli->real_escape_string($_POST["team_id"]);

		add_new_player($first_name, $last_name, $height, $playing_position, $team_id);
		header("Location: ../players.php?team_id=".$team_id);
	} 
	else 
	{
		header("Location: ../index.php");
	}	
?>