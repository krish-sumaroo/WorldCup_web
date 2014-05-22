<?php

class BasePlayerScoreActionValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddPlayerScoreAction($fkGameActionId, $fkPlayerId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkPlayerId, "Fk Player Id", BasePlayerScoreActionLogicUtility::$FK_PLAYER_ID_LIMIT);


        return $this->error;
    }

    public function validateEditPlayerScoreAction($fkGameActionId, $fkPlayerId)
    {
        $this->checkEmptyError($fkGameActionId, "Fk Game Action Id");
        $this->validateLength($fkGameActionId, "Fk Game Action Id", BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_LIMIT);

        $this->validateLength($fkPlayerId, "Fk Player Id", BasePlayerScoreActionLogicUtility::$FK_PLAYER_ID_LIMIT);


        return $this->error;
    }
}

?>
