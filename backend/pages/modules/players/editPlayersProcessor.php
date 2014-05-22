<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $id = RequestHelper::getRequestValue('id');
    $teamId = RequestHelper::getRequestValue('teamId');
    $name = RequestHelper::getRequestValue('name');
    $position = RequestHelper::getRequestValue('position');
    $number = RequestHelper::getRequestValue('number');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = PlayersGuiUtility::editPlayers($id, $teamId, $name, $position, $number);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_PLAYERS, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
