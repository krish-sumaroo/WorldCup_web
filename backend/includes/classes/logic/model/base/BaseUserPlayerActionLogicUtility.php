<?php


class BaseUserPlayerActionLogicUtility
{

    //table name
    public static $TABLE_NAME = "userPlayerAction";
    //fields list
    public static $ID_FIELD = "id";
    public static $PLAYERID_FIELD = "playerId";
    public static $ACTIONID_FIELD = "actionId";
    public static $USERID_FIELD = "userId";
    public static $TIMESTAMP_FIELD = "timestamp";
    public static $GAMEID_FIELD = "gameId";
    public static $POINTS_FIELD = "points";
    public static $STATUS_FIELD = "status";
    //fields values
    //actionId
    public static $SCORE_GOAL_ACTION_ID = 1;
    public static $YELLOW_CARD_ACTION_ID = 2;
    public static $GETS_SUBSTITUTED_ACTION_ID = 3;
    public static $RED_CARD_ACTION_ID = 2;
    //status
    public static $STATUS_INITIAL = 0;
    public static $STATUS_SUCCESS = 1;
    public static $STATUS_FAILED = 2;
    //fields limits
    public static $ID_LIMIT = 11;
    public static $PLAYERID_LIMIT = 11;
    public static $ACTIONID_LIMIT = 11;
    public static $USERID_LIMIT = 11;
    public static $GAMEID_LIMIT = 11;

    public static function addUserPlayerAction($playerId, $actionId, $userId, $timestamp, $gameId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUserPlayerActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$PLAYERID_FIELD, $playerId);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$ACTIONID_FIELD, $actionId);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$USERID_FIELD, $userId);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$TIMESTAMP_FIELD, $timestamp);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$GAMEID_FIELD, $gameId);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getUserPlayerActionDetails($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUserPlayerActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseUserPlayerActionLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BaseUserPlayerActionLogicUtility::$ID_FIELD, $id);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseUserPlayerActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateUserPlayerAction($id, $playerId, $actionId, $userId, $timestamp, $gameId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUserPlayerActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$PLAYERID_FIELD, $playerId);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$ACTIONID_FIELD, $actionId);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$USERID_FIELD, $userId);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$TIMESTAMP_FIELD, $timestamp);
	$queryBuilder->addUpdateField(BaseUserPlayerActionLogicUtility::$GAMEID_FIELD, $gameId);

	$queryBuilder->addAndConditionWithValue(BaseUserPlayerActionLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getUserPlayerActionList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUserPlayerActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseUserPlayerActionLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseUserPlayerActionLogicUtility::convertToObjectArray($result);
    }

    public static function deleteUserPlayerAction($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUserPlayerActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BaseUserPlayerActionLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($id, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUserPlayerActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addField($field);
	$queryBuilder->addAndConditionWithValue(BaseUserPlayerActionLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseUserPlayerActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserPlayerActionLogicUtility::$ID_FIELD);
    }

    public static function getPlayerId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserPlayerActionLogicUtility::$PLAYERID_FIELD);
    }

    public static function getActionId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserPlayerActionLogicUtility::$ACTIONID_FIELD);
    }

    public static function getUserId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserPlayerActionLogicUtility::$USERID_FIELD);
    }

    public static function getTimestamp($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserPlayerActionLogicUtility::$TIMESTAMP_FIELD);
    }

    public static function getGameId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserPlayerActionLogicUtility::$GAMEID_FIELD);
    }

    protected static function updateSpecificField($id, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUserPlayerActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BaseUserPlayerActionLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function updatePlayerId($id, $value)
    {
	BaseUserPlayerActionLogicUtility::updateSpecificField($id, $value, BaseUserPlayerActionLogicUtility::$PLAYERID_FIELD,
		$value);
    }

    public static function updateActionId($id, $value)
    {
	BaseUserPlayerActionLogicUtility::updateSpecificField($id, $value, BaseUserPlayerActionLogicUtility::$ACTIONID_FIELD,
		$value);
    }

    public static function updateUserId($id, $value)
    {
	BaseUserPlayerActionLogicUtility::updateSpecificField($id, $value, BaseUserPlayerActionLogicUtility::$USERID_FIELD,
		$value);
    }

    public static function updateTimestamp($id, $value)
    {
	BaseUserPlayerActionLogicUtility::updateSpecificField($id, $value, BaseUserPlayerActionLogicUtility::$TIMESTAMP_FIELD,
		$value);
    }

    public static function updateGameId($id, $value)
    {
	BaseUserPlayerActionLogicUtility::updateSpecificField($id, $value, BaseUserPlayerActionLogicUtility::$GAMEID_FIELD,
		$value);
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseUserPlayerActionLogicUtility::$ID_FIELD);
	$queryBuilder->addFields(BaseUserPlayerActionLogicUtility::$PLAYERID_FIELD);
	$queryBuilder->addFields(BaseUserPlayerActionLogicUtility::$ACTIONID_FIELD);
	$queryBuilder->addFields(BaseUserPlayerActionLogicUtility::$USERID_FIELD);
	$queryBuilder->addFields(BaseUserPlayerActionLogicUtility::$TIMESTAMP_FIELD);
	$queryBuilder->addFields(BaseUserPlayerActionLogicUtility::$GAMEID_FIELD);
	$queryBuilder->addFields(BaseUserPlayerActionLogicUtility::$POINTS_FIELD);
	$queryBuilder->addFields(BaseUserPlayerActionLogicUtility::$STATUS_FIELD);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseUserPlayerActionLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$id = QueryBuilder::getQueryValue($resultDetails, BaseUserPlayerActionLogicUtility::$ID_FIELD);
	$playerId = QueryBuilder::getQueryValue($resultDetails, BaseUserPlayerActionLogicUtility::$PLAYERID_FIELD);
	$actionId = QueryBuilder::getQueryValue($resultDetails, BaseUserPlayerActionLogicUtility::$ACTIONID_FIELD);
	$userId = QueryBuilder::getQueryValue($resultDetails, BaseUserPlayerActionLogicUtility::$USERID_FIELD);
	$timestamp = QueryBuilder::getQueryValue($resultDetails, BaseUserPlayerActionLogicUtility::$TIMESTAMP_FIELD);
	$gameId = QueryBuilder::getQueryValue($resultDetails, BaseUserPlayerActionLogicUtility::$GAMEID_FIELD);
	$points = QueryBuilder::getQueryValue($resultDetails, BaseUserPlayerActionLogicUtility::$POINTS_FIELD);
	$status = QueryBuilder::getQueryValue($resultDetails, BaseUserPlayerActionLogicUtility::$STATUS_FIELD);

	return new UserPlayerActionEntity($id, $playerId, $actionId, $userId, $timestamp, $gameId, $points, $status,
		$resultDetails);
    }
}

?>
