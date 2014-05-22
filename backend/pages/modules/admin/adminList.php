<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = AdminGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$ADMIN, $mainContent);

$compressor->finish();

?>
