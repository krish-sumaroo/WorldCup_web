<?php

session_start();

require_once "../../../autoload.php";

$compressor = new compressor(array('page', 'javascript', 'css'));
$templateGuiUtility = new BackendLoginTemplate();

$email = RequestHelper::getRequestValue("email");
$verificationCode = RequestHelper::getRequestValue("code");

$data = PasswordResetGuiUtility::getPasswordResetFormDisplay($email, $verificationCode);

echo $templateGuiUtility->getNormalDisplay("Login", $data);

$compressor->finish();

?>