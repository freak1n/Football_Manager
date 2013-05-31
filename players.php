<?php 
	session_start();
	if ( ! $_SESSION['logged'] )
	{ 
	    header("Location: index.php"); 
	    die(); 
	}
	
	require_once("html-snippets/header-html.php");
	require_once("html-snippets/greetings.php");
	require_once("database-scripts/database-requests.php");	

	if ( ! isset($_GET['team_id']) )
	{
		die("You must select the team!");
	}
	
	if (isset($_GET['team_name'])) 
	{
		$_SESSION['team_name'] = $_GET['team_name'];
	}
?>
		<div class="title-text">Players of <?php echo $_SESSION['team_name'] ?></div>
		<table id="information-table">
			<colgroup>
				<col style="width: 200px" />
				<col style="width: 200px" />
				<col style="width: 200px" />
				<col style="width: 200px" />
				<col style="width: 50px" />
				<col style="width: 50px" />
			</colgroup>
			<thead>
				<tr>
					<td>First Name</td>
					<td>Last Name</td>
					<td>Height</td>
					<td>Playing Position</td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$players_array = get_all_players_by_team_id($_GET['team_id']);
					if ( ! empty($players_array) ) 
					{
						foreach ($players_array as $i => $player) 
						{
							//Get parameters for editing player
							$edit_players_parameters = "player_id=".$player['player_id'].
														"&player_firstname=".$player["player_firstname"].
														"&team_id=".$_GET['team_id'];
				?>
				<tr>
					<td><?php echo $player["player_firstname"]; ?></td>
					<td><?php echo $player["player_lastname"]; ?></td>
					<td><?php echo $player["player_height"]; ?></td>
					<td><?php echo $player["player_playingposition"]; ?></td>
					<td class="edit-team-cell"><a href="operations/edit-player.php?<?php echo $edit_players_parameters ?>">Edit</a></td>
					<td class="delete-cell"><a href="operations/delete-player.php?player_id=<?php echo $player["player_id"]."&team_id=".$_GET["team_id"] ?>">Delete</a></td>
				</tr>
				
				<?php 
						}
					}
					else
					{
						echo "No players in this team";
					}
				 ?>
			</tbody>
		</table>

		<form id="new-team-player-form" action="operations/add-player.php" method="post">
			<label>Add new Player</label><br />
			<input type="text" name="firstname" placeholder="Firstname"  autocomplete="false" required />
			<input type="text" name="lastname" placeholder="Lastname"  autocomplete="false" required />
			<input type="number" name="height" placeholder="Height" autocomplete="false" required />
			<input type="text" name="playing_position" placeholder="Playing Position" autocomplete="false" required />
			<input type="hidden" name="team_id" value="<?php echo $_GET['team_id']; ?>" />
			<input type="submit" name="submit" value="Add new player" />
		</form>
		<a class="go-back" href="teams.php">&lt; &lt; &lt; Go back to Teams page!</a>		
	</div>
</body>