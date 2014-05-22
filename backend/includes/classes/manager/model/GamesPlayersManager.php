<?php

class GamesPlayersManager
{
    public static function addGamesPlayers($gameId, $playerId, $teamId)
    {
        $gamesPlayersValidator = new BaseGamesPlayersValidator();

        $error = $gamesPlayersValidator->validateAddGamesPlayers($gameId, $playerId, $teamId);

        if(!$error->errorExists())
        {
            GamesPlayersLogicUtility::addGamesPlayers($gameId, $playerId, $teamId);
        }

        return $error;
    }

    public static function editGamesPlayers($id, $gameId, $playerId, $teamId)
    {
        $gamesPlayersValidator = new BaseGamesPlayersValidator();

        $error = $gamesPlayersValidator->validateEditGamesPlayers($id, $gameId, $playerId, $teamId);

        if(!$error->errorExists())
        {
            GamesPlayersLogicUtility::updateGamesPlayers($id, $gameId, $playerId, $teamId);
        }

        return $error;
    }

    public static function deleteGamesPlayers($id)
    {
        GamesPlayersLogicUtility::deleteGamesPlayers($id);
    }
}

?>
