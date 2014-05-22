<?php

class StadiumManager
{
    public static function addStadium($name, $image)
    {
        $stadiumValidator = new BaseStadiumValidator();

        $error = $stadiumValidator->validateAddStadium($name, $image);

        if(!$error->errorExists())
        {
            StadiumLogicUtility::addStadium($name, $image);
        }

        return $error;
    }

    public static function editStadium($id, $name, $image)
    {
        $stadiumValidator = new BaseStadiumValidator();

        $error = $stadiumValidator->validateEditStadium($id, $name, $image);

        if(!$error->errorExists())
        {
            StadiumLogicUtility::updateStadium($id, $name, $image);
        }

        return $error;
    }

    public static function deleteStadium($id)
    {
        StadiumLogicUtility::deleteStadium($id);
    }
}

?>
