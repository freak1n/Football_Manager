<?php 
	session_start();
	if ( ! $_SESSION["logged"] ) 
	{
		header("Location: ../index.php"); 
	    die();
	}

	if ( ! isset($_GET["player_id"]) )
	{
		die("You must select the player!");
	}
	else
	{
		$player_id = $_GET['player_id'];
		$_SESSION['player_firstname'] = $_GET['player_firstname'];
	}

	require_once("../database-scripts/database-requests.php");
	// On update-form submitted
	if (isset($_POST['submit'])) 
	{
		// Prepare for update player
		$player_firstname = $mysqli->real_escape_string($_POST['player_firstname']);
		$player_lastname = $mysqli->real_escape_string($_POST['player_lastname']);
		$player_height = $mysqli->real_escape_string($_POST['player_height']);
		$player_playingposition = $mysqli->real_escape_string($_POST['player_playingposition']);

		update_player($player_id, $player_firstname, $player_lastname, 
		$player_height, $player_playingposition);
		header("Location: ../players.php?team_id=".$_GET['team_id']);
	}
	require_once("../html-snippets/header-html.php");
	require_once("../html-snippets/greetings.php");
?>
		<div class="title-text">Edit player: <?php echo $_SESSION['player_firstname'] ?></div>
		
		<form id="new-team-player-form" action="" method="post">
			<?php 
				$player_data = get_player_by_id($player_id);

				foreach ($player_data as $field => $value) 
				{											
			?>
				<input type="text" name="<?php echo $field ?>" value="<?php echo $value ?>" autocomplete="false" placeholder="<?php echo $field ?>" required />
			<?php 
				}
			?>
			<input type="submit" name="submit" value="Update player" />
		</form>
		<a class="go-back" href="../teams.php">&lt; &lt; &lt;	Go back to Teams page!</a>	
	</div>
</body>