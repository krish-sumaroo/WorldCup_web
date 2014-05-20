<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $countryId = RequestHelper::getRequestValue("id");

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = CountryGuiUtility::getEditCountry($id);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_COUNTRY, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}

$compressor->finish();

?>
