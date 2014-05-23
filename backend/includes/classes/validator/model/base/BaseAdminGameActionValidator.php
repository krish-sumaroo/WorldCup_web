<?php

class BaseAdminGameActionValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddAdminGameAction($fkGameActionId, $fkAdminId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->checkEmptyError($fkAdminId, "Fk Admin Id");
        $this->validateLength($fkAdminId, "Fk Admin Id", BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_LIMIT);


        return $this->error;
    }

    public function validateEditAdminGameAction($fkGameActionId, $fkAdminId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->checkEmptyError($fkAdminId, "Fk Admin Id");
        $this->validateLength($fkAdminId, "Fk Admin Id", BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_LIMIT);


        return $this->error;
    }
}

?>
