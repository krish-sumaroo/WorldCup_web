<?php

class PlayerScoreActionManager
{
    public static function addPlayerScoreAction($fkGameActionId, $fkPlayerId)
    {
        $playerScoreActionValidator = new BasePlayerScoreActionValidator();

        $error = $playerScoreActionValidator->validateAddPlayerScoreAction($fkGameActionId, $fkPlayerId);

        if(!$error->errorExists())
        {
            PlayerScoreActionLogicUtility::addPlayerScoreAction($fkGameActionId, $fkPlayerId);
        }

        return $error;
    }

    public static function editPlayerScoreAction($fkGameActionId, $fkPlayerId)
    {
        $playerScoreActionValidator = new BasePlayerScoreActionValidator();

        $error = $playerScoreActionValidator->validateEditPlayerScoreAction($fkGameActionId, $fkPlayerId);

        if(!$error->errorExists())
        {
            PlayerScoreActionLogicUtility::updatePlayerScoreAction($fkGameActionId, $fkPlayerId);
        }

        return $error;
    }

    public static function deletePlayerScoreAction($fkGameActionId)
    {
        PlayerScoreActionLogicUtility::deletePlayerScoreAction($fkGameActionId);
    }
}

?>
