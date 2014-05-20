<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = GamesGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$GAMES, $mainContent);

$compressor->finish();

?>
