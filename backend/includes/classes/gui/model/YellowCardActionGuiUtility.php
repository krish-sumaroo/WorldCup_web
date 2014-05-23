<?php


class YellowCardActionGuiUtility extends BaseYellowCardActionGuiUtility
{

    public static function getYellowCardAction($playerId, $gameId)
    {
	$playerEntity = PlayersLogicUtility::getPlayersDetails($playerId);

	$headerContent = "";
	$content = "";
	$footerContent = "";

	if($playerEntity)
	{
	    $dateUtility = DateUtilityHelper::getDateUtility();
	    $currentDate = $dateUtility->getCurrentUserMysqlDateTime();

	    $headerContent = "Yellow card to ".$playerEntity->getFormattedName();
	    $footerContent = "<button id='btn_action_button' class='btn btn-primary' onclick=\"adminYellowCardAction('$playerId', '$gameId');\">Confirm Yellow Card Action</button>";

	    $content .= "<form role='form' class='form-horizontal'>";

	    $content .= "<div class='form-group'>";
	    $content .= "<label class='col-sm-2 control-label' for='txt_yellow_card_date'>Date</label>";
	    $content .= "<div class='col-sm-10'>";
	    $content .= "<input class='form-control' type='text' id='txt_yellow_card_date' name='txt_yellow_card_date' placeholder='Action Date' value=\"$currentDate\" />";
	    $content .= "</div>";
	    $content .= "</div>";

	    $content .= "<div class='form-group' id='player_action_con'>";
	    $content .= "</div>";

	    $content .= "</form>";
	}
	else
	{
	    $headerContent = "Yellow card";
	    $content = Error::getObjectDetailsError("Player");
	}

	return BootstrapModalGuiUtility::getModalContent($headerContent, $content, $footerContent);
    }

    public static function adminYellowCardAction($playerId, $gameId, $actionDate, $adminId)
    {
	$output = "";

	$error = YellowCardActionManager::addYellowCardAction($gameId, $actionDate, $playerId, $adminId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay("Yellow card saved for player");

	    $output .= "<script>";
	    $output .= "$('#btn_action_button').hide();";
	    $output .= "reloadMatchEngageDisplay('$gameId');";
	    $output .= "</script>";
	}

	return $output;
    }
}

?>
