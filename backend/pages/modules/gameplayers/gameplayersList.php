<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = GameplayersGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$GAMEPLAYERS, $mainContent);

$compressor->finish();

?>
