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
	}

	return $output;
    }

    public static function confirmTriggerAwards($gameActionId)
    {
	$output = "";

	UserActionProcessManager::processUserAction($gameActionId);

	$output .= ResultUpdateGuiUtility::getResultDisplay("Awards have been processed");

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