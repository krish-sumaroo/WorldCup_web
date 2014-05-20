<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $user1 = RequestHelper::getRequestValue('user1');
    $user2 = RequestHelper::getRequestValue('user2');
    $status = RequestHelper::getRequestValue('status');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = ConnectionsGuiUtility::editConnections($user1, $user2, $status);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_CONNECTIONS, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
