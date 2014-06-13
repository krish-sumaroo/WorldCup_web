<?php


class UserActionProcessManager
{

    public static function processUserAction($gameActionId = "")
    {
	$sortQuery = new SortQuery();
	$sortQuery->addSort(GameActionLogicUtility::$ACTION_DATE_FIELD, SortQuery::$ASCENDING);

	$dateUtility = DateUtilityHelper::getDateUtility();
	$currentMySqlDate = $dateUtility->getCurrentGMTMysqlDateTime();

	$adminGameActionEntityList = AdminGameActionLogicUtility::getValidatedGameAction($currentMySqlDate,
			GameProcessConfiguration::$GAME_PROCESS_LIMIT, AdminGameActionLogicUtility::$PROCESS_STATUS_NOT_STARTED, $sortQuery,
			"", $gameActionId);

	Log::debug("gameActionId : $gameActionId"); //debug
	Log::debugArray($adminGameActionEntityList); //debug

	if(count($adminGameActionEntityList) > 0)
	{
	    $adminGameActionIdArray = UserActionProcessManager::getAdminGameIdArray($adminGameActionEntityList);

	    AdminGameActionLogicUtility::updateIdArrayToStarted($adminGameActionIdArray);

	    for($i = 0; $i < count($adminGameActionEntityList); $i++)
	    {
		$values = $adminGameActionEntityList[$i]->getValues();
		$gameId = $adminGameActionEntityList[$i]->getGameActionEntity()->getFkGameId();
		$actionType = $adminGameActionEntityList[$i]->getGameActionEntity()->getActionType();
		$actionDate = $adminGameActionEntityList[$i]->getGameActionEntity()->getActionDate();

		$playerId = "";
		$actionId = "";

		if($actionType == GameActionLogicUtility::$ACTION_TYPE_RED_CARD)
		{
		    $playerId = $values[AdminGameActionLogicUtility::$PLAYER_ID_RED_CARD_ALIAS];
		    $actionId = UserPlayerActionLogicUtility::$RED_CARD_ACTION_ID;
		}
		elseif($actionType == GameActionLogicUtility::$ACTION_TYPE_YELLOW_CARD)
		{
		    $playerId = $values[AdminGameActionLogicUtility::$PLAYER_ID_YELLOW_CARD_ALIAS];
		    $actionId = UserPlayerActionLogicUtility::$YELLOW_CARD_ACTION_ID;
		}
		elseif($actionType == GameActionLogicUtility::$ACTION_TYPE_PLAYER_SCORE)
		{
		    $playerId = $values[AdminGameActionLogicUtility::$PLAYER_ID_PLAYER_SCORE_ALIAS];
		    $actionId = UserPlayerActionLogicUtility::$SCORE_GOAL_ACTION_ID;
		}
		elseif($actionType == GameActionLogicUtility::$ACTION_TYPE_PLAYER_SUBSTITUTE)
		{
		    $playerId = $values[AdminGameActionLogicUtility::$PLAYER_ID_PLAYER_SCORE_ALIAS];
		    $actionId = UserPlayerActionLogicUtility::$GETS_SUBSTITUTED_ACTION_ID;
		}

		Log::debug("playerId : $playerId"); //debug
		Log::debug("actionId : $actionId"); //debug

		UserPlayerActionLogicUtility::updateSuccess($playerId, $actionId, $actionDate, $gameId);
		UserPlayerActionLogicUtility::updateFailure($playerId, $actionId, $actionDate, $gameId);
	    }

	    AdminGameActionLogicUtility::updateIdArrayToFinished($adminGameActionIdArray);
	}
    }

    private static function getAdminGameIdArray($adminGameActionEntityList)
    {
	$idArray = array();

	for($i = 0; $i < count($adminGameActionEntityList); $i++)
	{
	    $idArray[$i] = $adminGameActionEntityList[$i]->getFkGameActionId();
	}

	return $idArray;
    }

    public static function processSpecificAction($gameActionId, $gameId)
    {
	$error = new Error();

	$gameActionEntity = GameActionLogicUtility::getActionDate($gameActionId);

	if($gameActionEntity)
	{
	    $actionAutomaticDate = $gameActionEntity->getActionDate();

	    $numberOfValidatedActionsBefore = GameActionLogicUtility::getNumberOfValidatedActionsBefore($actionAutomaticDate,
			    $gameId);

	    if($numberOfValidatedActionsBefore > 0)
	    {
		$error->addError("There are other actions for which rewards have not yet been awarded. We strongly recommend you to award the other rewards first.");
	    }
	    else
	    {
		UserActionProcessManager::processUserAction($gameActionId);
	    }
	}

	return $error;
    }

    public static function processSpecificMatchAction($gameActionId, $gameId)
    {
	$sortQuery = new SortQuery();
	$sortQuery->addSort(GameActionLogicUtility::$ACTION_DATE_FIELD, SortQuery::$ASCENDING);

	$adminGameActionEntityList = AdminGameActionLogicUtility::getValidatedTeamAction("",
			AdminGameActionLogicUtility::$PROCESS_STATUS_NOT_STARTED, $sortQuery,
			GameActionLogicUtility::$ACTION_TYPE_TEAM_ACTION, $gameActionId);

	if(count($adminGameActionEntityList) > 0)
	{
	    $adminGameActionIdArray = UserActionProcessManager::getAdminGameIdArray($adminGameActionEntityList);

	    AdminGameActionLogicUtility::updateIdArrayToStarted($adminGameActionIdArray);

	    for($i = 0; $i < count($adminGameActionEntityList); $i++)
	    {
		$values = $adminGameActionEntityList[$i]->getValues();
		$gameId = $adminGameActionEntityList[$i]->getGameActionEntity()->getFkGameId();
		$actionType = $adminGameActionEntityList[$i]->getGameActionEntity()->getActionType();
		$actionDate = $adminGameActionEntityList[$i]->getGameActionEntity()->getActionDate();
		$team1Score = $adminGameActionEntityList[$i]->getTeamActionEntity()->getTeam1Score();
		$team2Score = $adminGameActionEntityList[$i]->getTeamActionEntity()->getTeam2Score();

		UserScoreActionLogicUtility::updateSuccess($actionDate, $gameId, $team1Score, $team2Score);
		UserScoreActionLogicUtility::updateFailure($actionDate, $gameId, $team1Score, $team2Score);
	    }

	    AdminGameActionLogicUtility::updateIdArrayToFinished($adminGameActionIdArray);
	}
    }
}

?>