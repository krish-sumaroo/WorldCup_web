<?php


class TeamActionManager
{

    public static function addTeamAction($gameId, $actionDate, $team1Score, $team2Score, $adminId = "", $userId = "")
    {
	$error = new Error();

	$dateUtility = DateUtilityHelper::getDateUtility();

	$actionAutomaticDate = $dateUtility->getCurrentGMTMysqlDateTime();
	$formattedActionDate = "$actionDate:00";
	$adjustedActionDate = $dateUtility->getGmtAdjustedTime($formattedActionDate, SessionHelper::getTimeOffset() * 60);
	$actionType = GameActionLogicUtility::$ACTION_TYPE_TEAM_ACTION;

	$teamActionEntity = TeamActionLogicUtility::getTeamActionDetailsByGameId($gameId);

	if($teamActionEntity)
	{
	    $gameActionId = $teamActionEntity->getFkGameActionId();
	    TeamActionLogicUtility::updateTeamAction($gameActionId, $team1Score, $team2Score);
	    GamesLogicUtility::updateT1Score($gameId, $team1Score);
	    GamesLogicUtility::updateT2Score($gameId, $team2Score);
	}
	else
	{
	    $gameActionId = GameActionLogicUtility::addGameAction($gameId, "", $adjustedActionDate, $actionAutomaticDate,
			    $actionType);
	    TeamActionLogicUtility::addTeamAction($gameActionId, $team1Score, $team2Score);
	    GamesLogicUtility::updateT1Score($gameId, $team1Score);
	    GamesLogicUtility::updateT2Score($gameId, $team2Score);

	    if($adminId != "")
	    {
		AdminGameActionLogicUtility::addAdminGameAction($gameActionId, $adminId);
	    }
	    elseif($userId != "")
	    {
		UserGameActionLogicUtility::addUserGameAction($gameActionId, $userId);
	    }
	}

	return $error;
    }

    public static function editTeamAction($fkGameActionId, $fkTeamId, $teamActionType)
    {
	$teamActionValidator = new BaseTeamActionValidator();

	$error = $teamActionValidator->validateEditTeamAction($fkGameActionId, $fkTeamId, $teamActionType);

	if(!$error->errorExists())
	{
	    TeamActionLogicUtility::updateTeamAction($fkGameActionId, $fkTeamId, $teamActionType);
	}

	return $error;
    }

    public static function deleteTeamAction($fkGameActionId)
    {
	TeamActionLogicUtility::deleteTeamAction($fkGameActionId);
    }
}

?>
