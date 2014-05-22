<?php

class YellowCardActionManager
{
    public static function addYellowCardAction($fkGameActionId, $fkPlayerId)
    {
        $yellowCardActionValidator = new BaseYellowCardActionValidator();

        $error = $yellowCardActionValidator->validateAddYellowCardAction($fkGameActionId, $fkPlayerId);

        if(!$error->errorExists())
        {
            YellowCardActionLogicUtility::addYellowCardAction($fkGameActionId, $fkPlayerId);
        }

        return $error;
    }

    public static function editYellowCardAction($fkGameActionId, $fkPlayerId)
    {
        $yellowCardActionValidator = new BaseYellowCardActionValidator();

        $error = $yellowCardActionValidator->validateEditYellowCardAction($fkGameActionId, $fkPlayerId);

        if(!$error->errorExists())
        {
            YellowCardActionLogicUtility::updateYellowCardAction($fkGameActionId, $fkPlayerId);
        }

        return $error;
    }

    public static function deleteYellowCardAction($fkGameActionId)
    {
        YellowCardActionLogicUtility::deleteYellowCardAction($fkGameActionId);
    }
}

?>
