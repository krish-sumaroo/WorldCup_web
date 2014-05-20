<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $uid = RequestHelper::getRequestValue('uid');
    $username = RequestHelper::getRequestValue('username');
    $nickname = RequestHelper::getRequestValue('nickname');
    $status = RequestHelper::getRequestValue('status');
    $teamId = RequestHelper::getRequestValue('teamId');
    $country = RequestHelper::getRequestValue('country');
    $password = RequestHelper::getRequestValue('password');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = UsersGuiUtility::addUsers($uid, $username, $nickname, $status, $teamId, $country, $password);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$ADD_USERS, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
