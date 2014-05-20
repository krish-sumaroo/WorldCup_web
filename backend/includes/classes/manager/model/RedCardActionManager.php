<?php

class RedCardActionManager
{
    public static function addRedCardAction($fkGameActionId, $fkPlayerId)
    {
        $redCardActionValidator = new BaseRedCardActionValidator();

        $error = $redCardActionValidator->validateAddRedCardAction($fkGameActionId, $fkPlayerId);

        if(!$error->errorExists())
        {
            RedCardActionLogicUtility::addRedCardAction($fkGameActionId, $fkPlayerId);
        }

        return $error;
    }

    public static function editRedCardAction($fkGameActionId, $fkPlayerId)
    {
        $redCardActionValidator = new BaseRedCardActionValidator();

        $error = $redCardActionValidator->validateEditRedCardAction($fkGameActionId, $fkPlayerId);

        if(!$error->errorExists())
        {
            RedCardActionLogicUtility::updateRedCardAction($fkGameActionId, $fkPlayerId);
        }

        return $error;
    }

    public static function deleteRedCardAction($fkGameActionId)
    {
        RedCardActionLogicUtility::deleteRedCardAction($fkGameActionId);
    }
}

?>
