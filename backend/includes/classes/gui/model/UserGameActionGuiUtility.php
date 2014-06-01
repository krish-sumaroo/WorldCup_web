<?php


class UserGameActionGuiUtility extends BaseUserGameActionGuiUtility
{

    public static function createAction($username, $uid, $actionType, $gameId, $playerId, $teamId)
    {
	$retArray = array();
	$error = UserGameActionManager::createGameAction($username, $uid, $actionType, $gameId, $playerId, $teamId);

	if($error->errorExists())
	{

	}

	return json_encode($retArray);
    }
}

?>
