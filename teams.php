<?php 
	session_start();
	if( ! $_SESSION['logged'] )
	{ 
	    header("Location: index.php"); 
	    exit(); 
	} 
	require_once("html-snippets/header-html.php");
	require_once("database-scripts/database-requests.php");
	require_once("html-snippets/greetings.php");
?>
	<div class="title-text">Teams</div>
		<table id="information-table">
			<colgroup>
				<col style="width: 200px" />
				<col style="width: 200px" />
				<col style="width: 200px" />
				<col style="width: 50px" />
				<col style="width: 120px" />
				<col style="width: 70px" />
			</colgroup>
			<thead>
				<tr>
					<td>Team name</td>
					<td>Team coach</td>
					<td>Team sponsor</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$teams_array = get_all_teams();
					if ( ! empty($teams_array) ) 
					{
						foreach ($teams_array as $i => $team) 
						{
							// Prameters for team_id and team_name
							// Used for Edit team and view players of some team
							$get_parameters = "team_id=".$team['team_id']."&team_name=".$team['team_name'];
					?>
					<tr>
						<td><?php echo $team["team_name"] ?></td>
						<td><?php echo $team["team_coach"] ?></td>
						<td><?php echo $team["team_sponsor"] ?></td>
						<td class="edit-team-cell"><a href="operations/edit-team.php?<?php echo $get_parameters;?>">Edit</a></td>
						<td class="view-players-cell"><a href="players.php?<?php  echo $get_parameters; ?>">View players</a></td>
						<td class="delete-cell"><a href="#"><a href="operations/delete-team.php?team_id=<?php echo $team["team_id"]?>">Delete</a></td>
					</tr>
					<?php
				 		}
					}
					else
					{
						echo"No teams";
					}
				 ?>
			</tbody>
		</table>

		<form id="new-team-player-form" action="operations/add-team.php" method="post">
			<label>Add new Team</label><br />
			<input type="text" name="team_name" placeholder="Team name"  autocomplete="false" required />
			<input type="text" name="team_coach" placeholder="Team coach"  autocomplete="false" required />
			<input type="text" name="team_sponsor" placeholder="Team sponsor" autocomplete="false" required />
			<input type="submit" name="submit" value="Add new team" />
		</form>
	</div>
</body>
</html>