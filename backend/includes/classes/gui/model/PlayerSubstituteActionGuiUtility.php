<?php


class PlayerSubstituteActionGuiUtility extends BasePlayerSubstituteActionGuiUtility
{

    public static function getPlayerSubstituteAction($playerId, $gameId)
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
	    $footerContent = "<button id='btn_action_button' class='btn btn-primary' onclick=\"adminPlayerSubstituteAction('$playerId', '$gameId');\">Confirm Player Substitute Action</button>";

	    $content .= "<form role='form' class='form-horizontal'>";

	    $content .= "<div class='form-group'>";
	    $content .= "<label class='col-sm-2 control-label' for='txt_player_substitute_date'>Date</label>";
	    $content .= "<div class='col-sm-10'>";
	    $content .= "<input class='form-control' type='text' id='txt_player_substitute_date' name='txt_player_substitute_date' placeholder='Action Date' value=\"$currentDate\" />";
	    $content .= "</div>";
	    $content .= "</div>";

	    $content .= "<div class='form-group' id='player_action_con'>";
	    $content .= "</div>";

	    $content .= "</form>";
	}
	else
	{
	    $headerContent = "Player is Substituted";
	    $content = Error::getObjectDetailsError("Player");
	}

	return BootstrapModalGuiUtility::getModalContent($headerContent, $content, $footerContent);
    }

    public static function adminPlayerSubstituteAction($playerId, $gameId, $actionDate, $adminId)
    {
	$output = "";

	$error = PlayerSubstituteActionManager::addPlayerSubstituteAction($gameId, $actionDate, $playerId, $adminId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay("Substitute action saved for player");

	    $output .= "<script>";
	    $output .= "$('#btn_action_button').hide();";
	    $output .= "reloadMatchEngageDisplay('$gameId');";
	    $output .= "</script>";
	}

	return $output;
    }
}

?>
