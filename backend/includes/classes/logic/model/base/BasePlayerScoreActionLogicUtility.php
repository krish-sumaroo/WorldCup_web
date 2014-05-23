<?php


class BasePlayerScoreActionLogicUtility
{

    //table name
    public static $TABLE_NAME = "player_score_action";
    //fields list
    public static $FK_GAME_ACTION_ID_FIELD = "fk_game_action_id";
    public static $FK_PLAYER_ID_FIELD = "fk_player_id";
    //fields values
    //fields limits
    public static $FK_GAME_ACTION_ID_LIMIT = 11;
    public static $FK_PLAYER_ID_LIMIT = 11;

    public static function addPlayerScoreAction($fkGameActionId, $fkPlayerId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayerScoreActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addUpdateField(BasePlayerScoreActionLogicUtility::$FK_PLAYER_ID_FIELD, $fkPlayerId);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getPlayerScoreActionDetails($fkGameActionId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayerScoreActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BasePlayerScoreActionLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BasePlayerScoreActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updatePlayerScoreAction($fkGameActionId, $fkPlayerId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayerScoreActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addUpdateField(BasePlayerScoreActionLogicUtility::$FK_PLAYER_ID_FIELD, $fkPlayerId);

	$queryBuilder->addAndConditionWithValue(BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getPlayerScoreActionList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayerScoreActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BasePlayerScoreActionLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BasePlayerScoreActionLogicUtility::convertToObjectArray($result);
    }

    public static function deletePlayerScoreAction($fkGameActionId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayerScoreActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($fkGameActionId, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayerScoreActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addField($field);
	$queryBuilder->addAndConditionWithValue(BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BasePlayerScoreActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getFkGameActionId($fkGameActionId)
    {
	return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId,
			BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
    }

    public static function getFkPlayerId($fkGameActionId)
    {
	return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId,
			BasePlayerScoreActionLogicUtility::$FK_PLAYER_ID_FIELD);
    }

    protected static function updateSpecificField($fkGameActionId, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayerScoreActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateFkPlayerId($fkGameActionId, $value)
    {
	BasePlayerScoreActionLogicUtility::updateSpecificField($fkGameActionId, $value,
		BasePlayerScoreActionLogicUtility::$FK_PLAYER_ID_FIELD, $value);
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD,
		BasePlayerScoreActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(BasePlayerScoreActionLogicUtility::$FK_PLAYER_ID_FIELD,
		BasePlayerScoreActionLogicUtility::$TABLE_NAME);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BasePlayerScoreActionLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$fkGameActionId = QueryBuilder::getQueryValue($resultDetails,
			BasePlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
	$fkPlayerId = QueryBuilder::getQueryValue($resultDetails, BasePlayerScoreActionLogicUtility::$FK_PLAYER_ID_FIELD);

	return new PlayerScoreActionEntity($fkGameActionId, $fkPlayerId, $resultDetails);
    }
}

?>
