<?php 
	require_once("database-config.php");

	/*================================*/
	/*      	Teams Operations
	/*================================*/
	function get_all_teams()
	{
		global $mysqli;
		$get_all_teams_query = "SELECT * 
								FROM `fb_teams`";
		if ($result = $mysqli->query($get_all_teams_query)) 
		{
			while ($row=$result->fetch_assoc()) 
			{
				$all_teams_array[] = $row; 
			}
			$result->free();
		}
		if ( !empty($all_teams_array) )
			return $all_teams_array;
	}
	
	function add_new_team($new_team_name, $new_team_coach, $new_team_sponsor)
	{
		global $mysqli;
		$add_new_team_query = "INSERT INTO fb_teams (team_name, team_coach, team_sponsor)
							VALUES
							('$new_team_name','$new_team_coach','$new_team_sponsor')";
		
		if ( ! $mysqli->query($add_new_team_query) )
		{
			die('Error: '.$mysqli->error);
		}
	}

		function get_team_by_id($team_id)
	{
		global $mysqli;
		$get_team_for_edit_query = "SELECT `team_name`, `team_coach`, `team_sponsor` 
											FROM `fb_teams` 
											WHERE team_id = ".$team_id;

		if ( ! $result = $mysqli->query($get_team_for_edit_query) ) 
		{
			die("Error:".$mysqli->error);
		}											

		$team_data = $result->fetch_assoc();
		return $team_data;
	}

	function update_team($team_id, $team_name, $team_coach, $team_sponsor)
	{
		global $mysqli;
		$update_team_query = "UPDATE `fb_teams` 
						SET `team_name` = '$team_name',
							`team_coach` = '$team_coach',
							`team_sponsor` = '$team_sponsor' 
						WHERE `team_id` = $team_id";

		$mysqli->query($update_team_query);
		if ( ! $mysqli->query($update_team_query) ) {
			die($mysqli->error);
		}
	}
	
	function delete_team_by_id($team_id)
	{
		global $mysqli;
		$delete_team_query = "DELETE FROM `fb_teams` WHERE team_id = $team_id";
		if (!$mysqli->query($delete_team_query))
		{
			die("Error:".$mysqli->error);
		}
	}

	/*================================*/
	/*      	Players operations
	/*================================*/

	function get_all_players_by_team_id($team_id)
	{
		global $mysqli;
		$get_all_players_query = "SELECT * 
							FROM `fb_players` 
							WHERE `team_id` = ".$team_id;
		if ($result = $mysqli->query($get_all_players_query)) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$players_array[] = $row; 
			}
			$result->free();
		}

		if ( !empty($players_array) )
			return $players_array;
	}

	function get_player_by_id($player_id)
	{
		global $mysqli;

		$get_player_for_edit_query = "SELECT `player_firstname`, `player_lastname`, 
									`player_height`, `player_playingposition` 
									FROM `fb_players` 
									WHERE player_id = ".$player_id;
									
		if ( ! $result = $mysqli->query($get_player_for_edit_query) ) 
		{
			die("Error:".$mysqli->error);
		}

		$player_data = $result->fetch_assoc();
		return $player_data;
	}

	function add_new_player($first_name, $last_name, $height, $playing_position, $team_id) 
	{
		global $mysqli;
		$new_player_query = "INSERT INTO fb_players (player_firstname, player_lastname, player_height, player_playingposition, team_id)
								VALUES
							('$first_name','$last_name','$height', '$playing_position', '$team_id')";

		if ( ! $mysqli->query($new_player_query) )
		{
			  die('Error: '.$mysqli->error);
		}
	}

	function delete_player_by_id($player_id) 
	{
		global $mysqli;
		$delete_player_query = "DELETE FROM `fb_players` WHERE player_id = $player_id";
		if ( ! $mysqli->query($delete_player_query)){
			die("Error:".$mysqli->error);
		}
	}

	function update_player($player_id, $player_firstname, $player_lastname, 
					$player_height, $player_playingposition)
	{
		global $mysqli;
		$update_team_query = "UPDATE `fb_players` 
								SET `player_firstname` = '$player_firstname',
								`player_lastname` = '$player_lastname',
								`player_height` = '$player_height',
								`player_playingposition` = '$player_playingposition' 
								WHERE `player_id` = $player_id";

		$mysqli->query($update_team_query);
		if ( ! $mysqli->query($update_team_query) ) 
		{
			die($mysqli->error);
		}
	}