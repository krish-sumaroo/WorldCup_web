<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = ConnectionsGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$CONNECTIONS, $mainContent);

$compressor->finish();

?>
