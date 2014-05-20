<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = GamesGuiUtility::getAddGames();
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$ADD_GAMES, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
