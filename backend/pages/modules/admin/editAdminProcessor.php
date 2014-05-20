<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $adminId = RequestHelper::getRequestValue('adminId');
    $username = RequestHelper::getRequestValue('username');
    $password = RequestHelper::getRequestValue('password');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = AdminGuiUtility::editAdmin($adminId, $username, $password);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_ADMIN, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
