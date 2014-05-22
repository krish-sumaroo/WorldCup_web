<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$backendTemplateGuiUtility = new BackendTemplateGuiUtility("Games List");

$mainContent = GamesGuiUtility::getGamesListDisplay();
echo $backendTemplateGuiUtility->getNormalDisplay(PageTitle::$GAMES_LIST, $mainContent,
	BackendNavigation::$GAME_SELECTED);

$compressor->finish();

?>
