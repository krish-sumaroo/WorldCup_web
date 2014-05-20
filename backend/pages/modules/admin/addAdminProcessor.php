<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $username = RequestHelper::getRequestValue('username');
    $password = RequestHelper::getRequestValue('password');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = AdminGuiUtility::addAdmin($username, $password);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$ADD_ADMIN, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
