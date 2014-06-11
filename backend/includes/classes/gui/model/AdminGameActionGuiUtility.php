<?php


class AdminGameActionGuiUtility extends BaseAdminGameActionGuiUtility
{

    public static function validateAdminGameAction($adminGameActionId, $gameId)
    {
	$output = "";

	$error = AdminGameActionManager::validateAdminGameAction($adminGameActionId, $gameId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $output .= AdminGameActionLineEntity::getInvalidateActionButton($adminGameActionId, $gameId);
	    $output .= "&nbsp;&nbsp;";
	    $output .= ResultUpdateGuiUtility::getResultDisplay("Action Saved", "", true, true);
	}

	return $output;
    }

    public static function invalidateAdminGameAction($adminGameActionId, $gameId)
    {
	$output = "";

	$error = AdminGameActionManager::invalidateAdminGameAction($adminGameActionId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $output .= AdminGameActionLineEntity::getValidateActionButton($adminGameActionId, $gameId);
	    $output .= "&nbsp;&nbsp;";
	    $output .= ResultUpdateGuiUtility::getResultDisplay("Action Saved", "", true, true);
	}

	return $output;
    }
}

?>
