<?php

session_start();

require_once "../../../autoload.php";

$compressor = new compressor(array('page', 'javascript', 'css'));
$templateGuiUtility = new BackendLoginTemplate();

if(SessionHelper::isLoggedIn())
{
    $urlBackendIndex = UrlConfiguration::getRootPagesUrl("admin.php");

    header("Location: ".$urlBackendIndex);
}
else
{
    $email = RequestHelper::getRequestValue("txt_email");
    $password = RequestHelper::getRequestValue("txt_password");

    $data = LoginGuiUtility::login($email, $password);

    echo $templateGuiUtility->getNormalDisplay("Login", $data);
}

$compressor->finish();

?>