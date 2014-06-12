<?php


class PasswordResetValidator extends Validator
{

    public function __construct()
    {
	$this->error = new Error();
    }

    public function validateResetPassword($email, $verificationCode, $password, $confirmPassword)
    {
	$usersEntity = UsersLogicUtility::getDetailsByEmailVerificationCode($email, $verificationCode);

	if($usersEntity)
	{

	}
	else
	{
	    $this->error->addError("Invalid verification code or email");
	}

	if(TextUtility::isStringEmpty($password))
	{
	    $this->error->addError("Password cannot be empty");
	}

	if($password != $confirmPassword)
	{
	    $this->error->addError("Passwords do not match");
	}

	return $this->error;
    }
}

?>