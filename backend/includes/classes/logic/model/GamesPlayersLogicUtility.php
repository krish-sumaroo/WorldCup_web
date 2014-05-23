<?php


class GamesPlayersLogicUtility extends BaseGamesPlayersLogicUtility
{

    public static function getPlayersList($gameId, $teamId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(GamesPlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addTable(PlayersLogicUtility::$TABLE_NAME);
	$queryBuilder = PlayersLogicUtility::addAllFields($queryBuilder);

	$queryBuilder->addAndConditionWithValue(GamesPlayersLogicUtility::$GAMEID_FIELD, $gameId,
		QueryBuilder::$OPERATOR_EQUAL, GamesPlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(GamesPlayersLogicUtility::$TEAMID_FIELD, $teamId,
		QueryBuilder::$OPERATOR_EQUAL, GamesPlayersLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndQueryCondition(GamesPlayersLogicUtility::$PLAYERID_FIELD, PlayersLogicUtility::$ID_FIELD,
		QueryBuilder::$OPERATOR_EQUAL, GamesPlayersLogicUtility::$TABLE_NAME, PlayersLogicUtility::$TABLE_NAME);

	$result = $queryBuilder->executeQuery();

	return GamesPlayersLogicUtility::convertToObjectArray($result);
    }
}

?>
