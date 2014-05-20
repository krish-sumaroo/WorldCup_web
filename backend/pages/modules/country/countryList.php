<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = CountryGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$COUNTRY, $mainContent);

$compressor->finish();

?>
