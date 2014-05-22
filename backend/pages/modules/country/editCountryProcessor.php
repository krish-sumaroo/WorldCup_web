<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $id = RequestHelper::getRequestValue('id');
    $name = RequestHelper::getRequestValue('name');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = CountryGuiUtility::editCountry($id, $name);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_COUNTRY, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
