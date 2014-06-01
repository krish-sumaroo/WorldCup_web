<?php


class AdminGameActionGuiUtility extends BaseAdminGameActionGuiUtility
{

    public static function validateAdminGameAction($adminGameActionId)
    {
	$output = "";

	$error = AdminGameActionManager::validateAdminGameAction($adminGameActionId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $output .= AdminGameActionLineEntity::getInvalidateActionButton($adminGameActionId);
	    $output .= "&nbsp;&nbsp;";
	    $output .= ResultUpdateGuiUtility::getResultDisplay("Action Saved", "", true, true);
	}

	return $output;
    }

    public static function invalidateAdminGameAction($adminGameActionId)
    {
	$output = "";

	$error = AdminGameActionManager::invalidateAdminGameAction($adminGameActionId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $output .= AdminGameActionLineEntity::getValidateActionButton($adminGameActionId);
	    $output .= "&nbsp;&nbsp;";
	    $output .= ResultUpdateGuiUtility::getResultDisplay("Action Saved", "", true, true);
	}

	return $output;
    }
}

?>
