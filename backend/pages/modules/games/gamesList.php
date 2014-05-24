<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $backendTemplateGuiUtility = new BackendTemplateGuiUtility("Games List");

    $mainContent = GamesGuiUtility::getGamesListDisplay();
    echo $backendTemplateGuiUtility->getNormalDisplay(PageTitle::$GAMES_LIST, $mainContent,
	    BackendNavigation::$GAME_SELECTED);
}
else
{
    $urlLogin = UrlConfiguration::getUrl("admin", "login");

    UrlConfiguration::redirect($urlLogin);
}

$compressor->finish();

?>
