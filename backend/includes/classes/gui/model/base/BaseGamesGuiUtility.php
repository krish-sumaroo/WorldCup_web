<?php


class BaseGamesGuiUtility
{

    public static function getDisplay()
    {
	$output = "";

	$output .= HeaderTextGuiUtility::getHeaderDisplay("Games");

	$output .= "<div>";
	$output .= "<a href='javascript:void(0);' onclick=\"getAddGames();\">Add Games</a>";
	$output .= "</div>";

	$output .= "<div id='games_add_link' style='display: none;'>";
	$output .= "</div>";

	$output .= "<div class='' id='games_list_con'>";
	$output .= BaseGamesGuiUtility::getGamesList();
	$output .= "</div>";

	return $output;
    }

    public static function getAddGames()
    {
	$output = "";

	$urlForm = UrlConfiguration::getUrl("games", "addProcessor");

	$output .= "<h3 style='text-align: center;'>Add Banner</h3>";

	$output .= "<div class='col-sm-12'>";
	$output .= "<form role='form' action='$urlForm' method='post'>";
	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_stage'>Stage</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_stage' name='txt_stage' placeholder='Stage' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_team1'>Team1 *</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_team1' name='txt_team1' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_team2'>Team2 *</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_team2' name='txt_team2' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_venue'>Venue *</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_venue' name='txt_venue' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_t1Score'>T1Score *</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_t1Score' name='txt_t1Score' placeholder='T1Score' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_t2Score'>T2Score *</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_t2Score' name='txt_t2Score' placeholder='T2Score' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_extraScore'>ExtraScore *</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_extraScore' name='txt_extraScore' placeholder='ExtraScore' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= DateGuiUtility::getTimeChooser("timeStarted");
	$output .= "<input class='form-control span12' type='text' id='txt_timeStarted' name='txt_timeStarted' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_startedF'>StartedF *</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_startedF' name='txt_startedF' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_playerInfo'>PlayerInfo</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_playerInfo' name='txt_playerInfo' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= DateGuiUtility::getTimeChooser("matchDate");
	$output .= "<input class='form-control span12' type='text' id='txt_matchDate' name='txt_matchDate' value=\"\" />";
	$output .= "</div>";


	$output .= "<div id='add_games_con'></div>";

	$output .= "<div id='add_games_com'>";
	$output .= "<button type='button' class='btn btn-primary' onclick=\"addGames\">Save</button>";
	$output .= "&nbsp;";
	$output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
	$output .= "&nbsp;";
	$output .= "<button type='reset' class='btn'>Reset</button>";
	$output .= "</div>";
	$output .= "</form>";
	$output .= "</div>";


	$output .= DateGuiUtility::getJQueryDatePicker("txt_timeStarted");
	$output .= DateGuiUtility::getJQueryDatePicker("txt_matchDate");
	return $output;
    }

    public static function addGames($stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted,
	    $startedF, $playerInfo, $matchDate)
    {
	$output = "";

	$error = GamesManager::addGames($stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted,
			$startedF, $playerInfo, $matchDate);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $resultMessage = "";
	    $resultMessage .= "<p>Games has been successfully saved.</p>";
	    $resultMessage .= "<p>";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddGames();\">Add another >Games</a> or ";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
	    $resultMessage .= "</p>";

	    $resultMessage .= "<script>";
	    $resultMessage .= "$('#add_games_com').hide();";
	    $resultMessage .= "reloadGamesList();";
	    $resultMessage .= "</script>";

	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
	}

	return $output;
    }

    public static function getGamesList()
    {
	$output = "";

	$gamesList = BaseGamesLogicUtility::getGamesList();

	if(count($gamesList) > 0)
	{
	    $output .= "<table class='table'>";
	    $output .= "<tr>";
	    $output .= "<th>Stage</th>";
	    $output .= "<th>Team1</th>";
	    $output .= "<th>Team2</th>";
	    $output .= "<th>Venue</th>";
	    $output .= "<th>T1Score</th>";
	    $output .= "<th>T2Score</th>";
	    $output .= "<th>ExtraScore</th>";
	    $output .= "<th>TimeStarted</th>";
	    $output .= "<th>StartedF</th>";
	    $output .= "<th>PlayerInfo</th>";
	    $output .= "<th>MatchDate</th>";
	    $output .= "</tr>";

	    for($i = 0; $i < count($gamesList); $i++)
	    {
		$id = $gamesList[$i]->getId();
		$stage = $gamesList[$i]->getStage();
		$team1 = $gamesList[$i]->getTeam1();
		$team2 = $gamesList[$i]->getTeam2();
		$venue = $gamesList[$i]->getVenue();
		$t1Score = $gamesList[$i]->getT1Score();
		$t2Score = $gamesList[$i]->getT2Score();
		$extraScore = $gamesList[$i]->getExtraScore();
		$timeStarted = $gamesList[$i]->getTimeStarted();
		$startedF = $gamesList[$i]->getStartedF();
		$playerInfo = $gamesList[$i]->getPlayerInfo();
		$matchDate = $gamesList[$i]->getMatchDate();

		$gamesLineContainerId = "games_line_con_".$id;
		$gamesActionLineContainerId = "games_action_line_con_".$id;
		$gamesActionContainerId = "games_action_con_".$id;

		$stageContainerId = "games_stage_con_".$id;
		$team1ContainerId = "games_team1_con_".$id;
		$team2ContainerId = "games_team2_con_".$id;
		$venueContainerId = "games_venue_con_".$id;
		$t1ScoreContainerId = "games_t1Score_con_".$id;
		$t2ScoreContainerId = "games_t2Score_con_".$id;
		$extraScoreContainerId = "games_extraScore_con_".$id;
		$timeStartedContainerId = "games_timeStarted_con_".$id;
		$startedFContainerId = "games_startedF_con_".$id;
		$playerInfoContainerId = "games_playerInfo_con_".$id;
		$matchDateContainerId = "games_matchDate_con_".$id;

		$output .= "<tr id='$gamesLineContainerId'>";
		$output .= "<td id='$stageContainerId'>$stage</td>";
		$output .= "<td id='$team1ContainerId'>$team1</td>";
		$output .= "<td id='$team2ContainerId'>$team2</td>";
		$output .= "<td id='$venueContainerId'>$venue</td>";
		$output .= "<td id='$t1ScoreContainerId'>$t1Score</td>";
		$output .= "<td id='$t2ScoreContainerId'>$t2Score</td>";
		$output .= "<td id='$extraScoreContainerId'>$extraScore</td>";
		$output .= "<td id='$timeStartedContainerId'>$timeStarted</td>";
		$output .= "<td id='$startedFContainerId'>$startedF</td>";
		$output .= "<td id='$playerInfoContainerId'>$playerInfo</td>";
		$output .= "<td id='$matchDateContainerId'>$matchDate</td>";

		$output .= "<td class='list_table_data_act'>";
		$output .= "<a href='javascript:void(0);' onclick=\"getEditGames('$id');\">Edit</a>";
		$output .= " | ";
		$output .= "<a href='javascript:void(0);' onclick=\"getDeleteGames('$id');\">Delete</a>";
		$output .= "</td>";

		$output .= "<tr id='$gamesActionLineContainerId' style='display: none;'>";
		$output .= "<td colspan='12' id='$gamesActionContainerId'></td>";
		$output .= "</tr>";
	    }

	    $output .= "</table>";
	}
	else
	{
	    $output .= "<p>No records for Games</p>";
	}

	return $output;
    }

    public static function clearAddGames()
    {
	$output = "";

	$output .= "<script>";
	$output .= "$('#txt_stage').val('');";
	$output .= "$('#txt_team1').val('');";
	$output .= "$('#txt_team2').val('');";
	$output .= "$('#txt_venue').val('');";
	$output .= "$('#txt_t1Score').val('');";
	$output .= "$('#txt_t2Score').val('');";
	$output .= "$('#txt_extraScore').val('');";
	$output .= "$('#txt_startedF').val('');";
	$output .= "$('#txt_playerInfo').val('');";

	$output .= "$('#add_games_com').show();";
	$output .= "</script>";

	return $output;
    }

    public static function getEditGames($id, $userId)
    {
	$output = "";

	$gamesEntity = BaseGamesLogicUtility::getGamesDetails($id, $userId);

	if($gamesEntity)
	{
	    $gamesActionLineContainerId = "games_action_line_con_".$id;
	    $gamesActionContainerId = "games_action_con_".$id;

	    $editContainer = "games_edit_con_".$id;
	    $editCommandContainer = "games_edit_com_".$id;

	    $stage = $gamesEntity->getStage();
	    $team1 = $gamesEntity->getTeam1();
	    $team2 = $gamesEntity->getTeam2();
	    $venue = $gamesEntity->getVenue();
	    $t1Score = $gamesEntity->getT1Score();
	    $t2Score = $gamesEntity->getT2Score();
	    $extraScore = $gamesEntity->getExtraScore();
	    $timeStarted = $gamesEntity->getTimeStarted();
	    $startedF = $gamesEntity->getStartedF();
	    $playerInfo = $gamesEntity->getPlayerInfo();
	    $matchDate = $gamesEntity->getMatchDate();

	    $stageContainer = "games_txt_stage_".$id;
	    $team1Container = "games_txt_team1_".$id;
	    $team2Container = "games_txt_team2_".$id;
	    $venueContainer = "games_txt_venue_".$id;
	    $t1ScoreContainer = "games_txt_t1Score_".$id;
	    $t2ScoreContainer = "games_txt_t2Score_".$id;
	    $extraScoreContainer = "games_txt_extraScore_".$id;
	    $timeStartedContainer = "games_txt_timeStarted_".$id;
	    $startedFContainer = "games_txt_startedF_".$id;
	    $playerInfoContainer = "games_txt_playerInfo_".$id;
	    $matchDateContainer = "games_txt_matchDate_".$id;

	    $output .= "<h2 class='text-center'>Edit Games</h2>";

	    $output .= "<form class='form' role='form' action=\"\" method\"post\">";
	    $output .= "<div class='form-group'>";
	    $output .= "<label for='$stageContainer'>Stage</label>";
	    $output .= "<input class='form-control span12' type='text' id='$stageContainer' name='$stageContainer' placeholder='Stage' value=\"$stage\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= "<label for='$team1Container'>Team1 *</label>";
	    $output .= "<input class='form-control span12' type='text' id='$team1Container' name='$team1Container' value=\"$team1\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= "<label for='$team2Container'>Team2 *</label>";
	    $output .= "<input class='form-control span12' type='text' id='$team2Container' name='$team2Container' value=\"$team2\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= "<label for='$venueContainer'>Venue *</label>";
	    $output .= "<input class='form-control span12' type='text' id='$venueContainer' name='$venueContainer' value=\"$venue\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= "<label for='$t1ScoreContainer'>T1Score *</label>";
	    $output .= "<input class='form-control span12' type='text' id='$t1ScoreContainer' name='$t1ScoreContainer' placeholder='T1Score' value=\"$t1Score\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= "<label for='$t2ScoreContainer'>T2Score *</label>";
	    $output .= "<input class='form-control span12' type='text' id='$t2ScoreContainer' name='$t2ScoreContainer' placeholder='T2Score' value=\"$t2Score\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= "<label for='$extraScoreContainer'>ExtraScore *</label>";
	    $output .= "<input class='form-control span12' type='text' id='$extraScoreContainer' name='$extraScoreContainer' placeholder='ExtraScore' value=\"$extraScore\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= DateGuiUtility::getTimeChooser("timeStarted_".$id);
	    $output .= "<input class='form-control span12' type='text' id='$timeStartedContainer' name='$timeStartedContainer' value=\"$timeStarted\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= "<label for='$startedFContainer'>StartedF *</label>";
	    $output .= "<input class='form-control span12' type='text' id='$startedFContainer' name='$startedFContainer' value=\"$startedF\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= "<label for='$playerInfoContainer'>PlayerInfo</label>";
	    $output .= "<input class='form-control span12' type='text' id='$playerInfoContainer' name='$playerInfoContainer' value=\"$playerInfo\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= DateGuiUtility::getTimeChooser("matchDate_".$id);
	    $output .= "<input class='form-control span12' type='text' id='$matchDateContainer' name='$matchDateContainer' value=\"$matchDate\" />";
	    $output .= "</div>";

	    $output .= "<div class='form-group' id='$editContainer'>";
	    $output .= "</div>";

	    $output .= "<div class='form-group' id='$editCommandContainer'>";
	    $output .= "<button class='btn btn-primary' type='button' onclick=\"editGames();\">Save</button>";
	    $output .= "&nbsp;";
	    $output .= "<button class='btn' type='button' onclick=\"$('#$gamesActionContainerId').html('');$('#$gamesActionLineContainerId').hide();\">Cancel</button>";
	    $output .= "</div>";

	    $output .= "</form>";

	    $output .= DateGuiUtility::getJQueryDatePicker($timeStartedContainer);
	    $output .= DateGuiUtility::getJQueryDatePicker($matchDateContainer);
	}
	else
	{
	    $output .= "<p>An error occurred while retrieving details</p>";
	}
	return $output;
    }

    public static function editGames($id, $stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted,
	    $startedF, $playerInfo, $matchDate)
    {
	$output = "";

	$error = GamesManager::editGames($id, $stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted,
			$startedF, $playerInfo, $matchDate);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $gamesActionLineContainerId = "games_action_line_con_".$id;
	    $gamesActionContainerId = "games_action_con_".$id;

	    $editCommandContainer = "games_edit_com_".$id;

	    $stageContainer = "games_txt_stage_".$id;
	    $team1Container = "games_txt_team1_".$id;
	    $team2Container = "games_txt_team2_".$id;
	    $venueContainer = "games_txt_venue_".$id;
	    $t1ScoreContainer = "games_txt_t1Score_".$id;
	    $t2ScoreContainer = "games_txt_t2Score_".$id;
	    $extraScoreContainer = "games_txt_extraScore_".$id;
	    $timeStartedContainer = "games_txt_timeStarted_".$id;
	    $startedFContainer = "games_txt_startedF_".$id;
	    $playerInfoContainer = "games_txt_playerInfo_".$id;
	    $matchDateContainer = "games_txt_matchDate_".$id;

	    $resultMessage = "";
	    $resultMessage .= "<p>Games has been successfully saved.</p>";
	    $resultMessage .= "<p>";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$gamesActionContainerId').html('');$('#$gamesActionLineContainerId').hide();\">Close</a>";
	    $resultMessage .= "</p>";

	    $resultMessage .= "<script>";
	    $resultMessage .= "$('#$editCommandContainer').hide();";
	    $resultMessage .= "$('#$stageContainer').html(\"stage\");";
	    $resultMessage .= "$('#$team1Container').html(\"team1\");";
	    $resultMessage .= "$('#$team2Container').html(\"team2\");";
	    $resultMessage .= "$('#$venueContainer').html(\"venue\");";
	    $resultMessage .= "$('#$t1ScoreContainer').html(\"t1Score\");";
	    $resultMessage .= "$('#$t2ScoreContainer').html(\"t2Score\");";
	    $resultMessage .= "$('#$extraScoreContainer').html(\"extraScore\");";
	    $resultMessage .= "$('#$timeStartedContainer').html(\"timeStarted\");";
	    $resultMessage .= "$('#$startedFContainer').html(\"startedF\");";
	    $resultMessage .= "$('#$playerInfoContainer').html(\"playerInfo\");";
	    $resultMessage .= "$('#$matchDateContainer').html(\"matchDate\");";
	    $resultMessage .= "</script>";

	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
	}

	return $output;
    }

    public static function getDeleteGames($id)
    {
	$output = "";

	$gamesActionLineContainerId = "games_action_line_con_".$id;
	$gamesActionContainerId = "games_action_con_".$id;
	$gamesDeleteActionContainerId = "games_delete_con_".$id;

	$output .= "<div class='well'>";

	$output .= "<table class='form_table'>";

	$output .= "<tr>";
	$output .= "<td>Do you really want to delete this Games ?</td>";
	$output .= "</tr>";

	$output .= "<tr>";
	$output .= "<td id='$gamesDeleteActionContainerId'></td>";
	$output .= "</tr>";

	$output .= "<tr>";
	$output .= "<td>";
	$output .= "<button class='btn btn-primary' type='button' onclick=\"deleteGames('$id');\">Delete</button>";
	$output .= "&nbsp;";
	$output .= "<button class='btn' type='button' onclick=\"$('#$gamesActionContainerId').html('');$('#$gamesActionLineContainerId').hide();\">Cancel</button>";
	$output .= "</td>";
	$output .= "</tr>";

	$output .= "</table>";

	$output .= "</div>";

	return $output;
    }

    public static function deleteGames($id)
    {
	$output = "";

	GamesManager::editGames($id);

	$gamesLineContainerId = "games_line_con_".$id;
	$gamesActionLineContainerId = "games_action_line_con_".$id;

	$output .= "<script>";
	$output .= "$('#$gamesLineContainerId').hide();";
	$output .= "$('#$gamesActionLineContainerId').hide();";
	$output .= "<\script>";

	return $output;
    }

    public static function getGamesCombo($comboId = "cbo_games", $selectedValue = "", $onclickAction = "")
    {
	$output = "";

	$gamesList = BaseGamesLogicUtility::getGamesList();

	$output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

	for($i = 0; $i < count($gamesList); $i++)
	{
	    $id = $gamesList[$i]->getId();

	    $selected = "";

	    if($selectedValue == $id)
	    {
		$selected = "selected";
	    }

	    $output .= "<option selected='$selected' value='$id'>$id</option>";
	}

	$output .= "</select>";

	return $output;
    }
}

?>
