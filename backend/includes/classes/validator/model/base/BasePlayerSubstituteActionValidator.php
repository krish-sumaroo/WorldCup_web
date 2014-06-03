<?php

class BasePlayerSubstituteActionValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddPlayerSubstituteAction($fkGameActionId, $fkPlayerId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkPlayerId, "Fk Player Id", BasePlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_LIMIT);


        return $this->error;
    }

    public function validateEditPlayerSubstituteAction($fkGameActionId, $fkPlayerId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkPlayerId, "Fk Player Id", BasePlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_LIMIT);


        return $this->error;
    }
}

?>
