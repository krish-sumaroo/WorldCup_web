<?php

class TeamActionManager
{
    public static function addTeamAction($fkGameActionId, $fkTeamId, $teamActionType)
    {
        $teamActionValidator = new BaseTeamActionValidator();

        $error = $teamActionValidator->validateAddTeamAction($fkGameActionId, $fkTeamId, $teamActionType);

        if(!$error->errorExists())
        {
            TeamActionLogicUtility::addTeamAction($fkGameActionId, $fkTeamId, $teamActionType);
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
