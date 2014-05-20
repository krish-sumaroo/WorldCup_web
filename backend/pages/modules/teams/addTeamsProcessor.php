<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $name = RequestHelper::getRequestValue('name');
    $flag = RequestHelper::getRequestValue('flag');
    $group = RequestHelper::getRequestValue('group');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = TeamsGuiUtility::addTeams($name, $flag, $group);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$ADD_TEAMS, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
