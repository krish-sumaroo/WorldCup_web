<?php

class GamesdatesManager
{
    public static function addGamesdates($gameDate)
    {
        $gamesdatesValidator = new BaseGamesdatesValidator();

        $error = $gamesdatesValidator->validateAddGamesdates($gameDate);

        if(!$error->errorExists())
        {
            GamesdatesLogicUtility::addGamesdates($gameDate);
        }

        return $error;
    }

    public static function editGamesdates($gameDate)
    {
        $gamesdatesValidator = new BaseGamesdatesValidator();

        $error = $gamesdatesValidator->validateEditGamesdates($gameDate);

        if(!$error->errorExists())
        {
            GamesdatesLogicUtility::updateGamesdates($gameDate);
        }

        return $error;
    }

    public static function deleteGamesdates()
    {
        GamesdatesLogicUtility::deleteGamesdates();
    }
}

?>
