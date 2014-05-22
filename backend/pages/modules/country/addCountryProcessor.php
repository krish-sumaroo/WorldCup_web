<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $name = RequestHelper::getRequestValue('name');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = CountryGuiUtility::addCountry($name);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$ADD_COUNTRY, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
