<?php

class GameplayersManager
{
    public static function addGameplayers($gameId, $playerId, $teamId)
    {
        $gameplayersValidator = new BaseGameplayersValidator();

        $error = $gameplayersValidator->validateAddGameplayers($gameId, $playerId, $teamId);

        if(!$error->errorExists())
        {
            GameplayersLogicUtility::addGameplayers($gameId, $playerId, $teamId);
        }

        return $error;
    }

    public static function editGameplayers($gameId, $playerId, $teamId)
    {
        $gameplayersValidator = new BaseGameplayersValidator();

        $error = $gameplayersValidator->validateEditGameplayers($gameId, $playerId, $teamId);

        if(!$error->errorExists())
        {
            GameplayersLogicUtility::updateGameplayers($gameId, $playerId, $teamId);
        }

        return $error;
    }

    public static function deleteGameplayers()
    {
        GameplayersLogicUtility::deleteGameplayers();
    }
}

?>
