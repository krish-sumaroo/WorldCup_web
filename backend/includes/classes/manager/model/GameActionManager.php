<?php

class GameActionManager
{
    public static function addGameAction($fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType)
    {
        $gameActionValidator = new BaseGameActionValidator();

        $error = $gameActionValidator->validateAddGameAction($fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType);

        if(!$error->errorExists())
        {
            GameActionLogicUtility::addGameAction($fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType);
        }

        return $error;
    }

    public static function editGameAction($gameActionId, $fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType)
    {
        $gameActionValidator = new BaseGameActionValidator();

        $error = $gameActionValidator->validateEditGameAction($gameActionId, $fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType);

        if(!$error->errorExists())
        {
            GameActionLogicUtility::updateGameAction($gameActionId, $fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType);
        }

        return $error;
    }

    public static function deleteGameAction($gameActionId)
    {
        GameActionLogicUtility::deleteGameAction($gameActionId);
    }
}

?>
