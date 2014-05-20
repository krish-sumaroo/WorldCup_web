<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

$templateGuiUtility = new BootstrapTemplateGuiUtility();

$mainContent = UsersGuiUtility::getDisplay();
echo $templateGuiUtility->getNormalDisplay(PageTitle::$USERS, $mainContent);

$compressor->finish();

?>
