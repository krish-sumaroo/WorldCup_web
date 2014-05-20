<?php


class UserLoginValidator extends Validator
{

    public function __construct()
    {
	$this->error = new Error();
    }

    public function validateLogin($email, $password)
    {
	$encryptedPassword = Encryptor::encryptPassword($password);
	$adminEntity = AdminLogicUtility::checkUserExists($email, $encryptedPassword);

	if($adminEntity)
	{
	    $this->error->setObject($adminEntity);
	    //do nothing
	}
	else
	{
	    $this->error->addError("Email or password is wrong");
	}

	return $this->error;
    }
}

?>