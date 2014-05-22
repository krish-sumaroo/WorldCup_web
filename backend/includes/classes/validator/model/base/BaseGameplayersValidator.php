<?php

class BaseGameplayersValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddGameplayers($gameId, $playerId, $teamId)
    {
        $this->checkEmptyError($gameId, "GameId");
        $this->validateLength($gameId, "GameId", BaseGameplayersLogicUtility::$GAMEID_LIMIT);

        $this->checkEmptyError($playerId, "PlayerId");
        $this->validateLength($playerId, "PlayerId", BaseGameplayersLogicUtility::$PLAYERID_LIMIT);

        $this->checkEmptyError($teamId, "TeamId");
        $this->validateLength($teamId, "TeamId", BaseGameplayersLogicUtility::$TEAMID_LIMIT);


        return $this->error;
    }

    public function validateEditGameplayers($gameId, $playerId, $teamId)
    {
        $this->checkEmptyError($gameId, "GameId");
        $this->validateLength($gameId, "GameId", BaseGameplayersLogicUtility::$GAMEID_LIMIT);

        $this->checkEmptyError($playerId, "PlayerId");
        $this->validateLength($playerId, "PlayerId", BaseGameplayersLogicUtility::$PLAYERID_LIMIT);

        $this->checkEmptyError($teamId, "TeamId");
        $this->validateLength($teamId, "TeamId", BaseGameplayersLogicUtility::$TEAMID_LIMIT);


        return $this->error;
    }
}

?>
