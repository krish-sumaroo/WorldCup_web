<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $stage = RequestHelper::getRequestValue('stage');
    $team1 = RequestHelper::getRequestValue('team1');
    $team2 = RequestHelper::getRequestValue('team2');
    $venue = RequestHelper::getRequestValue('venue');
    $t1Score = RequestHelper::getRequestValue('t1Score');
    $t2Score = RequestHelper::getRequestValue('t2Score');
    $extraScore = RequestHelper::getRequestValue('extraScore');
    $timeStarted = RequestHelper::getRequestValue('timeStarted');
    $startedF = RequestHelper::getRequestValue('startedF');
    $playerInfo = RequestHelper::getRequestValue('playerInfo');
    $matchDate = RequestHelper::getRequestValue('matchDate');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = GamesGuiUtility::addGames($stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF, $playerInfo, $matchDate);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$ADD_GAMES, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
