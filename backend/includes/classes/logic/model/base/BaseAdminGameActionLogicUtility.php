<?php


class BaseAdminGameActionLogicUtility
{

    //table name
    public static $TABLE_NAME = "admin_game_action";
    //fields list
    public static $FK_GAME_ACTION_ID_FIELD = "fk_game_action_id";
    public static $FK_ADMIN_ID_FIELD = "fk_admin_id";
    public static $ACTION_STATUS_FIELD = "action_status";
    public static $PROCESS_STATUS_FIELD = "process_status";
    //fields values
    //process status
    public static $PROCESS_STATUS_NOT_STARTED = "not_started";
    public static $PROCESS_STATUS_STARTED = "started";
    public static $PROCESS_STATUS_FINISHED = "finished";
    public static $PROCESS_STATUS_ERROR = "error";
    //action status values
    public static $STATUS_VALIDATED = "validated";
    public static $STATUS_NOT_VALIDATED = "not_validated";
    //fields limits
    public static $FK_GAME_ACTION_ID_LIMIT = 11;
    public static $FK_ADMIN_ID_LIMIT = 11;

    public static function addAdminGameAction($fkGameActionId, $fkAdminId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addUpdateField(BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD, $fkAdminId);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getAdminGameActionDetails($fkGameActionId, $fkAdminId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseAdminGameActionLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD, $fkAdminId);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseAdminGameActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateAdminGameAction($fkGameActionId, $fkAdminId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addUpdateField(BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD, $fkAdminId);

	$queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD, $fkAdminId);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getAdminGameActionList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseAdminGameActionLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseAdminGameActionLogicUtility::convertToObjectArray($result);
    }

    public static function deleteAdminGameAction($fkGameActionId, $fkAdminId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD, $fkAdminId);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($fkGameActionId, $fkAdminId, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields($field);
	$queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

	if($fkAdminId != "")
	{
	    $queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD, $fkAdminId);
	}

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseAdminGameActionLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getFkGameActionId($fkGameActionId, $fkAdminId)
    {
	return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId, $fkAdminId,
			BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
    }

    public static function getFkAdminId($fkGameActionId, $fkAdminId)
    {
	return BaseAdminGameActionLogicUtility::getSpecificDetails($fkGameActionId, $fkAdminId,
			BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD);
    }

    public static function getProcessStatus($adminGameActionId)
    {
	return BaseAdminGameActionLogicUtility::getSpecificDetails($adminGameActionId, "",
			BaseAdminGameActionLogicUtility::$PROCESS_STATUS_FIELD);
    }

    protected static function updateSpecificField($fkGameActionId, $fkAdminId, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
	$queryBuilder->addAndConditionWithValue(BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD, $fkAdminId);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD,
		BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD,
		BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(BaseAdminGameActionLogicUtility::$ACTION_STATUS_FIELD,
		BaseAdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(BaseAdminGameActionLogicUtility::$PROCESS_STATUS_FIELD,
		BaseAdminGameActionLogicUtility::$TABLE_NAME);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseAdminGameActionLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$fkGameActionId = QueryBuilder::getQueryValue($resultDetails, BaseAdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
	$fkAdminId = QueryBuilder::getQueryValue($resultDetails, BaseAdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD);
	$actionStatus = QueryBuilder::getQueryValue($resultDetails, BaseAdminGameActionLogicUtility::$ACTION_STATUS_FIELD);
	$processStatus = QueryBuilder::getQueryValue($resultDetails, BaseAdminGameActionLogicUtility::$PROCESS_STATUS_FIELD);

	return new AdminGameActionEntity($fkGameActionId, $fkAdminId, $actionStatus, $processStatus, $resultDetails);
    }
}

?>
