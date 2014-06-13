<?php

session_start();

require_once "../../../autoload.php";

$compressor = new compressor(array('page', 'javascript', 'css'));
$templateGuiUtility = new BackendLoginTemplate();


$data = ImportDataGuiUtility::importPlayers();

echo $templateGuiUtility->getNormalDisplay("Login", $data);

$compressor->finish();

?>