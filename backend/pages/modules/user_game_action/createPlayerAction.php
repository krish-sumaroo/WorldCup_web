<?php

require_once '../../../autoload.php';

$username = RequestHelper::getRequestValue("username");
$uid = RequestHelper::getRequestValue("uid");
$actionType = RequestHelper::getRequestValue("action_type");
$playerId = RequestHelper::getRequestValue("player_id");
$gameId = RequestHelper::getRequestValue("game_id");
$teamId = RequestHelper::getRequestValue("team_id");

echo UserGameActionGuiUtility::createAction($username, $uid, $actionType, $gameId, $playerId, $teamId);

?>
