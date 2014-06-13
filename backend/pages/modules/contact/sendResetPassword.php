<?php

session_start();

require_once "../../../autoload.php";

$email = RequestHelper::getRequestValue("email");

echo "<p>email : $email</p>"; //debug

PasswordResetGuiUtility::sendResetPasswordMail($email);

?>