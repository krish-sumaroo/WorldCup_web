<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = GamesdatesGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$GAMESDATES, $mainContent);

$compressor->finish();

?>
