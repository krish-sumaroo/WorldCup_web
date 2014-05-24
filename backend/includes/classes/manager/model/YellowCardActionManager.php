<?php


class YellowCardActionManager
{

    public static function addYellowCardAction($gameId, $actionDate, $playerId, $adminId = "", $userId = "")
    {
	$error = new Error();

	$dateUtility = DateUtilityHelper::getDateUtility();

	$actionAutomaticDate = $dateUtility->getCurrentGMTMysqlDateTime();
	$formattedActionDate = "$actionDate:00";
	$adjustedActionDate = $dateUtility->getGmtAdjustedTime($formattedActionDate, SessionHelper::getTimeOffset() * 60);
	$actionType = GameActionLogicUtility::$ACTION_TYPE_YELLOW_CARD;

	$gameActionId = GameActionLogicUtility::addGameAction($gameId, "", $adjustedActionDate, $actionAutomaticDate,
			$actionType);
	YellowCardActionLogicUtility::addYellowCardAction($gameActionId, $playerId);

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

    public static function editYellowCardAction($fkGameActionId, $fkPlayerId)
    {
	$yellowCardActionValidator = new BaseYellowCardActionValidator();

	$error = $yellowCardActionValidator->validateEditYellowCardAction($fkGameActionId, $fkPlayerId);

	if(!$error->errorExists())
	{
	    YellowCardActionLogicUtility::updateYellowCardAction($fkGameActionId, $fkPlayerId);
	}

	return $error;
    }

    public static function deleteYellowCardAction($fkGameActionId)
    {
	YellowCardActionLogicUtility::deleteYellowCardAction($fkGameActionId);
    }
}

?>
