<?php

class BaseRedCardActionValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddRedCardAction($fkGameActionId, $fkPlayerId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkPlayerId, "Fk Player Id", BaseRedCardActionLogicUtility::$FK_PLAYER_ID_LIMIT);


        return $this->error;
    }

    public function validateEditRedCardAction($fkGameActionId, $fkPlayerId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkPlayerId, "Fk Player Id", BaseRedCardActionLogicUtility::$FK_PLAYER_ID_LIMIT);


        return $this->error;
    }
}

?>
