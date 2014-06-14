<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $gamesId = UrlConfiguration::getParameterId();
    $gameEntity = GamesLogicUtility::getGamesDetails($gamesId);

    if($gameEntity)
    {
	$pageTitle = $gameEntity->getVsDisplay()." ".$gameEntity->getScoreDisplay();
	$backendTemplateGuiUtility = new BackendTemplateGuiUtility($pageTitle);
	$mainContent = GamesGuiUtility::getEngageDisplay($gamesId);
    }
    else
    {
	$backendTemplateGuiUtility = new BackendTemplateGuiUtility("Engage Game");
	$mainContent = Error::getObjectDetailsError("Game");
    }

    echo $backendTemplateGuiUtility->getNormalDisplay(PageTitle::$ENGAGE_GAME, $mainContent,
	    BackendNavigation::$GAME_SELECTED);
}
else
{
    $urlLogin = UrlConfiguration::getUrl("admin", "login");

    UrlConfiguration::redirect($urlLogin);
}

$compressor->finish();

?>
