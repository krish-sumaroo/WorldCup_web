<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $name = RequestHelper::getRequestValue('name');
    $image = RequestHelper::getRequestValue('image');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = StadiumGuiUtility::addStadium($name, $image);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$ADD_STADIUM, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
