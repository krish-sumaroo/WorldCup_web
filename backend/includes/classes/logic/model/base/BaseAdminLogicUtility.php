<?php


class BaseAdminLogicUtility
{

    //table name
    public static $TABLE_NAME = "admin";
    //fields list
    public static $ADMIN_ID_FIELD = "admin_id";
    public static $USERNAME_FIELD = "username";
    public static $PASSWORD_FIELD = "password";
    public static $TIME_OFFSET_FIELD = "time_offset";
    //fields values
    //fields limits
    public static $ADMIN_ID_LIMIT = 20;
    public static $USERNAME_LIMIT = 250;
    public static $PASSWORD_LIMIT = 250;

    public static function addAdmin($username, $password)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseAdminLogicUtility::$USERNAME_FIELD, $username);
	$queryBuilder->addUpdateField(BaseAdminLogicUtility::$PASSWORD_FIELD, $password);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getAdminDetails($adminId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseAdminLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BaseAdminLogicUtility::$ADMIN_ID_FIELD, $adminId);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseAdminLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateAdmin($adminId, $username, $password)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseAdminLogicUtility::$USERNAME_FIELD, $username);
	$queryBuilder->addUpdateField(BaseAdminLogicUtility::$PASSWORD_FIELD, $password);

	$queryBuilder->addAndConditionWithValue(BaseAdminLogicUtility::$ADMIN_ID_FIELD, $adminId);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getAdminList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseAdminLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseAdminLogicUtility::convertToObjectArray($result);
    }

    public static function deleteAdmin($adminId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BaseAdminLogicUtility::$ADMIN_ID_FIELD, $adminId);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($adminId, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminLogicUtility::$TABLE_NAME);
	$queryBuilder->addField($field);
	$queryBuilder->addAndConditionWithValue(BaseAdminLogicUtility::$ADMIN_ID_FIELD, $adminId);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseAdminLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getAdminId($adminId)
    {
	return BaseBannerLogicUtility::getSpecificDetails($adminId, BaseAdminLogicUtility::$ADMIN_ID_FIELD);
    }

    public static function getUsername($adminId)
    {
	return BaseBannerLogicUtility::getSpecificDetails($adminId, BaseAdminLogicUtility::$USERNAME_FIELD);
    }

    public static function getPassword($adminId)
    {
	return BaseBannerLogicUtility::getSpecificDetails($adminId, BaseAdminLogicUtility::$PASSWORD_FIELD);
    }

    protected static function updateSpecificField($adminId, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseAdminLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BaseAdminLogicUtility::$ADMIN_ID_FIELD, $adminId);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateUsername($adminId, $value)
    {
	BaseAdminLogicUtility::updateSpecificField($adminId, $value, BaseAdminLogicUtility::$USERNAME_FIELD, $value);
    }

    public static function updatePassword($adminId, $value)
    {
	BaseAdminLogicUtility::updateSpecificField($adminId, $value, BaseAdminLogicUtility::$PASSWORD_FIELD, $value);
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseAdminLogicUtility::$ADMIN_ID_FIELD);
	$queryBuilder->addFields(BaseAdminLogicUtility::$USERNAME_FIELD);
	$queryBuilder->addFields(BaseAdminLogicUtility::$PASSWORD_FIELD);
	$queryBuilder->addFields(BaseAdminLogicUtility::$TIME_OFFSET_FIELD);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseAdminLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$adminId = QueryBuilder::getQueryValue($resultDetails, BaseAdminLogicUtility::$ADMIN_ID_FIELD);
	$username = QueryBuilder::getQueryValue($resultDetails, BaseAdminLogicUtility::$USERNAME_FIELD);
	$password = QueryBuilder::getQueryValue($resultDetails, BaseAdminLogicUtility::$PASSWORD_FIELD);
	$timeOffset = QueryBuilder::getQueryValue($resultDetails, BaseAdminLogicUtility::$TIME_OFFSET_FIELD);

	return new AdminEntity($adminId, $username, $password, $timeOffset, $resultDetails);
    }
}

?>
