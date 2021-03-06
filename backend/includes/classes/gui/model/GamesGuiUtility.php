<?php


class GamesGuiUtility extends BaseGamesGuiUtility
{

    public static function getGamesListDisplay()
    {
	$output = "";

	$sortQuery = new SortQuery();
	$sortQuery->addSort(GamesLogicUtility::$MATCHDATE_FIELD, SortQuery::$DESCENDING);

	$gamesEntityList = GamesLogicUtility::getGamesList($sortQuery, GamesLogicUtility::$NOT_STARTED_STATUS);

	if(count($gamesEntityList) > 0)
	{
	    $output .= "<table class='table'>";

	    $output .= "<thead>";
	    $output .= "<tr>";
	    $output .= "<th>Match Date</th>";
	    $output .= "<th>Match</th>";
	    $output .= "<th>Action</th>";
	    $output .= "</tr>";
	    $output .= "</thead>";

	    $output .= "<tbody>";

	    for($i = 0; $i < count($gamesEntityList); $i++)
	    {
		$gamesId = $gamesEntityList[$i]->getId();
		$matchEngageUrl = UrlConfiguration::getUrl("games", "engage", "id=".$gamesId);

		$output .= "<tr>";
		$output .= "<td>".$gamesEntityList[$i]->getMatchDate()."</td>";
		$output .= "<td>";
		$output .= $gamesEntityList[$i]->getVsDisplay();
		$output .= "&nbsp;";
		$output .= $gamesEntityList[$i]->getScoreDisplay();
		$output .= "</td>";
		$output .= "<td>";
		$output .= "<a class='btn btn-primary' href='$matchEngageUrl'>Engage</a>";
		$output .= "</td>";
		$output .= "</tr>";
	    }

	    $output .= "</tbody>";

	    $output .= "</table>";
	}
	else
	{
	    $output .= ResultUpdateGuiUtility::getBootstrapInfoDisplay("There are no games present in the system");
	}

	return $output;
    }

    public static function getEngageDisplay($gamesId)
    {
	$output = "";

	$gamesEntity = GamesLogicUtility::getGamesDetails($gamesId);
	$gamePlayersTeam1EntityList = $gamesEntity->getPlayersTeam1EntityList();
	$gamePlayersTeam2EntityList = $gamesEntity->getPlayersTeam2EntityList();

	if(SessionHelper::isAdminCreator())
	{
	    $output .= "<div class='row'>";
	    $output .= GamesGuiUtility::getTeamActionDisplay($gamesEntity, $gamesEntity->getTeam1Entity()->getName(),
			    $gamePlayersTeam1EntityList);
	    $output .= GamesGuiUtility::getTeamActionDisplay($gamesEntity, $gamesEntity->getTeam2Entity()->getName(),
			    $gamePlayersTeam2EntityList);
	    $output .= "</div>";
	}

	$output .= "<div class='row'>";
	$output .= GamesGuiUtility::getMatchActionsListDisplay($gamesId);
	$output .= "</div>";

	return $output;
    }

    private static function getMatchActionsListDisplay($gamesId)
    {
	$output = "";
	$title = "";

	$output .= "<div id='con_match_actions_list'>";
	$output .= GamesGuiUtility::reloadMatchActionListDisplay($gamesId);
	$output .= "</div>";

	$title .= "<div id='game_action_general_action_con'>";
	$title .= GamesGuiUtility::reloadMatchActionsButtonDisplay($gamesId);
	$title .= "</div>";

	$backendWidgetDisplayUtility = new BackendWidgetDisplayUtility(12, $title, $output);

	return $backendWidgetDisplayUtility->getDisplay();
    }

    public static function reloadMatchActionsButtonDisplay($gamesId)
    {
	$output = "";

	$teamActionEntity = TeamActionLogicUtility::getAdminGameActionProcessStatus($gamesId);

	$output .= "<span class='glyphicon glyphicon-plus'></span> Game Actions List";
	$output .= "&nbsp;&nbsp;";
	$output .= "<a href='javascript:void(0);' onclick=\"reloadMatchEngageDisplay('$gamesId')\" class='btn btn-primary'>Reload</a>";
	$output .= "&nbsp;&nbsp;";
	$output .= BootstrapModalGuiUtility::getAction("End Match", "getEndGame('$gamesId');");
	$output .= "&nbsp;&nbsp;";

	if($teamActionEntity)
	{
	    $gameActionId = $teamActionEntity->getFkGameActionId();

	    if($teamActionEntity)
	    {
		$adminGameActionEntity = $teamActionEntity->getAdminGameActionEntity();

		if($adminGameActionEntity->isProcessNotStarted())
		{
		    $output .= "<a href='javascript:void(0);' onclick=\"triggerMatchAward('$gameActionId', '$gamesId')\" class='btn btn-warning'>Trigger Match Score Action Points</a>";
		}
		elseif($adminGameActionEntity->isProcessFinished())
		{
		    $output .= "Match score points have already been awarded to users";
		}
		elseif($adminGameActionEntity->isProcessStarted())
		{
		    $output .= "Match score points process has already started";
		}
	    }
	}

	return $output;
    }

    public static function reloadMatchActionListDisplay($gamesId)
    {
	$output = "";

	$sortQuery = new SortQuery();
	$sortQuery->addSort(GameActionLogicUtility::$ACTION_DATE_FIELD, SortQuery::$DESCENDING);

	$adminGameActionEntityList = AdminGameActionLogicUtility::getGameActionList($gamesId, $sortQuery);

	for($i = 0; $i < count($adminGameActionEntityList); $i++)
	{
	    $output .= "<div class='well'>";
	    $output .= $adminGameActionEntityList[$i]->getLineDisplay($gamesId);
	    $output .= "</div>";
	}

	return $output;
    }

    private static function getTeamActionDisplay(GamesEntity $gamesEntity, $teamName, $gamePlayersEntityList)
    {
	$output = "";

	$output .= GamesGuiUtility::getPlayerListAction($gamePlayersEntityList, $gamesEntity->getId());

	$title = "<span class='glyphicon glyphicon-plus'></span> $teamName";

	$backendWidgetDisplayUtility = new BackendWidgetDisplayUtility(6, $title, $output);

	return $backendWidgetDisplayUtility->getDisplay();
    }

    private static function getPlayerListAction($gamePlayersEntityList, $gameId)
    {
	$output = "";

	$output .= "<div class='col-md-12'>";
	$output .= "<table class='table'>";

	$output .= "<thead>";
	$output .= "<tr>";
	$output .= "<th>Player</th>";
	$output .= "<th>Action</th>";
	$output .= "</tr>";
	$output .= "</thead>";

	$output .= "<tbody>";

	$yellowCardImage = UrlConfiguration::getImageSrc("yellow_card.png", "application");
	$redCardImage = UrlConfiguration::getImageSrc("red_card.png", "application");
	$scoreCardImage = UrlConfiguration::getImageSrc("score.png", "application");
	$substituteImage = UrlConfiguration::getImageSrc("substitute.png", "application");

	$yellowCardImgTag = "<img src='$yellowCardImage' alt='Yellow Card' class='en4 img-responsive' />";
	$redCardImgTag = "<img src='$redCardImage' alt='Red Card' class='en4 img-responsive' />";
	$scoreImgTag = "<img src='$scoreCardImage' alt='Player Scores' class='en4 img-responsive' />";
	$substituteImgTag = "<img src='$substituteImage' alt='Player Scores' class='en4 img-responsive' />";

	for($i = 0; $i < count($gamePlayersEntityList); $i++)
	{
	    $playerEntity = $gamePlayersEntityList[$i];
	    $playerName = $playerEntity->getFormattedName();
	    $playerId = $playerEntity->getId();

	    $output .= "<tr>";
	    $output .= "<td>$playerName</td>";
	    $output .= "<td>";
	    $output .= "<div class='btn-group'>";
	    $output .= BootstrapModalGuiUtility::getAction($yellowCardImgTag, "getYellowCardAction('$playerId', '$gameId');",
			    "", true, "Yellow Card");
	    $output .= BootstrapModalGuiUtility::getAction($redCardImgTag, "getRedCardAction('$playerId', '$gameId');", "",
			    true, "Red Card");
	    $output .= BootstrapModalGuiUtility::getAction($scoreImgTag, "getPlayerScoreAction('$playerId', '$gameId');", "",
			    true, "Player Scores");
	    $output .= BootstrapModalGuiUtility::getAction($substituteImgTag,
			    "getPlayerSubstituteAction('$playerId', '$gameId');", "", true, "Substitute Player");
	    $output .= "</div>";
	    $output .= "</td>";
	    $output .= "</tr>";
	}

	$output .= "</tbody>";

	$output .= "</table>";
	$output .= "</div>";

	return $output;
    }

    public static function getEndGame($gameId)
    {
	$headerContent = "";
	$content = "";
	$footerContent = "";

	$gamesEntity = GamesLogicUtility::getGamesDetails($gameId);

	if($gamesEntity)
	{
	    $dateUtility = DateUtilityHelper::getDateUtility();
	    $currentDate = $dateUtility->getCurrentUserMysqlDateTime();

	    $team1Score = $gamesEntity->getT1Score();
	    $team2Score = $gamesEntity->getT2Score();

	    $headerContent = "Enter Final Score for ".$gamesEntity->getVsDisplay();
	    $footerContent = "<button id='btn_action_button' class='btn btn-primary' onclick=\"endGame('$gameId');\">Confirm Game Score</button>";

	    $content .= "<form role='form' class='form-horizontal'>";

	    $content .= "<div class='form-group'>";
	    $content .= "<label class='col-sm-2 control-label' for='txt_game_end_date'>Game Finish Date/Time</label>";
	    $content .= "<div class='col-sm-10'>";
	    $content .= "<input class='form-control' type='text' id='txt_game_end_date' name='txt_game_end_date' placeholder='Date' value=\"$currentDate\" />";
	    $content .= "</div>";
	    $content .= "</div>";

	    $content .= "<div class='form-group'>";
	    $content .= "<label class='col-sm-2 control-label' for='txt_team1_score'>".$gamesEntity->getTeam1Entity()->getName()."</label>";
	    $content .= "<div class='col-sm-10'>";
	    $content .= "<input class='form-control' type='text' id='txt_team1_score' name='txt_team1_score' placeholder='Team Score' value=\"$team1Score\" />";
	    $content .= "</div>";
	    $content .= "</div>";

	    $content .= "<div class='form-group'>";
	    $content .= "<label class='col-sm-2 control-label' for='txt_team2_score'>".$gamesEntity->getTeam2Entity()->getName()."</label>";
	    $content .= "<div class='col-sm-10'>";
	    $content .= "<input class='form-control' type='text' id='txt_team2_score' name='txt_team2_score' placeholder='Team Score' value=\"$team2Score\" />";
	    $content .= "</div>";
	    $content .= "</div>";

	    $content .= "<div class='form-group' id='player_action_con'>";
	    $content .= "</div>";

	    $content .= "</form>";
	}

	return BootstrapModalGuiUtility::getModalContent($headerContent, $content, $footerContent);
    }

    public static function endGame($gamesId, $date, $team1Score, $team2Score, $adminId)
    {
	$output = "";

	$error = TeamActionManager::addTeamAction($gamesId, $date, $team1Score, $team2Score, $adminId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay("Match Score saved");

	    $output .= "<script>";
	    $output .= "$('#btn_action_button').hide();";
	    $output .= "reloadMatchActionButtonContainer('$gamesId');";
	    $output .= "</script>";
	}

	return $output;
    }
}

?>

