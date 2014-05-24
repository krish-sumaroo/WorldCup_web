<?php

class UserGameActionManager
{
    public static function addUserGameAction($fkGameActionId, $fkUserId)
    {
        $userGameActionValidator = new BaseUserGameActionValidator();

        $error = $userGameActionValidator->validateAddUserGameAction($fkGameActionId, $fkUserId);

        if(!$error->errorExists())
        {
            UserGameActionLogicUtility::addUserGameAction($fkGameActionId, $fkUserId);
        }

        return $error;
    }

    public static function editUserGameAction($fkGameActionId, $fkUserId)
    {
        $userGameActionValidator = new BaseUserGameActionValidator();

        $error = $userGameActionValidator->validateEditUserGameAction($fkGameActionId, $fkUserId);

        if(!$error->errorExists())
        {
            UserGameActionLogicUtility::updateUserGameAction($fkGameActionId, $fkUserId);
        }

        return $error;
    }

    public static function deleteUserGameAction($fkGameActionId, $fkUserId)
    {
        UserGameActionLogicUtility::deleteUserGameAction($fkGameActionId, $fkUserId);
    }
}

?>
