<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $id = RequestHelper::getRequestValue('id');
    $name = RequestHelper::getRequestValue('name');
    $flag = RequestHelper::getRequestValue('flag');
    $group = RequestHelper::getRequestValue('group');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = TeamsGuiUtility::editTeams($id, $name, $flag, $group);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_TEAMS, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
