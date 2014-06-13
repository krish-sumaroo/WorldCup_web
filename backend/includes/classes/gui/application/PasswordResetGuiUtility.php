<?php


class PasswordResetGuiUtility
{

    public static function sendResetPasswordMail($email)
    {
	$output = "";

	if(!TextUtility::isStringEmpty($email))
	{
	    $verificationCode = Encryptor::generateRandomString();

	    UsersLogicUtility::updateResetPasswordCodeByEmail($email, $verificationCode);
	    MailTemplateGuiUtility::sendResetPasswordEmail($email, $verificationCode);
	}

	return $output;
    }

    public static function getPasswordResetFormDisplay($email, $verificationCode, $error = "")
    {
	$output = "";

	$validationError = PasswordResetManager::validateResetPasswor($email, $verificationCode);

	if($validationError->errorExists())
	{
	    $output .= $validationError->getBoostrapError();
	}
	else
	{
	    $actionUrl = UrlConfiguration::getUrl("contact", "resetPasswordProcessor", "email=$email&code=$verificationCode");

	    if($error != "")
	    {
		$output .= ResultUpdateGuiUtility::getBootstrapErrorDisplay($error);
	    }

	    $output .= "<form class='form-horizontal' method='post' action=\"$actionUrl\">";

	    $output .= "<div class='form-group'>";
	    $output .= "<label class='col-lg-3' for='txt_new_password'>New Password</label>";
	    $output .= "<div class='col-lg-9'>";
	    $output .= "<input type='password' class='form-control' id='txt_new_password' name='txt_new_password' placeholder='New Password'>";
	    $output .= "</div>";
	    $output .= "</div>";

	    $output .= "<div class='form-group'>";
	    $output .= "<label class='col-lg-3' for='txt_confirm_password'>Confirm Password</label>";
	    $output .= "<div class='col-lg-9'>";
	    $output .= "<input type='password' class='form-control' id='txt_confirm_password' name='txt_confirm_password' placeholder='Confirm Password'>";
	    $output .= "</div>";
	    $output .= "</div>";

	    $output .= "<!-- sign in button -->";
	    $output .= "<div class='form-group'>";
	    $output .= "<div class='col-lg-9 col-lg-offset-3'>";
	    $output .= "<div class='checkbox'>";
	    $output .= "</div>";
	    $output .= "</div>";
	    $output .= "</div>";
	    $output .= "<div class='col-lg-9 col-lg-offset-2'>";
	    $output .= "<button type='submit' class='btn btn-danger'>Reset Password</button>";
	    $output .= "&nbsp;";
	    $output .= "<button type='reset' class='btn btn-default'>Reset</button>";
	    $output .= "</div>";
	    $output .= "<br />";

	    $output .= "</form>";
	}

	$title = "<span class='glyphicon glyphicon-lock'></span> Reset Password for $email ";

	$backendWidgetDisplayUtility = new BackendWidgetDisplayUtility(12, "", $output);
	$backendWidgetDisplayUtility->setWidgetHead($title);
	$backendWidgetDisplayUtility->setWidgetAdditionalClass("worange");

	return $backendWidgetDisplayUtility->getDisplay();
    }

    public static function resetPassword($email, $verificationCode, $password, $confirmPassword)
    {
	$output = "";

	$passwordResetValidator = new PasswordResetValidator();

	$error = $passwordResetValidator->validateResetPassword($email, $verificationCode, $password, $confirmPassword);

	if($error->errorExists())
	{
	    $output .= PasswordResetGuiUtility::getPasswordResetFormDisplay($email, $verificationCode, $error->getErrorList());
	}
	else
	{
	    UsersLogicUtility::resetPassword($email, Encryptor::encryptPassword($password));

	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay("Password has been updated");
	}

	return $output;
    }
}

?>