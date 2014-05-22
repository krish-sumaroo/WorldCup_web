<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = TeamsGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$TEAMS, $mainContent);

$compressor->finish();

?>
