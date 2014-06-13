<?php


class PasswordResetManager
{

    public static function validateResetPasswor($email, $verificationCode)
    {
	$error = new Error();
	$usersEntity = UsersLogicUtility::getDetailsByEmailVerificationCode($email, $verificationCode);

	if($usersEntity)
	{

	}
	else
	{
	    $error->addError("This link is no longer valid");
	}

	return $error;
    }
}

?>