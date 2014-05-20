<?php

class BaseAdminValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddAdmin($username, $password)
    {
        $this->validateLength($username, "Username", BaseAdminLogicUtility::$USERNAME_LIMIT);

        $this->validateLength($password, "Password", BaseAdminLogicUtility::$PASSWORD_LIMIT);


        return $this->error;
    }

    public function validateEditAdmin($username, $password)
    {
        $this->validateLength($username, "Username", BaseAdminLogicUtility::$USERNAME_LIMIT);

        $this->validateLength($password, "Password", BaseAdminLogicUtility::$PASSWORD_LIMIT);


        return $this->error;
    }
}

?>
