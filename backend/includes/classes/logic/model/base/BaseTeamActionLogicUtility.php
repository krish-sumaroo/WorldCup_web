<?php


class BaseTeamActionLogicUtility
{

    //table name
    public static $TABLE_NAME = "team_action";
    //fields list
    public static $FK_GAME_ACTION_ID_FIELD = "fk_game_action_id";
    public static $TEAM1_SCORE_FIELD = "team1_score";
    public static $TEAM2_SCORE_FIELD = "team2_score";
    //fields values
    //fields values for team_action_type
    public static $TEAM_ACTION_TYPE_WIN = "win";
    public static $TEAM_ACTION_TYPE_LOSE = "lose";
    public static $TEAM_ACTION_TYPE_DRAW = "draw";
    //fields limits
    public static $FK_GAME_ACTION_ID_LIMIT = 11;
    public static $FK_TEAM_ID_LIMIT = 11;

    public static function addTeamAction($gameId, $team1Score, $team2Score)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $gameId);
	$queryBuilder->addUpdateField(BaseTeamActionLogicUtility::$TEAM1_SCORE_FIELD, $team1Score);
	$queryBuilder->addUpdateField(BaseTeamActionLogicUtility::$TEAM2_SCORE_FIELD, $team2Score);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getTeamActionDetails($fkGameActionId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseTeamActionLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseTeamActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateTeamAction($fkGameActionId, $team1Score, $team2Score)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseTeamActionLogicUtility::$TEAM1_SCORE_FIELD, $team1Score);
	$queryBuilder->addUpdateField(BaseTeamActionLogicUtility::$TEAM2_SCORE_FIELD, $team2Score);

	$queryBuilder->addAndConditionWithValue(BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getTeamActionList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseTeamActionLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseTeamActionLogicUtility::convertToObjectArray($result);
    }

    public static function deleteTeamAction($fkGameActionId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($fkGameActionId, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addField($field);
	$queryBuilder->addAndConditionWithValue(BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseTeamActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getFkGameActionId($fkGameActionId)
    {
	return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId, BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
    }

    protected static function updateSpecificField($fkGameActionId, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
	$queryBuilder->addFields(BaseTeamActionLogicUtility::$TEAM1_SCORE_FIELD);
	$queryBuilder->addFields(BaseTeamActionLogicUtility::$TEAM2_SCORE_FIELD);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseTeamActionLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$fkGameActionId = QueryBuilder::getQueryValue($resultDetails, BaseTeamActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
	$team1Score = QueryBuilder::getQueryValue($resultDetails, BaseTeamActionLogicUtility::$TEAM1_SCORE_FIELD);
	$team2Score = QueryBuilder::getQueryValue($resultDetails, BaseTeamActionLogicUtility::$TEAM2_SCORE_FIELD);

	return new TeamActionEntity($fkGameActionId, $team1Score, $team2Score, $resultDetails);
    }
}

?>
