<?php


class UserActionProcessGuiUtility
{

    public static function triggerAwards($gameActionId, $gameId)
    {
	$output = "";

	$error = UserActionProcessManager::processSpecificAction($gameActionId, $gameId);

	if($error->errorExists())
	{
	    $errorDisplay = $error->getFirstErrorDisplay();

	    $output .= "<script>";
	    $output .= "confirmTriggerRewards('$gameActionId', \"$errorDisplay\");";
	    $output .= "</script>";
	}
	else
	{
	    $output .= AdminGameActionLineEntity::getInvalidateActionButton($gameActionId, $gameId);
	    $output .= "&nbsp;&nbsp;";
	    $output .= ResultUpdateGuiUtility::getResultDisplay("Awards have been processed", "", false);
	    $output .= UserActionProcessGuiUtility::getTriggerNotificationDisplay($gameActionId);
	}

	return $output;
    }

    public static function confirmTriggerAwards($gameActionId)
    {
	$output = "";

	UserActionProcessManager::processUserAction($gameActionId);

	$output .= ResultUpdateGuiUtility::getResultDisplay("Awards have been processed");

	$output .= UserActionProcessGuiUtility::getTriggerNotificationDisplay($gameActionId);

	return $output;
    }

    private static function getTriggerNotificationDisplay($gameActionId)
    {
	$output = "";

	$gameActionEntity = GameActionLogicUtility::getGameActionDetails($gameActionId);

	if($gameActionEntity)
	{
	    $playerName = "";
	    $actionType = "";

	    if($gameActionEntity->isPlayerScoreAction())
	    {
		$playerName = $gameActionEntity->retrieveRedCardActionEntity()->retrievePlayerEntity()->getFormattedName();
		$actionType = "score";
	    }
	    elseif($gameActionEntity->isRedCardAction())
	    {
		$playerName = $gameActionEntity->retrievePlayerScoreCardActionEntity()->retrievePlayerEntity()->getFormattedName();
		$actionType = "red card";
	    }
	    elseif($gameActionEntity->isYellowCardAction())
	    {
		$playerName = $gameActionEntity->retrieveYellowCardActionEntity()->retrievePlayerEntity()->getFormattedName();
		$actionType = "yellow card";
	    }

	    $triggerActionContainer = "trigger_action_con_".$gameActionId;

	    $output .= "<div id='$triggerActionContainer'></div>";

	    $output .= "<script>";
	    $output .= "triggerNotifications($gameActionId, \"$playerName\", '$actionType');";
	    $output .= "</script>";
	}

	return $output;
    }

    public static function triggerMatchAwards($gameActionId, $gameId)
    {
	$output = "";

	UserActionProcessManager::processSpecificMatchAction($gameActionId, $gameId);

	$output .= "<script>";
	$output .= "reloadMatchActionButtonContainer('$gameId');";
	$output .= "</script>";

	return $output;
    }
}

?>