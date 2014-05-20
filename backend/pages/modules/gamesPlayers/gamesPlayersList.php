<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = GamesPlayersGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$GAMESPLAYERS, $mainContent);

$compressor->finish();

?>
