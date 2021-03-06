<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = StadiumGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$STADIUM, $mainContent);

$compressor->finish();

?>
