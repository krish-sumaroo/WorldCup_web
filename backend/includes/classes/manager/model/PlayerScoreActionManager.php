<?php


class PlayerScoreActionManager
{

    public static function addPlayerScoreAction($gameId, $actionDate, $playerId, $adminId = "", $userId = "")
    {
	$error = new Error();

	$dateUtility = DateUtilityHelper::getDateUtility();

	$actionAutomaticDate = $dateUtility->getCurrentGMTMysqlDateTime();
	$formattedActionDate = "$actionDate:00";
	$adjustedActionDate = $dateUtility->getGmtAdjustedTime($formattedActionDate, SessionHelper::getTimeOffset() * 60);
	$actionType = GameActionLogicUtility::$ACTION_TYPE_PLAYER_SCORE;

	$gameActionId = GameActionLogicUtility::addGameAction($gameId, "", $adjustedActionDate, $actionAutomaticDate,
			$actionType);
	PlayerScoreActionLogicUtility::addPlayerScoreAction($gameActionId, $playerId);

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

    public static function editPlayerScoreAction($fkGameActionId, $fkPlayerId)
    {
	$playerScoreActionValidator = new BasePlayerScoreActionValidator();

	$error = $playerScoreActionValidator->validateEditPlayerScoreAction($fkGameActionId, $fkPlayerId);

	if(!$error->errorExists())
	{
	    PlayerScoreActionLogicUtility::updatePlayerScoreAction($fkGameActionId, $fkPlayerId);
	}

	return $error;
    }

    public static function deletePlayerScoreAction($fkGameActionId)
    {
	PlayerScoreActionLogicUtility::deletePlayerScoreAction($fkGameActionId);
    }
}

?>
