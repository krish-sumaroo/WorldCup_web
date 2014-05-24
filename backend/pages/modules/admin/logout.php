<?php

require_once "../../../autoload.php";

$indexLink = UrlConfiguration::getUrl("admin", "login");

session_start();
session_unset();
header("Location: ".$indexLink);

?>