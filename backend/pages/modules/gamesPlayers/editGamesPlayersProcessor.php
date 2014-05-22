<?php

require_once '../../../autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();

if(SessionHelper::isLoggedIn())
{
    $id = RequestHelper::getRequestValue('id');
    $gameId = RequestHelper::getRequestValue('gameId');
    $playerId = RequestHelper::getRequestValue('playerId');
    $teamId = RequestHelper::getRequestValue('teamId');

    $templateGuiUtility = new BootstrapTemplateGuiUtility();

    $mainContent = GamesPlayersGuiUtility::editGamesPlayers($id, $gameId, $playerId, $teamId);
    echo $templateGuiUtility->getNormalDisplay(PageTitle::$EDIT_GAMESPLAYERS, $mainContent);
}
else
{
    UrlConfiguration::redirect(UrlConfiguration::getUrl("login", "login"));
}
$compressor->finish();

?>
