<?php

class BaseTeamActionValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddTeamAction($fkGameActionId, $fkTeamId, $teamActionType)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkTeamId, "Fk Team Id", BaseTeamActionLogicUtility::$FK_TEAM_ID_LIMIT);


        return $this->error;
    }

    public function validateEditTeamAction($fkGameActionId, $fkTeamId, $teamActionType)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkTeamId, "Fk Team Id", BaseTeamActionLogicUtility::$FK_TEAM_ID_LIMIT);


        return $this->error;
    }
}

?>
