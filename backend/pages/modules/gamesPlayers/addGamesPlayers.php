<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = GamesPlayersGuiUtility::getAddGamesPlayers();
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$ADD_GAMESPLAYERS, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
