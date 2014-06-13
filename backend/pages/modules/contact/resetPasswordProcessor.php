<?php

session_start();

require_once "../../../autoload.php";

$compressor = new compressor(array('page', 'javascript', 'css'));
$templateGuiUtility = new BackendLoginTemplate();

$email = RequestHelper::getRequestValue("email");
$verificationCode = RequestHelper::getRequestValue("code");
$newPassword = RequestHelper::getRequestValue("txt_new_password");
$confirmPassword = RequestHelper::getRequestValue("txt_confirm_password");

$data = PasswordResetGuiUtility::resetPassword($email, $verificationCode, $newPassword, $confirmPassword);

echo $templateGuiUtility->getNormalDisplay("Login", $data);

$compressor->finish();

?>