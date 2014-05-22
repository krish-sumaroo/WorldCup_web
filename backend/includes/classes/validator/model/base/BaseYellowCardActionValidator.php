<?php

class BaseYellowCardActionValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddYellowCardAction($fkGameActionId, $fkPlayerId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkPlayerId, "Fk Player Id", BaseYellowCardActionLogicUtility::$FK_PLAYER_ID_LIMIT);


        return $this->error;
    }

    public function validateEditYellowCardAction($fkGameActionId, $fkPlayerId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkPlayerId, "Fk Player Id", BaseYellowCardActionLogicUtility::$FK_PLAYER_ID_LIMIT);


        return $this->error;
    }
}

?>
