<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $gameDate = RequestHelper::getRequestValue('gameDate');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = GamesdatesGuiUtility::editGamesdates($gameDate);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_GAMESDATES, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
