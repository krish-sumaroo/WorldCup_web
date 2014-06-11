<?php


class PlayersLogicUtility extends BasePlayersLogicUtility
{

    public static function getPlayersListByTeamId($teamId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(PlayersLogicUtility::$TABLE_NAME);
	$queryBuilder = PlayersLogicUtility::addAllFields($queryBuilder);

	$queryBuilder->addAndConditionWithValue(PlayersLogicUtility::$TEAMID_FIELD, $teamId);

	$result = $queryBuilder->executeQuery();

	return PlayersLogicUtility::convertToObjectArray($result);
    }
}

?>
