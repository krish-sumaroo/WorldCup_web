<?php


class BaseRedCardActionLogicUtility
{

    //table name
    public static $TABLE_NAME = "red_card_action";
    //fields list
    public static $FK_GAME_ACTION_ID_FIELD = "fk_game_action_id";
    public static $FK_PLAYER_ID_FIELD = "fk_player_id";
    //fields values
    //fields limits
    public static $FK_GAME_ACTION_ID_LIMIT = 11;
    public static $FK_PLAYER_ID_LIMIT = 11;

    public static function addRedCardAction($fkGameActionId, $fkPlayerId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseRedCardActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addUpdateField(BaseRedCardActionLogicUtility::$FK_PLAYER_ID_FIELD, $fkPlayerId);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getRedCardActionDetails($fkGameActionId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseRedCardActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseRedCardActionLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseRedCardActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateRedCardAction($fkGameActionId, $fkPlayerId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseRedCardActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addUpdateField(BaseRedCardActionLogicUtility::$FK_PLAYER_ID_FIELD, $fkPlayerId);

	$queryBuilder->addAndConditionWithValue(BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getRedCardActionList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseRedCardActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseRedCardActionLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseRedCardActionLogicUtility::convertToObjectArray($result);
    }

    public static function deleteRedCardAction($fkGameActionId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseRedCardActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($fkGameActionId, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseRedCardActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addField($field);
	$queryBuilder->addAndConditionWithValue(BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseRedCardActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getFkGameActionId($fkGameActionId)
    {
	return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId,
			BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
    }

    public static function getFkPlayerId($fkGameActionId)
    {
	return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId, BaseRedCardActionLogicUtility::$FK_PLAYER_ID_FIELD);
    }

    protected static function updateSpecificField($fkGameActionId, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseRedCardActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateFkPlayerId($fkGameActionId, $value)
    {
	BaseRedCardActionLogicUtility::updateSpecificField($fkGameActionId, $value,
		BaseRedCardActionLogicUtility::$FK_PLAYER_ID_FIELD, $value);
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD,
		BaseRedCardActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(BaseRedCardActionLogicUtility::$FK_PLAYER_ID_FIELD, BaseRedCardActionLogicUtility::$TABLE_NAME);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseRedCardActionLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$fkGameActionId = QueryBuilder::getQueryValue($resultDetails, BaseRedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
	$fkPlayerId = QueryBuilder::getQueryValue($resultDetails, BaseRedCardActionLogicUtility::$FK_PLAYER_ID_FIELD);

	return new RedCardActionEntity($fkGameActionId, $fkPlayerId, $resultDetails);
    }
}

?>
