<?php

class UserPlayerActionManager
{
    public static function addUserPlayerAction($playerId, $actionId, $userId, $timestamp, $gameId)
    {
        $userPlayerActionValidator = new BaseUserPlayerActionValidator();

        $error = $userPlayerActionValidator->validateAddUserPlayerAction($playerId, $actionId, $userId, $timestamp, $gameId);

        if(!$error->errorExists())
        {
            UserPlayerActionLogicUtility::addUserPlayerAction($playerId, $actionId, $userId, $timestamp, $gameId);
        }

        return $error;
    }

    public static function editUserPlayerAction($id, $playerId, $actionId, $userId, $timestamp, $gameId)
    {
        $userPlayerActionValidator = new BaseUserPlayerActionValidator();

        $error = $userPlayerActionValidator->validateEditUserPlayerAction($id, $playerId, $actionId, $userId, $timestamp, $gameId);

        if(!$error->errorExists())
        {
            UserPlayerActionLogicUtility::updateUserPlayerAction($id, $playerId, $actionId, $userId, $timestamp, $gameId);
        }

        return $error;
    }

    public static function deleteUserPlayerAction($id)
    {
        UserPlayerActionLogicUtility::deleteUserPlayerAction($id);
    }
}

?>
