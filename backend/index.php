<?php

ini_set("display_errors", 1);//debug

session_start();

require_once 'autoload.php';

if(SessionHelper::isLoggedIn())
{
    $backendTemplateGuiUtility = new BackendTemplateGuiUtility("WC 2014");

    echo $backendTemplateGuiUtility->getNormalDisplay("WC 2014", "");
}
else
{
    $urlLogin = UrlConfiguration::getUrl("admin", "login");

    UrlConfiguration::redirect($urlLogin);
}

?>
