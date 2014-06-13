<?php

session_start();

require_once "../../../autoload.php";

$compressor = new compressor(array('page', 'javascript', 'css'));
$templateGuiUtility = new BackendLoginTemplate();

if(SessionHelper::isLoggedIn())
{
    $urlBackendIndex = UrlConfiguration::getUrl("backend", "index");

    header("Location: ".$urlBackendIndex);
}
else
{
	$data = LoginGuiUtility::getDisplay();
    echo $templateGuiUtility->getNormalDisplay("Login", $data);
}

$compressor->finish();

?>
