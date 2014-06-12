<?php


class PlayerScoreActionGuiUtility extends BasePlayerScoreActionGuiUtility
{

    public static function getPlayerScoreAction($playerId, $gameId)
    {
	$playerEntity = PlayersLogicUtility::getPlayersDetails($playerId);

	$headerContent = "";
	$content = "";
	$footerContent = "";

	if($playerEntity)
	{
	    $dateUtility = DateUtilityHelper::getDateUtility();
	    $currentDate = $dateUtility->getCurrentUserMysqlDateTime();

	    $headerContent = $playerEntity->getFormattedName()." scores";
	    $footerContent = "<button id='btn_action_button' class='btn btn-primary' onclick=\"adminPlayerScoreAction('$playerId', '$gameId');\">Confirm Player Score Action</button>";

	    $content .= "<form role='form' class='form-horizontal'>";

	    $content .= "<div class='form-group'>";
	    $content .= "<label class='col-sm-2 control-label' for='txt_player_score_date'>Date</label>";
	    $content .= "<div class='col-sm-10'>";
	    $content .= "<input class='form-control' type='text' id='txt_player_score_date' name='txt_player_score_date' placeholder='Action Date' value=\"$currentDate\" />";
	    $content .= "</div>";
	    $content .= "</div>";

	    $content .= "<div class='form-group' id='player_action_con'>";
	    $content .= "</div>";

	    $content .= "</form>";
	}
	else
	{
	    $headerContent = "Player Scores";
	    $content = Error::getObjectDetailsError("Player");
	}

	return BootstrapModalGuiUtility::getModalContent($headerContent, $content, $footerContent);
    }

    public static function adminPlayerScoreAction($playerId, $gameId, $actionDate, $adminId)
    {
	$output = "";

	$error = PlayerScoreActionManager::addPlayerScoreAction($gameId, $actionDate, $playerId, $adminId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay("Score action saved for player");

	    $output .= "<script>";
	    $output .= "$('#btn_action_button').hide();";
	    $output .= "reloadMatchEngageDisplay('$gameId');";
	    $output .= "</script>";
	}

	return $output;
    }
}

?>
