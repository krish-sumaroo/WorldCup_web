<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $gameplayersId = RequestHelper::getRequestValue("id");

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = GameplayersGuiUtility::getEditGameplayers();
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_GAMEPLAYERS, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}

$compressor->finish();

?>
