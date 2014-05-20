<?php

class BaseStadiumValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddStadium($name, $image)
    {
        $this->checkEmptyError($name, "Name");
        $this->validateLength($name, "Name", BaseStadiumLogicUtility::$NAME_LIMIT);

        $this->checkEmptyError($image, "Image");
        $this->validateLength($image, "Image", BaseStadiumLogicUtility::$IMAGE_LIMIT);


        return $this->error;
    }

    public function validateEditStadium($name, $image)
    {
        $this->checkEmptyError($name, "Name");
        $this->validateLength($name, "Name", BaseStadiumLogicUtility::$NAME_LIMIT);

        $this->checkEmptyError($image, "Image");
        $this->validateLength($image, "Image", BaseStadiumLogicUtility::$IMAGE_LIMIT);


        return $this->error;
    }
}

?>
