<?php

class BaseUserGameActionValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddUserGameAction($fkGameActionId, $fkUserId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->checkEmptyError($fkUserId, "Fk User Id");
        $this->validateLength($fkUserId, "Fk User Id", BaseUserGameActionLogicUtility::$FK_USER_ID_LIMIT);


        return $this->error;
    }

    public function validateEditUserGameAction($fkGameActionId, $fkUserId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->checkEmptyError($fkUserId, "Fk User Id");
        $this->validateLength($fkUserId, "Fk User Id", BaseUserGameActionLogicUtility::$FK_USER_ID_LIMIT);


        return $this->error;
    }
}

?>
