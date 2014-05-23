<?php


class RedCardActionManager
{

    public static function addRedCardAction($gameId, $actionDate, $playerId, $adminId = "", $userId = "")
    {
	$error = new Error();

	$dateUtility = DateUtilityHelper::getDateUtility();

	$actionAutomaticDate = $dateUtility->getCurrentGMTMysqlDateTime();
	$formattedActionDate = "$actionDate:00";
	$adjustedActionDate = $dateUtility->getGmtAdjustedTime($formattedActionDate, SessionHelper::getTimeOffset() * 60);
	$actionType = GameActionLogicUtility::$ACTION_TYPE_RED_CARD;

	$gameActionId = GameActionLogicUtility::addGameAction($gameId, "", $adjustedActionDate, $actionAutomaticDate,
			$actionType);
	RedCardActionLogicUtility::addRedCardAction($gameActionId, $playerId);

	if($adminId != "")
	{
	    AdminGameActionLogicUtility::addAdminGameAction($gameActionId, $adminId);
	}
	elseif($userId != "")
	{
	    UserGameActionLogicUtility::addUserGameAction($gameActionId, $userId);
	}

	return $error;
    }

    public static function editRedCardAction($fkGameActionId, $fkPlayerId)
    {
	$redCardActionValidator = new BaseRedCardActionValidator();

	$error = $redCardActionValidator->validateEditRedCardAction($fkGameActionId, $fkPlayerId);

	if(!$error->errorExists())
	{
	    RedCardActionLogicUtility::updateRedCardAction($fkGameActionId, $fkPlayerId);
	}

	return $error;
    }

    public static function deleteRedCardAction($fkGameActionId)
    {
	RedCardActionLogicUtility::deleteRedCardAction($fkGameActionId);
    }
}

?>
