<?php 
	if (isset($_POST["submit"])) 
	{
		require_once("../database-scripts/database-requests.php");
		$new_team_name = $mysqli->real_escape_string($_POST['team_name']);
		$new_team_coach = $mysqli->real_escape_string($_POST['team_coach']);
		$new_team_sponsor = $mysqli->real_escape_string($_POST['team_sponsor']);
		
		add_new_team($new_team_name, $new_team_coach, $new_team_sponsor);
		header("Location: ../teams.php");		
	} 
	else 
	{
		header("Location: ../index.php");
	}
?>