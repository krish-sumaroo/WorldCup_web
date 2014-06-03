<?php


class PlayerSubstituteActionManager
{

    public static function addPlayerSubstituteAction($gameId, $actionDate, $playerId, $adminId = "", $userId = "")
    {
	$error = new Error();

	$dateUtility = DateUtilityHelper::getDateUtility();

	$actionAutomaticDate = $dateUtility->getCurrentGMTMysqlDateTime();
	$formattedActionDate = "$actionDate:00";
	$adjustedActionDate = $dateUtility->getGmtAdjustedTime($formattedActionDate, SessionHelper::getTimeOffset() * 60);
	$actionType = GameActionLogicUtility::$ACTION_TYPE_PLAYER_SUBSTITUTE;

	$gameActionId = GameActionLogicUtility::addGameAction($gameId, "", $adjustedActionDate, $actionAutomaticDate,
			$actionType);
	PlayerSubstituteActionLogicUtility::addPlayerSubstituteAction($gameActionId, $playerId);

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

    public static function editPlayerSubstituteAction($fkGameActionId, $fkPlayerId)
    {
	$playerSubstituteActionValidator = new BasePlayerSubstituteActionValidator();

	$error = $playerSubstituteActionValidator->validateEditPlayerSubstituteAction($fkGameActionId, $fkPlayerId);

	if(!$error->errorExists())
	{
	    PlayerSubstituteActionLogicUtility::updatePlayerSubstituteAction($fkGameActionId, $fkPlayerId);
	}

	return $error;
    }

    public static function deletePlayerSubstituteAction($fkGameActionId)
    {
	PlayerSubstituteActionLogicUtility::deletePlayerSubstituteAction($fkGameActionId);
    }
}

?>
