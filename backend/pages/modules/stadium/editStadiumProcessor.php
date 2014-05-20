<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $id = RequestHelper::getRequestValue('id');
    $name = RequestHelper::getRequestValue('name');
    $image = RequestHelper::getRequestValue('image');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = StadiumGuiUtility::editStadium($id, $name, $image);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_STADIUM, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
