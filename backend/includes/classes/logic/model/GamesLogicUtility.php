<?php


class GamesLogicUtility extends BaseGamesLogicUtility
{

    public static function getExtendedGamesList(SortQuery $sortQuery = null, $matchStatus = "")
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(GamesLogicUtility::$TABLE_NAME);
	$queryBuilder->addTable(TeamsLogicUtility::$TABLE_NAME);
	$queryBuilder = GamesLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addFields(TeamsLogicUtility::$NAME_FIELD, TeamsLogicUtility::$TABLE_NAME);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	if($matchStatus != "")
	{
	    $queryBuilder->addAndConditionWithValue(GamesLogicUtility::$MATCH_STATUS_FIELD, $matchStatus);
	}

	$result = $queryBuilder->executeQuery();

	return GamesLogicUtility::convertToObjectArray($result);
    }
}

?>
