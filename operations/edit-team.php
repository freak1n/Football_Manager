<?php 
	session_start();
	if ( ! $_SESSION["logged"] ) 
	{
		header("Location: ../index.php"); 
	    die();
	}

	if ( ! isset($_GET['team_id']) )
	{
		die("You must select the team!");
	}
	else
	{
		$team_id = $_GET['team_id'];
		$_SESSION['team_name'] = $_GET['team_name'];
	}

	// On update-form submitted
	require_once("../database-scripts/database-requests.php");
	if (isset($_POST['submit'])) 
	{
		// Prepare for update team
		$team_name = $mysqli->real_escape_string($_POST['team_name']);
		$team_coach = $mysqli->real_escape_string($_POST['team_coach']);
		$team_sponsor = $mysqli->real_escape_string($_POST['team_sponsor']);

		update_team($team_id, $team_name, $team_coach, $team_sponsor);
		header("Location: ../teams.php?team_id=".$team_id);
	}
	require_once("../html-snippets/header-html.php");
	require_once("../html-snippets/greetings.php");
?>
		<div class="title-text">Edit team: <?php echo $_SESSION['team_name'] ?></div>

		<form id="new-team-player-form" action="" method="post">
			<?php 
				$team_data = get_team_by_id($team_id);
				foreach ($team_data as $field => $value) 
				{
			?>
				<input type="text" name="<?php echo $field ?>" value="<?php echo $value ?>" autocomplete="false" required />
			<?php 
				}	
			?>
			<input type="submit" name="submit" value="Update team" />
		</form>
		<a class="go-back" href="../teams.php">&lt; &lt; &lt;	Go back to Teams page!</a>	


	</div>
</body>