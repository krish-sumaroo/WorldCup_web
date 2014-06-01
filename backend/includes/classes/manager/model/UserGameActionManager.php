<?php


class UserGameActionManager
{

    public static function createGameAction($username, $uid, $actionType, $gameId, $playerId, $teamId)
    {
	$error = new Error();

	$loginError = UsersManager::checkUserLoginDetails($username, $uid);

	if($loginError->errorExists())
	{
	    $error->merge($loginError);
	}
	else
	{
	    $dateUtility = DateUtilityHelper::getDateUtility();

	    $usersEntity = $loginError->getObject();
	    $userId = $usersEntity->getId();

	    $actionDate = $dateUtility->getCurrentGMTMysqlDateTime();

	    if($actionType == GameActionLogicUtility::$ACTION_TYPE_PLAYER_SCORE)
	    {
		PlayerScoreActionManager::addPlayerScoreAction($gameId, $actionDate, $playerId, "", $userId);
	    }
	    elseif($actionType == GameActionLogicUtility::$ACTION_TYPE_RED_CARD)
	    {
		RedCardActionManager::addRedCardAction($gameId, $actionDate, $playerId, "", $userId);
	    }
	    elseif($actionType == GameActionLogicUtility::$ACTION_TYPE_YELLOW_CARD)
	    {
		YellowCardActionManager::addYellowCardAction($gameId, $actionDate, $playerId, "", $userId);
	    }
	    elseif($actionType == GameActionLogicUtility::$ACTION_TYPE_TEAM_ACTION)
	    {

	    }
	}

	return $error;
    }

    public static function addUserGameAction($fkGameActionId, $fkUserId)
    {
	$userGameActionValidator = new BaseUserGameActionValidator();

	$error = $userGameActionValidator->validateAddUserGameAction($fkGameActionId, $fkUserId);

	if(!$error->errorExists())
	{
	    UserGameActionLogicUtility::addUserGameAction($fkGameActionId, $fkUserId);
	}

	return $error;
    }

    public static function editUserGameAction($fkGameActionId, $fkUserId)
    {
	$userGameActionValidator = new BaseUserGameActionValidator();

	$error = $userGameActionValidator->validateEditUserGameAction($fkGameActionId, $fkUserId);

	if(!$error->errorExists())
	{
	    UserGameActionLogicUtility::updateUserGameAction($fkGameActionId, $fkUserId);
	}

	return $error;
    }

    public static function deleteUserGameAction($fkGameActionId, $fkUserId)
    {
	UserGameActionLogicUtility::deleteUserGameAction($fkGameActionId, $fkUserId);
    }
}

?>
