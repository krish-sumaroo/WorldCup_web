<?php

class BaseCountryValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddCountry($name)
    {
        $this->checkEmptyError($name, "Name");
        $this->validateLength($name, "Name", BaseCountryLogicUtility::$NAME_LIMIT);


        return $this->error;
    }

    public function validateEditCountry($name)
    {
        $this->checkEmptyError($name, "Name");
        $this->validateLength($name, "Name", BaseCountryLogicUtility::$NAME_LIMIT);


        return $this->error;
    }
}

?>
