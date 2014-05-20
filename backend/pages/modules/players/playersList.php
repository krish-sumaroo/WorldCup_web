<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = PlayersGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$PLAYERS, $mainContent);

$compressor->finish();

?>
