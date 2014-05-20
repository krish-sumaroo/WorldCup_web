<?php

class PlayersManager
{
    public static function addPlayers($teamId, $name, $position, $number)
    {
        $playersValidator = new BasePlayersValidator();

        $error = $playersValidator->validateAddPlayers($teamId, $name, $position, $number);

        if(!$error->errorExists())
        {
            PlayersLogicUtility::addPlayers($teamId, $name, $position, $number);
        }

        return $error;
    }

    public static function editPlayers($id, $teamId, $name, $position, $number)
    {
        $playersValidator = new BasePlayersValidator();

        $error = $playersValidator->validateEditPlayers($id, $teamId, $name, $position, $number);

        if(!$error->errorExists())
        {
            PlayersLogicUtility::updatePlayers($id, $teamId, $name, $position, $number);
        }

        return $error;
    }

    public static function deletePlayers($id)
    {
        PlayersLogicUtility::deletePlayers($id);
    }
}

?>
