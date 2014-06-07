<?php


class TeamActionLogicUtility extends BaseTeamActionLogicUtility
{

    public static function getTeamActionDetailsByGameId($gameId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(TeamActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addTable(GameActionLogicUtility::$TABLE_NAME);

	$queryBuilder = TeamActionLogicUtility::addAllFields($queryBuilder);

	$queryBuilder->addAndConditionWithValue(GameActionLogicUtility::$FK_GAME_ID_FIELD, $gameId,
		QueryBuilder::$OPERATOR_EQUAL, GameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndQueryCondition(TeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD,
		GameActionLogicUtility::$GAME_ACTION_ID_FIELD, QueryBuilder::$OPERATOR_EQUAL, TeamActionLogicUtility::$TABLE_NAME,
		GameActionLogicUtility::$TABLE_NAME);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return TeamActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }
}

?>
