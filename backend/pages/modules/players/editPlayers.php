<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $playersId = RequestHelper::getRequestValue("id");

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = PlayersGuiUtility::getEditPlayers($id);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_PLAYERS, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}

$compressor->finish();

?>
