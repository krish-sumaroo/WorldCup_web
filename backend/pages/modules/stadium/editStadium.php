<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $stadiumId = RequestHelper::getRequestValue("id");

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = StadiumGuiUtility::getEditStadium($id);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_STADIUM, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}

$compressor->finish();

?>
