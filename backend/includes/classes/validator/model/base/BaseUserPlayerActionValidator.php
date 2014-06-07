<?php

class BaseUserPlayerActionValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddUserPlayerAction($playerId, $actionId, $userId, $timestamp, $gameId)
    {
        $this->validateLength($playerId, "PlayerId", BaseUserPlayerActionLogicUtility::$PLAYERID_LIMIT);

        $this->validateLength($actionId, "ActionId", BaseUserPlayerActionLogicUtility::$ACTIONID_LIMIT);

        $this->validateLength($userId, "UserId", BaseUserPlayerActionLogicUtility::$USERID_LIMIT);

        $this->checkEmptyError($timestamp, "Timestamp");
        $this->validateLength($gameId, "GameId", BaseUserPlayerActionLogicUtility::$GAMEID_LIMIT);


        return $this->error;
    }

    public function validateEditUserPlayerAction($playerId, $actionId, $userId, $timestamp, $gameId)
    {
        $this->validateLength($playerId, "PlayerId", BaseUserPlayerActionLogicUtility::$PLAYERID_LIMIT);

        $this->validateLength($actionId, "ActionId", BaseUserPlayerActionLogicUtility::$ACTIONID_LIMIT);

        $this->validateLength($userId, "UserId", BaseUserPlayerActionLogicUtility::$USERID_LIMIT);

        $this->checkEmptyError($timestamp, "Timestamp");
        $this->validateLength($gameId, "GameId", BaseUserPlayerActionLogicUtility::$GAMEID_LIMIT);


        return $this->error;
    }
}

?>
