<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $gamesId = RequestHelper::getRequestValue("id");

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = GamesGuiUtility::getEditGames($id);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_GAMES, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}

$compressor->finish();

?>
