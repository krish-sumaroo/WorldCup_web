<?php

class BaseGamesPlayersValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddGamesPlayers($gameId, $playerId, $teamId)
    {
        $this->validateLength($gameId, "GameId", BaseGamesPlayersLogicUtility::$GAMEID_LIMIT);

        $this->validateLength($playerId, "PlayerId", BaseGamesPlayersLogicUtility::$PLAYERID_LIMIT);

        $this->validateLength($teamId, "TeamId", BaseGamesPlayersLogicUtility::$TEAMID_LIMIT);


        return $this->error;
    }

    public function validateEditGamesPlayers($gameId, $playerId, $teamId)
    {
        $this->validateLength($gameId, "GameId", BaseGamesPlayersLogicUtility::$GAMEID_LIMIT);

        $this->validateLength($playerId, "PlayerId", BaseGamesPlayersLogicUtility::$PLAYERID_LIMIT);

        $this->validateLength($teamId, "TeamId", BaseGamesPlayersLogicUtility::$TEAMID_LIMIT);


        return $this->error;
    }
}

?>
